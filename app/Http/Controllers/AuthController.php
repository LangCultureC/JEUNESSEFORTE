<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin() { return view('connexion'); }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/');
        }

        return back()->withErrors(['email' => 'Identifiants incorrects.']);
    }

    public function showRegister() { return view('inscription'); }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
            'role_choisi' => 'required|in:jeune,pair-aidant,psychologue',
        ]);

        $estPro = in_array($request->role_choisi, ['pair-aidant', 'psychologue']);

        // Premier utilisateur inscrit sur la plateforme → admin automatique
        $estPremier = \App\Models\User::count() === 0;
        $role = $estPremier ? 'admin' : 'jeune';

        $user = \App\Models\User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => \Illuminate\Support\Facades\Hash::make($request->password),
            'role' => $role,
            'statut' => $estPro ? 'en_attente' : ($estPremier ? 'actif' : 'actif'),
            'role_souhaite' => $estPro ? $request->role_choisi : null,
        ]);

        \Illuminate\Support\Facades\Auth::login($user);

        $message = $estPremier
            ? 'Compte créé ! Bienvenue, administrateur. Tu es le premier sur la plateforme — tu peux valider les demandes de paires-aidants et psychologues depuis l\'admin panel.'
            : (!$estPro ? 'Bienvenue sur JeunesseForte. Ton compte est actif.' : 'Compte créé. Ta demande pour devenir ' . $request->role_choisi . ' est en attente de validation par un administrateur.');

        return redirect('/')->with('welcome', $message);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
