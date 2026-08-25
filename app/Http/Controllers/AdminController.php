<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $enAttente = User::where('statut', 'en_attente')->get();
        $tousLesUtilisateurs = User::orderBy('created_at', 'desc')->get();
        return view('admin', compact('enAttente', 'tousLesUtilisateurs'));
    }

    public function valider($id)
    {
        $user = User::findOrFail($id);
        $user->role = $user->role_souhaite;
        $user->statut = 'actif';
        $user->role_souhaite = null;
        $user->save();
        return back()->with('message', $user->name . ' a été validé en tant que ' . $user->role . '.');
    }

    public function refuser($id)
    {
        $user = User::findOrFail($id);
        $user->statut = 'refuse';
        $user->role_souhaite = null;
        $user->save();
        return back()->with('message', 'Demande refusée pour ' . $user->name . '.');
    }

    public function changerRole(Request $request, $id)
    {
        $request->validate(['role' => 'required|in:jeune,pair-aidant,psychologue,admin']);
        $user = User::findOrFail($id);
        $user->role = $request->role;
        $user->statut = 'actif';
        $user->save();
        return back()->with('message', 'Rôle de ' . $user->name . ' mis à jour.');
    }

    public function supprimer($id)
    {
        $user = User::findOrFail($id);
        if ($user->id === auth()->id()) {
            return back()->withErrors(['error' => 'Tu ne peux pas supprimer ton propre compte.']);
        }
        $user->delete();
        return back()->with('message', 'Compte supprimé.');
    }
}
