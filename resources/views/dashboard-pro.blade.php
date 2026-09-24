@extends('layouts.app')

@section('content')
<div class="box-confession pro-page">
    <h1 style="margin-bottom: 2rem; font-family: 'Space Grotesk', sans-serif;">💼 Votre Espace d'Écoute Pro</h1>
    
    <div class="pro-grid">
        <!-- DROIT DE TRAITEMENT : Gestion des alertes et demandes de RDV -->
        <div>
            <h2 style="font-size: 1.3rem; margin-bottom: 1rem; color: var(--brand-primary); font-family: 'Space Grotesk', sans-serif;">🚨 Alertes SOS et Demandes de RDV reçues</h2>
            <div id="listeRdv" style="background: #F8FAFC; padding: 1.2rem; border-radius: var(--radius-md); border: 1px solid #E2E8F0; display: flex; flex-direction: column; gap: 0.75rem;">
                Chargement des signalements...
            </div>
        </div>

        <!-- DROIT DE DIALOGUE PRIVÉ : Messageries privées avec les auteurs des confessions -->
        <div>
            <h2 style="font-size: 1.3rem; margin-bottom: 1rem; color: var(--brand-primary); font-family: 'Space Grotesk', sans-serif;">💬 Vos Suivis & Salons Privés</h2>
            <div id="listeSalons" style="background: #F8FAFC; padding: 1.2rem; border-radius: var(--radius-md); border: 1px solid #E2E8F0; display: flex; flex-direction: column; gap: 0.75rem;">
                Chargement de vos discussions...
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const CSRF = document.querySelector('meta[name="csrf-token"]').content;

    window.onload = async function() {
        chargerRDV();
        chargerSalons();
    };

    async function chargerRDV() {
        const res = await fetch('/api/rendezvous/attente');
        const rdvs = await res.json();
        const container = document.getElementById('listeRdv');
        
        if (rdvs.length === 0) {
            container.innerHTML = "<p style='color: var(--text-muted); text-align:center;'>Aucune alerte ou demande en attente. Beau travail !</p>";
            return;
        }

        container.innerHTML = rdvs.map(r => {
            const estUrgent = r.motif.includes('SOS');
            const styleUrgence = estUrgent ? 'border-left: 5px solid var(--danger-red); background: #FEF2F2;' : 'background: white;';
            return `
                <div style="${styleUrgence} padding: 1rem; border-radius: 8px; box-shadow: var(--shadow-sm); border: 1px solid #E2E8F0;">
                    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 0.5rem;">
                        <strong>Étudiant :</strong> ${r.jeune_nom}
                        ${estUrgent ? '<span style="background:var(--danger-red); color:white; padding:0.2rem 0.5rem; font-size:0.75rem; font-weight:700; border-radius:4px;">URGENT</span>' : ''}
                    </div>
                    <p style="font-size:0.95rem; margin-bottom: 0.75rem;"><strong>Motif :</strong> ${r.motif}</p>
                    <div style="display: flex; flex-wrap: wrap; gap: 0.5rem; align-items: center;">
                        <input type="datetime-local" id="date-${r.id}" style="padding: 0.4rem; border: 1px solid #CBD5E1; border-radius: 6px; font-family:inherit;">
                        <button onclick="traiterRDV(${r.id}, 'accepte')" style="background: #16A34A; color: white; border: none; padding: 0.4rem 0.8rem; border-radius: 6px; font-weight:600; cursor:pointer;">Planifier</button>
                        <button onclick="traiterRDV(${r.id}, 'refuse')" style="background: #DC2626; color: white; border: none; padding: 0.4rem 0.8rem; border-radius: 6px; font-weight:600; cursor:pointer;">Refuser</button>
                    </div>
                </div>
            `;
        }).join('');
    }

    async function traiterRDV(id, statut) {
        const dateHeure = document.getElementById(`date-${id}`).value;
        if (statut === 'accepte' && !dateHeure) {
            alert('Veuillez spécifier une date et une heure pour honorer ce rendez-vous.');
            return;
        }

        const res = await fetch(`/api/rendezvous/${id}/traiter`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': CSRF },
            body: JSON.stringify({ statut, date_heure: dateHeure })
        });
        
        if (res.ok) chargerRDV();
    }

    async function chargerSalons() {
        const res = await fetch('/api/salons/mes-salons');
        const salons = await res.json();
        const container = document.getElementById('listeSalons');

        if (salons.length === 0) {
            container.innerHTML = "<p style='color: var(--text-muted); text-align:center;'>Vous n'avez pas encore engagé de conversation privée.</p>";
            return;
        }

        container.innerHTML = salons.map(s => `
            <div style="background: white; padding: 1rem; border-radius: 8px; box-shadow: var(--shadow-sm); border: 1px solid #E2E8F0; display:flex; justify-content:space-between; align-items:center;">
                <div>
                    <strong>Discussion #${s.id}</strong><br>
                    <small style="color: var(--text-muted);">Statut : ${s.autre_nom}</small>
                </div>
                <button onclick="alert('La messagerie privée en temps réel sera configurée lors de la prochaine étape !')" style="background: var(--brand-secondary); color: white; border: none; padding: 0.4rem 0.8rem; border-radius: 6px; font-weight:600; cursor:pointer;">Ouvrir le chat</button>
            </div>
        `).join('');
    }
</script>
@endpush
