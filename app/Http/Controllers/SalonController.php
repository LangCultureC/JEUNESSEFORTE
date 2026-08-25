<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SalonPrive;
use App\Models\MessageSalon;
use App\Models\Confession;

class SalonController extends Controller
{
    public function creer(Request $request)
    {
        $request->validate(['confession_id' => 'required|exists:confessions,id']);

        $confession = Confession::findOrFail($request->confession_id);

        if (!$confession->auteur_id) {
            return response()->json(['error' => "Impossible d'identifier l'auteur de cette confession."], 422);
        }

        $salon = SalonPrive::firstOrCreate([
            'jeune_id' => $confession->auteur_id,
            'pro_id' => Auth::id(),
            'confession_id' => $confession->id,
        ]);

        return response()->json($salon, 201);
    }

    public function mesSalons()
    {
        $user = Auth::user();
        $estPro = in_array($user->role, ['pair-aidant', 'psychologue']);

        $salons = $estPro
            ? SalonPrive::with('jeune')->where('pro_id', $user->id)->get()
            : SalonPrive::with('pro')->where('jeune_id', $user->id)->get();

        return response()->json($salons->map(fn($s) => [
            'id' => $s->id,
            'autre_nom' => $estPro ? 'Membre anonyme' : $s->pro->name,
        ]));
    }

    public function messages($id)
    {
        $salon = SalonPrive::findOrFail($id);
        $this->autoriser($salon);

        return response()->json($salon->messages()->orderBy('created_at')->get()->map(fn($m) => [
            'texte' => $m->texte,
            'de_moi' => $m->auteur_id === Auth::id(),
        ]));
    }

    public function envoyer(Request $request, $id)
    {
        $salon = SalonPrive::findOrFail($id);
        $this->autoriser($salon);

        $request->validate(['texte' => 'required|string']);

        MessageSalon::create([
            'salon_id' => $salon->id,
            'auteur_id' => Auth::id(),
            'texte' => $request->texte,
        ]);

        return response()->json(['message' => 'Envoyé.'], 201);
    }

    private function autoriser(SalonPrive $salon)
    {
        $userId = Auth::id();
        if ($salon->jeune_id !== $userId && $salon->pro_id !== $userId) {
            abort(403, "Tu n'as pas accès à ce salon.");
        }
    }
}
