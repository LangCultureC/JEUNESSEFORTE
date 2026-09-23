@extends('layouts.app')

@section('content')
<div class="page-heading"><p class="eyebrow">Gestion de la communauté</p><h1>Panneau d’administration</h1></div>

@if(session('message'))
<div class="stat-card" style="background:#EAF4EE; border:1px solid var(--brand-primary); margin-bottom:1.5rem;">
    <p style="color:var(--brand-primary); font-weight:600; margin:0;">{{ session('message') }}</p>
</div>
@endif

<h2 class="admin-section-title">⏳ Demandes en attente ({{ $enAttente->count() }})</h2>

@if($enAttente->isEmpty())
    <p style="color:var(--text-muted); margin-bottom:2rem;">Aucune demande en attente.</p>
@else
    <div style="margin-bottom:2rem;">
        @foreach($enAttente as $u)
        <div class="stat-card admin-request">
            <div>
                <strong>{{ $u->name }}</strong> ({{ $u->email }})
                <br><span class="tag-cat">Demande : {{ $u->role_souhaite }}</span>
            </div>
            <div style="display:flex; gap:0.5rem;">
                <form method="POST" action="/admin/valider/{{ $u->id }}">
                    @csrf
                    <button type="submit" style="background:var(--brand-primary); color:white; border:none; padding:0.5rem 1rem; border-radius:6px; cursor:pointer;">Valider</button>
                </form>
                <form method="POST" action="/admin/refuser/{{ $u->id }}">
                    @csrf
                    <button type="submit" style="background:var(--danger-red); color:white; border:none; padding:0.5rem 1rem; border-radius:6px; cursor:pointer;">Refuser</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
@endif

<h2 class="admin-section-title">👥 Tous les comptes ({{ $tousLesUtilisateurs->count() }})</h2>

<div class="admin-table-wrap" role="region" aria-label="Liste des comptes" tabindex="0">
<table class="admin-table">
    <thead>
        <tr style="background:#F1F5F9; text-align:left;">
            <th style="padding:0.75rem;">Nom</th>
            <th style="padding:0.75rem;">Email</th>
            <th style="padding:0.75rem;">Rôle</th>
            <th style="padding:0.75rem;">Statut</th>
            <th style="padding:0.75rem;">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($tousLesUtilisateurs as $u)
        <tr style="border-top:1px solid #E2E8F0;">
            <td style="padding:0.75rem;">{{ $u->name }}</td>
            <td style="padding:0.75rem;">{{ $u->email }}</td>
            <td style="padding:0.75rem;">
                <form method="POST" action="/admin/role/{{ $u->id }}" style="display:flex; gap:0.5rem;">
                    @csrf
                    <select name="role" style="padding:0.4rem; border-radius:6px; border:1px solid #E2E8F0;">
                        <option value="jeune" {{ $u->role === 'jeune' ? 'selected' : '' }}>Membre</option>
                        <option value="pair-aidant" {{ $u->role === 'pair-aidant' ? 'selected' : '' }}>Pair-aidant</option>
                        <option value="psychologue" {{ $u->role === 'psychologue' ? 'selected' : '' }}>Psychologue</option>
                        <option value="admin" {{ $u->role === 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                    <button type="submit" style="padding:0.4rem 0.8rem; background:var(--text-dark); color:white; border:none; border-radius:6px; cursor:pointer; font-size:0.8rem;">Changer</button>
                </form>
            </td>
            <td style="padding:0.75rem;">{{ $u->statut }}</td>
            <td style="padding:0.75rem;">
                <form method="POST" action="/admin/supprimer/{{ $u->id }}" onsubmit="return confirm('Supprimer définitivement ce compte ?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="background:var(--danger-red); color:white; border:none; padding:0.4rem 0.8rem; border-radius:6px; cursor:pointer; font-size:0.8rem;">Supprimer</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
@endsection
