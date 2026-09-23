@extends('layouts.app')

@section('content')
<div class="welcome-page">
    <section class="hero-layout" aria-labelledby="welcome-title">
        <div class="hero-main">
            <div class="hero-copy">
                <p class="eyebrow">Un espace pour toi. Une communauté avec toi.</p>
                <h1 id="welcome-title">Libère ton esprit.<br><span>Garde ta force.</span></h1>
                <p class="hero-description">Les études, les doutes, les grands changements… Tu n’as pas à tout garder pour toi. Ici, on prend le temps de s’écouter.</p>
                <div class="hero-actions">
                    @auth
                        <a class="welcome-button" href="#blocSaisieConfession">Partager ce que je vis <span aria-hidden="true">↗</span></a>
                    @else
                        <a class="welcome-button" href="/inscription">Rejoindre la communauté <span aria-hidden="true">↗</span></a>
                    @endauth
                    <a class="hero-secondary" href="#echanges">Découvrir les échanges <span aria-hidden="true">↓</span></a>
                </div>
                <p class="hero-note">À ton rythme. Avec respect. Sans jugement.</p>
            </div>
            <aside class="hero-art" aria-label="Notre esprit : parler, écouter, avancer">
                <div class="art-orbit" aria-hidden="true"></div>
                <span class="art-spark" aria-hidden="true">✳</span>
                <div class="art-message"><span class="art-caption">UN PREMIER PAS</span><p>Et si on<br>en parlait <span>?</span></p><div class="art-dots" aria-hidden="true"><i></i><i></i><i></i></div></div>
                <div class="art-reply"><span aria-hidden="true">♡</span> Chaque parole compte.</div>
            </aside>
        </div>
    </section>

    <section class="welcome-about" id="a-propos" aria-labelledby="about-title">
        <div><p class="eyebrow">À propos de JeunesseForte</p><h2 id="about-title">Grandir, c’est aussi<br>pouvoir compter sur les autres.</h2></div>
        <p>JeunesseForte est un espace d’entraide pour les jeunes et les étudiants. On y partage ses expériences, on écoute celles des autres et on trouve du soutien pour avancer, un pas à la fois.</p>
    </section>
    <section class="welcome-pillars" aria-label="L’esprit JeunesseForte">
        <article><span class="pillar-number">01</span><div><h2>Exprime-toi</h2><p>Mets des mots sur ce que tu traverses.</p></div></article>
        <article><span class="pillar-number">02</span><div><h2>Trouve du soutien</h2><p>Échange avec une communauté à l’écoute.</p></div></article>
        <article><span class="pillar-number">03</span><div><h2>Avance à ton rythme</h2><p>Un petit pas peut faire la différence.</p></div></article>
    </section>

    <div class="feed-heading" id="echanges"><div><p class="eyebrow">Les mots nous rapprochent</p><h2>Le fil de la communauté</h2></div><p>Des vécus différents. Une même envie de s’entraider.</p></div>
    <div class="filter-grid" role="group" aria-label="Filtrer par thème">
        <button class="filter-btn active" aria-pressed="true" onclick="filtrerConfessions('Tout voir', this)">Tout voir</button>
        <button class="filter-btn" aria-pressed="false" onclick="filtrerConfessions('Anxiété & Stress', this)">Anxiété & Stress</button>
        <button class="filter-btn" aria-pressed="false" onclick="filtrerConfessions('Études & Orientation', this)">Études & Orientation</button>
        <button class="filter-btn" aria-pressed="false" onclick="filtrerConfessions('Général', this)">Général</button>
    </div>

    <!-- Saisie de Confession -->
    <div id="blocSaisieConfession" class="box-confession" style="display: none;">
        <h2>📝 Déposer une confession anonyme</h2>
        <form id="formConfession" style="margin-top: 1rem;">
            <textarea id="texteConfession" placeholder="Que se passe-t-il dans ton esprit ? Ton anonymat est totalement préservé..." required></textarea>
            <div class="confession-actions">
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
        <div id="filConfessions" aria-live="polite"><div class="feed-empty"><span class="empty-symbol" aria-hidden="true">…</span><p>Les échanges arrivent…</p></div></div>

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

            <div class="community-note stat-card"><span class="eyebrow">Un espace qui nous ressemble</span><h2>La bienveillance commence avec nous.</h2><p>Écoutons sans juger, respectons les vécus de chacun et prenons soin de nos mots.</p><span class="community-signature">L’équipe JeunesseForte <span aria-hidden="true">♡</span></span></div>
            <!-- Bloc Faire un Don -->
            <div class="stat-card donation-card">
                <div style="font-weight:700; color:#B45309; margin-bottom:0.5rem;">❤️ Soutenir JeunesseForte</div>
                <p style="font-size:0.85rem; color:#78350F; margin-bottom:1rem;">Aidez-nous à maintenir la plateforme gratuite et bénévole.</p>
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:0.5rem;">
                    <button type="button" onclick="alert('Redirection Orange Money / Moov Money...')" style="background:#D97706; color:white; border:none; padding:0.5rem; border-radius:6px; font-weight:600; cursor:pointer;">2 000 F CFA</button>
                    <button type="button" onclick="alert('Redirection Orange Money / Moov Money...')" style="background:#B45309; color:white; border:none; padding:0.5rem; border-radius:6px; font-weight:600; cursor:pointer;">5 000 F CFA</button>
                </div>
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
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.classList.remove('active');
            btn.setAttribute('aria-pressed', 'false');
        });
        boutonClique.setAttribute('aria-pressed', 'true');
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
            if (!res.ok) throw new Error('Chargement impossible');
            const toutesLesConfessions = await res.json();
            const fil = document.getElementById('filConfessions');
            fil.innerHTML = '';

            const confessionsFiltrees = categorieActuelle === "Tout voir"
                ? toutesLesConfessions
                : toutesLesConfessions.filter(c => c.categorie === categorieActuelle);

            if (confessionsFiltrees.length === 0) {
                fil.innerHTML = `<div class="feed-empty"><span class="empty-symbol" aria-hidden="true">✎</span><h3>Chaque échange commence par un premier mot.</h3><p>Aucune confession dans cette catégorie pour le moment. Une expérience, une question, une pensée : ta voix a sa place ici.</p><a class="welcome-button" href="${sessionUtilisateur.connecte ? '#blocSaisieConfession' : '/inscription'}">${sessionUtilisateur.connecte ? 'Partager une pensée' : 'Rejoindre la communauté'} <span aria-hidden="true">↗</span></a></div>`;
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
        } catch (e) {
            document.getElementById('filConfessions').innerHTML = '<div class="feed-empty"><h3>Les échanges sont momentanément indisponibles.</h3><p>Réessaie dans quelques instants.</p><button type="button" class="welcome-button" onclick="chargerFilConfessions()">Réessayer</button></div>';
            console.error("Erreur chargement confessions", e);
        }
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