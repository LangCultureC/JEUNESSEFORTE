@extends('layouts.app')

@section('content')
<div class="auth-page login-page">
  <div class="login-shell">
    <aside class="login-welcome" aria-label="Bienvenue sur JeunesseForte">
        <span class="login-community">JEUNESSEFORTE · ENSEMBLE</span>
        <div class="login-welcome-copy">
            <span class="login-symbol" aria-hidden="true">✳</span>
            <h2>Un espace pour parler.<br><em>Une force pour avancer.</em></h2>
            <p>Parfois, tout commence par quelques mots. Retrouve une communauté qui prend le temps de t’écouter.</p>
        </div>
        <div class="login-values"><span>Écoute</span><span>Entraide</span><span>Bienveillance</span></div>
    </aside>
    <div class="auth-card">
        <p class="eyebrow">Heureux de te retrouver</p>
        <h1 class="auth-title">Connexion</h1>
        <p class="auth-description">Ton espace d’échange t’attend.</p>
        @if ($errors->any())
            <p class="auth-error" role="alert">{{ $errors->first() }}</p>
        @endif
        <form method="POST" action="/connexion" class="auth-form">
            @csrf
            <div class="login-field">
            <label class="auth-label" for="login-email">Adresse email</label>
            <input id="login-email" class="auth-field" type="email" name="email" placeholder="toi@exemple.com" autocomplete="email" required>
            </div>
            <div class="login-field">
            <label class="auth-label" for="login-password">Mot de passe</label>
            <input id="login-password" class="auth-field" type="password" name="password" placeholder="Ton mot de passe" autocomplete="current-password" required>
            </div>
            <button type="submit" class="auth-submit">Se connecter <span aria-hidden="true">→</span></button>
        </form>
        <p class="auth-footer">Pas encore de compte ? <a href="/inscription" class="auth-link">S'inscrire</a></p>
    </div>
</div>
  </div>
@endsection
