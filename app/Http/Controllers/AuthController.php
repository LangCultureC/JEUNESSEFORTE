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
            'password' => 'required|min:6|confirmed',
            'role_choisi' => 'required|in:jeune,pair-aidant,psychologue',
        ]);

        $estPro = in_array($request->role_choisi, ['pair-aidant', 'psychologue']);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'jeune', // droits de membre en attendant validation
            'statut' => $estPro ? 'en_attente' : 'actif',
            'role_souhaite' => $estPro ? $request->role_choisi : null,
        ]);

        Auth::login($user);

        if ($estPro) {
            return redirect('/')->with('message', 'Compte créé avec les droits de membre. Ta demande pour devenir ' . $request->role_choisi . ' est en attente de validation par un administrateur.');
        }

        return redirect('/');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
