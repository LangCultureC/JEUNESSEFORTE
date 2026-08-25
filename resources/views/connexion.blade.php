@extends('layouts.app')

@section('content')
<div class="box-confession" style="max-width: 420px; margin: 3rem auto;">
    <h2 style="margin-bottom: 1.5rem;">🔐 Connexion</h2>

    @if ($errors->any())
        <p style="color: var(--danger-red); margin-bottom: 1rem;">{{ $errors->first() }}</p>
    @endif

    <form method="POST" action="/connexion">
        @csrf
        <input type="email" name="email" placeholder="Adresse email" required
            style="width:100%; padding:0.75rem; margin-bottom:1rem; border:1px solid #E2E8F0; border-radius:8px;">
        <input type="password" name="password" placeholder="Mot de passe" required
            style="width:100%; padding:0.75rem; margin-bottom:1rem; border:1px solid #E2E8F0; border-radius:8px;">
        <button type="submit" style="width:100%; padding:0.75rem; background:var(--brand-primary); color:white; border:none; border-radius:8px; font-weight:600; cursor:pointer;">
            Se connecter
        </button>
    </form>

    <p style="margin-top:1.5rem; text-align:center; font-size:0.9rem;">
        Pas encore de compte ? <a href="/inscription" style="color:var(--brand-primary); font-weight:600;">S'inscrire</a>
    </p>
</div>
@endsection
