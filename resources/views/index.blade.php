@extends('layouts.app')

@section('content')
    <section class="hero-layout">
        <div class="hero-main">
            <h1>Libère ton esprit. Garde ta force.</h1>
            <p>Espace sécurisé d'entraide et d'écoute pour les étudiants.</p>
        </div>
    </section>

    <div class="filter-grid">
        <button class="filter-btn active" onclick="filtrerConfessions('Tout voir', this)">Tout voir</button>
        <button class="filter-btn" onclick="filtrerConfessions('Anxiété & Stress', this)">Anxiété & Stress</button>
        <button class="filter-btn" onclick="filtrerConfessions('Études & Orientation', this)">Études & Orientation</button>
        <button class="filter-btn" onclick="filtrerConfessions('Général', this)">Général</button>
    </div>

    <!-- Saisie de Confession -->
    <div id="blocSaisieConfession" class="box-confession" style="display: none;">
        <h2>📝 Déposer une confession anonyme</h2>
        <form id="formConfession" style="margin-top: 1rem;">
            <textarea id="texteConfession" placeholder="Que se passe-t-il dans ton esprit ? Ton anonymat est totalement préservé..." required></textarea>
            <div style="display: flex; gap: 1rem; align-items: center;">
                <select id="catConfession" style="padding: 0.6rem; border-radius: var(--radius-md); border: 1px solid #E2E8F0;">
                    <option value="Général">Général</option>
                    <option value="Anxiété & Stress">Anxiété & Stress</option>
                    <option value="Études & Orientation">Études & Orientation</option>
                </select>
                <button type="submit" style="padding:0.6rem 1.5rem; background:var(--brand-primary); color:white; border:none; border-radius: var(--radius-md); font-weight:600; cursor:pointer;">Publier sur le fil</button>
            </div>
        </form>
    </div>

    <div class="main-layout">
        <!-- Fil d'actualité des confessions -->
        <div id="filConfessions" style="flex: 1;">Chargement des confessions...</div>

        <!-- Barre latérale droite -->
        <div class="stats-sidebar" style="width: 100%;">
            <!-- Widget de RDV -->
            <div class="stat-card" id="widgetRdv" style="display:none; border-left: 4px solid var(--brand-primary);">
                <div style="font-weight:700; font-size:1.1rem; margin-bottom:0.5rem;">📅 Demander un RDV de suivi</div>
                <form id="formDemandeRDV" style="display:flex; flex-direction:column; gap:0.5rem;">
                    <input type="text" id="motifRDV" placeholder="Ex: Besoin de parler de mes examens" required style="padding:0.6rem; border:1px solid #E2E8F0; border-radius:6px;">
                    <button type="submit" style="background:var(--brand-primary); color:white; border:none; padding:0.6rem; border-radius:6px; font-weight:600; cursor:pointer;">Solliciter le RDV</button>
                </form>
                <hr style="margin: 1rem 0; border: 0; border-top: 1px solid #E2E8F0;">
                <div style="font-weight:600; font-size:0.9rem; margin-bottom:0.5rem;">Mes demandes en cours :</div>
                <div id="statusMesRDV" style="font-size:0.85rem; color:var(--text-muted);">Aucune demande.</div>
            </div>

            <!-- Bloc Faire un Don -->
            <div class="stat-card" style="background: #FFFBEB; border: 1px solid #FEF3C7;">
                <div style="font-weight:700; color:#B45309; margin-bottom:0.5rem;">❤️ Soutenir JeunesseForte</div>
                <p style="font-size:0.85rem; color:#78350F; margin-bottom:1rem;">Aidez-nous à maintenir la plateforme gratuite et bénévole.</p>
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:0.5rem;">
                    <button type="button" onclick="alert('Redirection Orange Money / Moov Money...')" style="background:#D97706; color:white; border:none; padding:0.5rem; border-radius:6px; font-weight:600; cursor:pointer;">2 000 F CFA</button>
                    <button type="button" onclick="alert('Redirection Orange Money / Moov Money...')" style="background:#B45309; color:white; border:none; padding:0.5rem; border-radius:6px; font-weight:600; cursor:pointer;">5 000 F CFA</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    const CSRF = document.querySelector('meta[name="csrf-token"]').content;
    let sessionUtilisateur = { connecte: false, role: null, identifiant: null };
    let categorieActuelle = "Tout voir";

    window.onload = async function() {
        await verifierSession();
        await chargerFilConfessions();
        if (sessionUtilisateur.connecte && sessionUtilisateur.role === 'jeune') {
            afficherMesRDV();
        }
    };

    async function verifierSession() {
        try {
            const res = await fetch('/api/statut-connexion');
            const data = await res.json();
            if (data.connecte) {
                sessionUtilisateur = data;
                document.getElementById('blocSaisieConfession').style.display = 'block';
                if (data.role === 'jeune') {
                    document.getElementById('widgetRdv').style.display = 'block';
                }
            }
        } catch (e) { console.log("Erreur de session"); }
    }

    function filtrerConfessions(categorie, boutonClique) {
        categorieActuelle = categorie;
        document.querySelectorAll('.filter-btn').forEach(btn => btn.classList.remove('active'));
        boutonClique.classList.add('active');
        chargerFilConfessions();
    }

    document.getElementById('formConfession').addEventListener('submit', async function(e) {
        e.preventDefault();
        const res = await fetch('/api/confessions', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': CSRF },
            body: JSON.stringify({ texte: document.getElementById('texteConfession').value, categorie: document.getElementById('catConfession').value })
        });
        if (res.ok) { 
            document.getElementById('texteConfession').value = ''; 
            chargerFilConfessions(); 
        }
    });

    async function chargerFilConfessions() {
        try {
            const res = await fetch('/api/commentaires');
            const toutesLesConfessions = await res.json();
            const fil = document.getElementById('filConfessions');
            fil.innerHTML = '';

            const confessionsFiltrees = categorieActuelle === "Tout voir"
                ? toutesLesConfessions
                : toutesLesConfessions.filter(c => c.categorie === categorieActuelle);

            if (confessionsFiltrees.length === 0) {
                fil.innerHTML = '<p style="text-align:center; color:#64748B; padding: 2rem;">Aucune confession dans cette catégorie.</p>';
                return;
            }

            confessionsFiltrees.forEach(c => {
                const card = document.createElement('div');
                card.className = 'confession-card';

                // DROIT DES PROS : Bouton pour initier une discussion privée
                const boutonPrive = (sessionUtilisateur.role === 'pair-aidant' || sessionUtilisateur.role === 'psychologue')
                    ? `<button type="button" onclick="creerSalon(${c.id})" style="background:var(--brand-secondary); color:white; border:none; padding:0.5rem 1rem; font-size:0.8rem; font-weight:700; border-radius:var(--radius-md); cursor:pointer;">💬 Contacter (Privé)</button>` : '';

                let html = `
                    <div style="display:flex; justify-content:space-between; margin-bottom:1rem; align-items:center;">
                        <span class="tag-cat">${c.categorie}</span>
                        <div style="display:flex; gap:0.5rem;">${boutonPrive}</div>
                    </div>
                    <p style="font-size:1.1rem; line-height:1.6; margin-bottom:1.5rem;">${c.texte}</p>
                    <div style="background:#F1F5F9; padding:1rem; border-radius:var(--radius-md);">
                `;

                c.commentaires.forEach(com => {
                    const badge = com.nom_auteur
                        ? `<span style="background:var(--brand-primary); color:white; padding:0.2rem 0.5rem; border-radius:4px; font-size:0.75rem;">🌟 ${com.nom_auteur} (${com.role_auteur})</span>`
                        : `<span style="background:#CBD5E1; color:var(--text-dark); padding:0.2rem 0.5rem; border-radius:4px; font-size:0.75rem;">👤 Membre Anonyme</span>`;
                    html += `<div style="margin-bottom:0.5rem; font-size:0.9rem;">${badge} <span style="margin-left:0.5rem;">${com.texte}</span></div>`;
                });

                if (sessionUtilisateur.connecte) {
                    html += `
                        <form onsubmit="repondre(event, ${c.id})" style="display:flex; gap:0.5rem; margin-top:1rem;">
                            <input type="text" id="rep-${c.id}" placeholder="Écrire une réponse de soutien..." required style="flex:1; padding:0.5rem; border:1px solid #E2E8F0; border-radius:4px;">
                            <button type="submit" style="background:var(--text-dark); color:white; border:none; padding:0.5rem 1rem; border-radius:4px; cursor:pointer;">Répondre</button>
                        </form>
                    `;
                }

                card.innerHTML = html + `</div>`;
                fil.appendChild(card);
            });
        } catch (e) { console.error("Erreur chargement confessions", e); }
    }

    async function repondre(e, id) {
        e.preventDefault();
        const texte = document.getElementById(`rep-${id}`).value;
        const res = await fetch(`/api/commentaires/${id}/repondre`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': CSRF },
            body: JSON.stringify({ texte })
        });
        if (res.ok) chargerFilConfessions();
    }

    async function creerSalon(confessionId) {
        const res = await fetch('/api/salons/creer', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': CSRF },
            body: JSON.stringify({ confession_id: confessionId })
        });
        if (res.ok) {
           window.location.href = '/messagerie';
        } else {
            alert("Erreur lors de la création du salon privé.");
        }
    }

    // Gestion de la demande de RDV avec confirmation
    document.getElementById('formDemandeRDV')?.addEventListener('submit', async function(e) {
        e.preventDefault();
        const motif = document.getElementById('motifRDV').value;
        
        const res = await fetch('/api/rendezvous/demander', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': CSRF },
            body: JSON.stringify({ motif: motif })
        });
        
        if (res.ok) {
            alert('✅ Ta demande a bien été envoyée ! Les professionnels ont été notifiés.');
            document.getElementById('motifRDV').value = '';
            afficherMesRDV();
        }
    });

    async function afficherMesRDV() {
        const res = await fetch('/api/rendezvous/mes-rdv');
        if (!res.ok) return;
        const rdvs = await res.json();
        const div = document.getElementById('statusMesRDV');
        if (rdvs.length === 0) {
            div.innerHTML = 'Aucune demande en cours.';
            return;
        }
        div.innerHTML = rdvs.map(r => `
            <div style="background:#F1F5F9; padding:0.5rem; border-radius:4px; margin-bottom:0.25rem;">
                <strong>${r.motif}</strong> <br> Statut : <span style="font-weight:bold; color:${r.statut==='en_attente'?'#D97706':(r.statut==='accepte'?'#16A34A':'#DC2626')}">${r.statut.toUpperCase()}</span>
                ${r.date_heure ? `<br><small>📅 Prévu le : ${r.date_heure}</small>` : ''}
            </div>
        `).join('');
    }
</script>
@endpush