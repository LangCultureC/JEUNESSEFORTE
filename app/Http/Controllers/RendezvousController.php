<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Rendezvous;

class RendezvousController extends Controller
{
    public function demander(Request $request)
    {
        $request->validate(['motif' => 'required|string|max:255']);

        Rendezvous::create([
            'jeune_id' => Auth::id(),
            'motif' => $request->motif,
        ]);

        return response()->json(['message' => 'Demande envoyée !'], 201);
    }

    public function mesRdv()
    {
        $rdvs = Rendezvous::where('jeune_id', Auth::id())->orderBy('created_at', 'desc')->get();
        return response()->json($rdvs);
    }

    public function enAttente()
    {
        $rdvs = Rendezvous::with('jeune')->where('statut', 'en_attente')->orderBy('created_at')->get();
        return response()->json($rdvs->map(fn($r) => [
            'id' => $r->id,
            'motif' => $r->motif,
            'jeune_nom' => $r->jeune->name,
        ]));
    }

    public function traiter(Request $request, $id)
    {
        $request->validate([
            'statut' => 'required|in:accepte,refuse',
            'date_heure' => 'nullable|date',
        ]);

        if ($request->statut === 'accepte' && !$request->date_heure) {
            return response()->json(['error' => 'Une date est requise pour accepter.'], 422);
        }

        $rdv = Rendezvous::findOrFail($id);
        $rdv->pro_id = Auth::id();
        $rdv->statut = $request->statut;
        $rdv->date_heure = $request->date_heure;
        $rdv->save();

        return response()->json(['message' => 'RDV mis à jour.']);
    }
}
