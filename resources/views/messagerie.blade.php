@extends('layouts.app')

@section('content')
<div class="box-confession" style="padding: 0; display: flex; height: 85vh; overflow: hidden;">

    <!-- Liste des conversations à gauche -->
    <div style="width: 300px; border-right: 1px solid #E2E8F0; background: #F8FAFC; overflow-y: auto;">
        <div style="padding: 1.5rem; border-bottom: 1px solid #E2E8F0;">
            <h2 style="font-size: 1.2rem; font-family: 'Space Grotesk', sans-serif;">Boîte de réception</h2>
        </div>
        <div id="listeConversations" style="padding: 1rem;">
            <p style="color: var(--text-muted); font-size: 0.9rem;">Chargement des conversations...</p>
        </div>
    </div>

    <!-- Zone de chat à droite -->
    <div style="flex: 1; display: flex; flex-direction: column; background: white;">
        <div id="enteteChat" style="padding: 1.5rem; border-bottom: 1px solid #E2E8F0; background: white;">
            <h3 style="margin: 0; color: var(--text-dark);">Sélectionnez une conversation</h3>
        </div>

        <div id="zoneMessages" style="flex: 1; padding: 1.5rem; overflow-y: auto; background: #F8FAFC;">
            <p style="color: var(--text-muted); font-size: 0.9rem; text-align: center; margin-top: 2rem;">Sélectionnez une conversation pour voir les messages.</p>
        </div>

        <div style="padding: 1.5rem; border-top: 1px solid #E2E8F0; background: white;">
            <form id="formMessage" style="display: flex; gap: 1rem;">
                <input type="text" id="inputMessage" placeholder="Écrivez votre message..." style="flex: 1; padding: 0.8rem; border: 1px solid #E2E8F0; border-radius: var(--radius-md);" disabled>
                <button type="submit" style="background: var(--brand-primary); color: white; border: none; padding: 0 1.5rem; border-radius: var(--radius-md); font-weight: 600; cursor: pointer;" disabled>Envoyer</button>
            </form>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/laravel-echo@1.15.0/dist/echo.iife.js"></script>
<script src="https://cdn.jsdelivr.net/npm/pusher-js@8.4.0/dist/pusher.min.js"></script>

<script>
    const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').content;
    const MON_ID = {{ auth()->id() }};

    // Initialisation de Echo
    window.Echo = new Echo({
        broadcaster: 'reverb',
        key: 'testkey',
        wsHost: window.location.hostname,
        wsPort: 8085,
        wssPort: 8085,
        forceTLS: false,
        enabledTransports: ['ws', 'wss'],
    });

    let salonActif = null;

    // Charger les salons/conversation au chargement
    document.addEventListener('DOMContentLoaded', () => {
        chargerSalons();
    });

    // Charger les salons
    function chargerSalons() {
        fetch('/api/salons/mes-salons', {
            headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': CSRF_TOKEN }
        })
        .then(r => r.json())
        .then(salons => {
            const container = document.getElementById('listeConversations');
            if (salons.length === 0) {
                container.innerHTML = '<p style="color: var(--text-muted); font-size: 0.9rem; text-align: center;">Aucune conversation.</p>';
                return;
            }
            container.innerHTML = '';
            salons.forEach(s => {
                const div = document.createElement('div');
                div.style.cssText = 'padding: 0.8rem; border-radius: 8px; cursor: pointer; border: 1px solid #E2E8F0; margin-bottom: 0.5rem; background: white;';
                div.style.display = 'flex';
                div.style.justifyContent = 'space-between';
                div.style.alignItems = 'center';
                div.innerHTML = `
                    <strong>Discussion #${s.id}</strong>
                    <small style="color: var(--text-muted);">${s.autre_nom}</small>
                `;
                div.addEventListener('click', () => ouvrirSalon(s.id));
                container.appendChild(div);
            });
        })
        .catch(err => {
            document.getElementById('listeConversations').innerHTML = '<p style="color: var(--danger-red);">Erreur de chargement.</p>';
            console.error(err);
        });
    }

    // Ouvrir une conversation
    function ouvrirSalon(salonId) {
        salonActif = salonId;
        document.getElementById('enteteChat').innerHTML = `<h3 style="margin: 0; color: var(--text-dark);">Discussion #${salonId}</h3>`;
        document.getElementById('inputMessage').disabled = false;
        document.getElementById('formMessage').querySelector('button').disabled = false;

        // Charger les messages existants
        chargerMessages(salonId);

        // Écouter les nouveaux messages en temps réel
        window.Echo.channel(`salon.${salonId}`)
            .listen('MessageSent', (e) => {
                if (e.salon_id === salonId) {
                    ajouterMessage(e);
                }
            })
            .error(err => console.error('Echo error:', err));
    }

    // Charger les messages existants
    function chargerMessages(salonId) {
        fetch(`/api/salons/${salonId}/messages`, {
            headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': CSRF_TOKEN }
        })
        .then(r => r.json())
        .then(messages => {
            const zone = document.getElementById('zoneMessages');
            zone.innerHTML = '';
            if (messages.length === 0) {
                zone.innerHTML = '<p style="color: var(--text-muted); font-size: 0.9rem; text-align: center;">Aucun message.</p>';
                return;
            }
            messages.forEach(m => ajouterMessage(m, true));
        })
        .catch(err => {
            document.getElementById('zoneMessages').innerHTML = '<p style="color: var(--danger-red);">Erreur de chargement.</p>';
            console.error(err);
        });
    }

    // Ajouter un message
    function ajouterMessage(msg, estExistants = false) {
        const zone = document.getElementById('zoneMessages');
        const div = document.createElement('div');
        div.style.cssText = estExistants
            ? 'margin-bottom: 1rem; padding: 0.8rem; background: white; border-radius: 8px; border: 1px solid #E2E8F0;'
            : 'margin-bottom: 1rem; padding: 0.8rem; background: var(--brand-primary); color: white; border-radius: 8px; animation: fadeIn 0.3s;';
        div.style.display = 'flex';
        div.style.flexDirection = 'column';
        div.style.gap = '0.3rem';

        const estMoi = msg.de_moi || (msg.auteur_id !== null && msg.auteur_id == MON_ID);
        if (!estExistants) {
            div.style.background = estMoi ? 'var(--brand-primary)' : '#E2E8F0';
            div.style.color = estMoi ? 'white' : 'var(--text-dark)';
        }

        div.innerHTML = `
            <div style="font-size: 0.8rem; opacity: 0.7;">${estMoi ? 'Moi' : 'Autre'} • ${new Date(msg.created_at).toLocaleTimeString('fr-FR')}</div>
            <div style="white-space: pre-wrap; line-height: 1.5;">${msg.texte}</div>
        `;
        zone.appendChild(div);
        zone.scrollTop = zone.scrollHeight;
    }

    // Envoyer un message
    document.getElementById('formMessage').addEventListener('submit', (e) => {
        e.preventDefault();
        const texte = document.getElementById('inputMessage').value.trim();
        if (!texte || !salonActif) return;

        fetch(`/api/salons/${salonActif}/envoyer`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': CSRF_TOKEN
            },
            body: JSON.stringify({ texte })
        })
        .then(r => r.json())
        .then(() => {
            document.getElementById('inputMessage').value = '';
        })
        .catch(err => {
            alert('Erreur envoi.');
            console.error(err);
        });
    });
</script>

@endsection
