@extends('layouts.app')

@section('content')
<div class="auth-page login-page register-page">
  <div class="login-shell">
    <aside class="login-welcome" aria-label="Rejoindre JeunesseForte">
        <span class="login-community">JEUNESSEFORTE · ENSEMBLE</span>
        <div class="login-welcome-copy">
            <span class="login-symbol" aria-hidden="true">✳</span>
            <h2>Ta place est ici.<br><em>Avançons ensemble.</em></h2>
            <p>Un premier pas pour partager ce que tu vis, trouver du soutien ou accompagner d’autres jeunes.</p>
        </div>
        <div class="login-values"><span>Écoute</span><span>Entraide</span><span>Bienveillance</span></div>
    </aside>
    <div class="auth-card">
        <p class="eyebrow">Bienvenue dans la communauté</p>
        <h1 class="auth-title">Créer un compte</h1>
        <p class="auth-description">Rejoins la communauté, à ton rythme.</p>

        @if ($errors->any())
            <p class="auth-error" role="alert">{{ $errors->first() }}</p>
        @endif

        <form method="POST" action="/inscription" class="auth-form">
            @csrf
            <div class="login-field register-field">
            <label class="auth-label" for="register-name">Prénom ou pseudo</label>
            <input type="text" name="name" id="register-name" autocomplete="nickname" class="auth-field" placeholder="Ton prénom ou pseudo" required>
            </div>
            <div class="login-field register-field">
            <label class="auth-label" for="register-email">Adresse email</label>
            <input type="email" name="email" id="register-email" autocomplete="email" class="auth-field" placeholder="toi@exemple.com" required>
            </div>
            <div class="login-field register-field">
            <label class="auth-label" for="register-password">Mot de passe</label>
            <input type="password" name="password" id="register-password" autocomplete="new-password" class="auth-field" placeholder="Mot de passe" required>
            </div>
            <div class="login-field register-field">
            <label class="auth-label" for="register-password_confirmation">Confirmer le mot de passe</label>
            <input type="password" name="password_confirmation" id="register-password_confirmation" autocomplete="new-password" class="auth-field" placeholder="Confirme le mot de passe" required>
            </div>

            <fieldset class="auth-role-block">
                <legend class="auth-role-title">Je m’inscris en tant que</legend>
                <div class="auth-role-list">
                    <label class="auth-role-option">
                        <input type="radio" name="role_choisi" value="jeune" checked>
                        <span>Membre (étudiant)</span>
                    </label>
                    <label class="auth-role-option">
                        <input type="radio" name="role_choisi" value="pair-aidant">
                        <span>Pair-aidant</span>
                        <span class="auth-role-note">Validation admin requise</span>
                    </label>
                    <label class="auth-role-option">
                        <input type="radio" name="role_choisi" value="psychologue">
                        <span>Psychologue</span>
                        <span class="auth-role-note">Validation admin requise</span>
                    </label>
                </div>
            </fieldset>

            <button type="submit" class="auth-submit">Créer mon compte <span aria-hidden="true">→</span></button>
        </form>

        <p class="auth-footer">
            Déjà un compte ? <a href="/connexion" class="auth-link">Se connecter</a>
        </p>
    </div>
</div>
  </div>
@endsection
