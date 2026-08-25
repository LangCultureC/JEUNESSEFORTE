@extends('layouts.app')

@section('content')
<div class="box-confession" style="max-width: 460px; margin: 3rem auto;">
    <h2 style="margin-bottom: 1.5rem;">📝 Créer un compte</h2>

    @if ($errors->any())
        <p style="color: var(--danger-red); margin-bottom: 1rem;">{{ $errors->first() }}</p>
    @endif

    <form method="POST" action="/inscription">
        @csrf
        <input type="text" name="name" placeholder="Ton prénom ou pseudo" required
            style="width:100%; padding:0.75rem; margin-bottom:1rem; border:1px solid #E2E8F0; border-radius:8px;">
        <input type="email" name="email" placeholder="Adresse email" required
            style="width:100%; padding:0.75rem; margin-bottom:1rem; border:1px solid #E2E8F0; border-radius:8px;">
        <input type="password" name="password" placeholder="Mot de passe" required
            style="width:100%; padding:0.75rem; margin-bottom:1rem; border:1px solid #E2E8F0; border-radius:8px;">
        <input type="password" name="password_confirmation" placeholder="Confirme le mot de passe" required
            style="width:100%; padding:0.75rem; margin-bottom:1.5rem; border:1px solid #E2E8F0; border-radius:8px;">

        <div style="margin-bottom:1.5rem;">
            <div style="font-weight:600; margin-bottom:0.5rem; font-size:0.9rem;">Je m'inscris en tant que :</div>
            <label style="display:flex; align-items:center; gap:0.5rem; padding:0.6rem; border:1px solid #E2E8F0; border-radius:8px; margin-bottom:0.5rem; cursor:pointer;">
                <input type="radio" name="role_choisi" value="jeune" checked> Membre (étudiant)
            </label>
            <label style="display:flex; align-items:center; gap:0.5rem; padding:0.6rem; border:1px solid #E2E8F0; border-radius:8px; margin-bottom:0.5rem; cursor:pointer;">
                <input type="radio" name="role_choisi" value="pair-aidant"> Pair-aidant <span style="color:var(--text-muted); font-size:0.8rem;">(validation admin requise)</span>
            </label>
            <label style="display:flex; align-items:center; gap:0.5rem; padding:0.6rem; border:1px solid #E2E8F0; border-radius:8px; cursor:pointer;">
                <input type="radio" name="role_choisi" value="psychologue"> Psychologue <span style="color:var(--text-muted); font-size:0.8rem;">(validation admin requise)</span>
            </label>
        </div>

        <button type="submit" style="width:100%; padding:0.75rem; background:var(--brand-primary); color:white; border:none; border-radius:8px; font-weight:600; cursor:pointer;">
            S'inscrire
        </button>
    </form>

    <p style="margin-top:1.5rem; text-align:center; font-size:0.9rem;">
        Déjà un compte ? <a href="/connexion" style="color:var(--brand-primary); font-weight:600;">Se connecter</a>
    </p>
</div>
@endsection
