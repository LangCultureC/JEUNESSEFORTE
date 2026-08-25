<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Confession;
use App\Models\Commentaire;

class JeunesseController extends Controller
{
    public function getConfessions()
    {
        $confessions = Confession::with(['commentaires.auteur'])->orderBy('created_at', 'desc')->get();

        $resultat = $confessions->map(function ($c) {
            return [
                'id' => $c->id,
                'texte' => $c->texte,
                'categorie' => $c->categorie,
                'commentaires' => $c->commentaires->map(function ($com) {
                    $estPro = in_array($com->role_auteur, ['pair-aidant', 'psychologue']);
                    return [
                        'texte' => $com->texte,
                        'role_auteur' => $com->role_auteur,
                        'nom_auteur' => $estPro ? optional($com->auteur)->name : null,
                    ];
                }),
            ];
        });

        return response()->json($resultat);
    }

    public function storeConfession(Request $request)
    {
        $request->validate([
            'texte' => 'required|string',
            'categorie' => 'required|string',
        ]);

        Confession::create([
            'texte' => $request->texte,
            'categorie' => $request->categorie,
            'auteur_id' => Auth::id(), // jamais affiché publiquement, sert uniquement au contact privé par un pro
        ]);

        return response()->json(['message' => 'Confession publiée !'], 201);
    }

    public function storeReponse(Request $request, $id)
    {
        $request->validate(['texte' => 'required|string']);

        Commentaire::create([
            'confession_id' => $id,
            'texte' => $request->texte,
            'auteur_id' => Auth::id(),
            'role_auteur' => Auth::user()->role,
        ]);

        return response()->json(['message' => 'Réponse ajoutée !'], 201);
    }

    public function statutConnexion()
    {
        if (Auth::check()) {
            return response()->json([
                'connecte' => true,
                'role' => Auth::user()->role,
                'identifiant' => Auth::user()->name,
            ]);
        }
        return response()->json(['connecte' => false]);
    }
}
