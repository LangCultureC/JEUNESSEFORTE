@extends('layouts.app')

@section('content')
<style>
    /* ── Care Design : palette apaisante ── */
    :root {
        --care-primary: #7C9EB2;
        --care-primary-light: #A8C5DB;
        --care-accent: #C8A98E;
        --care-warm: #E8C9A0;
        --care-error: #E8907A;
        --care-success: #7DB8A3;
        --care-bg-start: #D6E4EF;
        --care-bg-end: #FFFFFF;
    }

    .care-wrap {
        min-height: 85vh;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        background: linear-gradient(160deg, var(--care-bg-start) 0%, var(--care-bg-end) 70%);
        padding: 2rem 1rem;
        position: relative;
        overflow: hidden;
    }

    /* ── Illustration planche/swing (SVG inline, douce) ── */
    .care-illustration {
        position: absolute;
        top: 10%;
        right: 5%;
        width: 220px;
        opacity: 0.55;
        pointer-events: none;
        transform: rotate(-8deg);
    }

    .care-card {
        background: rgba(255, 255, 255, 0.82);
        backdrop-filter: blur(8px);
        border-radius: 20px;
        padding: 2.5rem 2rem;
        width: 100%;
        max-width: 440px;
        box-shadow: 0 8px 32px rgba(124, 158, 178, 0.18);
        border: 1px solid rgba(255,255,255,0.6);
        position: relative;
        z-index: 1;
    }

    .care-emoji-top {
        font-size: 2.8rem;
        text-align: center;
        margin-bottom: 0.3rem;
        animation: gentle-float 4s ease-in-out infinite;
    }

    @keyframes gentle-float {
        0%, 100% { transform: translateY(0); }
        50%      { transform: translateY(-6px); }
    }

    .care-title {
        font-size: 1.45rem;
        font-weight: 600;
        color: #2D4A5E;
        text-align: center;
        margin: 0.8rem 0 0.2rem;
        letter-spacing: -0.01em;
    }

    .care-phrase {
        font-size: 0.95rem;
        color: #5A7A8C;
        text-align: center;
        line-height: 1.5;
        margin-bottom: 2rem;
        padding: 0 0.3rem;
    }

    .care-field-group {
        margin-bottom: 1.2rem;
    }

    .care-label {
        display: block;
        font-size: 0.88rem;
        color: #3D5A6E;
        margin-bottom: 0.4rem;
        font-weight: 500;
        letter-spacing: 0.01em;
    }

    .care-label em {
        font-style: normal;
        color: #7C9EB2;
        font-weight: 400;
    }

    .care-input {
        width: 100%;
        padding: 0.7rem 0.9rem;
        border: 1.5px solid #D5E0E8;
        border-radius: 10px;
        font-size: 0.95rem;
        color: #2D4A5E;
        background: white;
        transition: border-color 0.2s, box-shadow 0.2s;
        outline: none;
    }

    .care-input:focus {
        border-color: var(--care-primary);
        box-shadow: 0 0 0 3px rgba(124, 158, 178, 0.18);
    }

    .care-input::placeholder {
        color: #A8BFC9;
        font-size: 0.9rem;
    }

    .care-error {
        color: var(--care-error);
        font-size: 0.85rem;
        margin-top: 0.35rem;
        padding: 0.4rem 0.7rem;
        background: rgba(232, 144, 122, 0.1);
        border-radius: 6px;
        border-left: 3px solid var(--care-error);
        line-height: 1.4;
    }

    .care-role-group {
        margin: 1.5rem 0;
        padding: 1rem;
        background: rgba(200, 169, 142, 0.08);
        border-radius: 12px;
        border: 1px solid rgba(200, 169, 142, 0.2);
    }

    .care-role-label {
        font-size: 0.88rem;
        color: #5A4A3A;
        margin-bottom: 0.6rem;
        font-weight: 500;
    }

    .care-role-option {
        display: flex;
        align-items: center;
        gap: 0.6rem;
        padding: 0.6rem 0.8rem;
        border: 1.5px solid #E5D8CC;
        border-radius: 10px;
        margin-bottom: 0.5rem;
        cursor: pointer;
        transition: all 0.2s;
        font-size: 0.9rem;
        color: #3D4A4A;
    }

    .care-role-option:hover {
        border-color: var(--care-accent);
        background: rgba(200, 169, 142, 0.06);
    }

    .care-role-option input[type="radio"] {
        accent-color: var(--care-accent);
        width: 16px;
        height: 16px;
        cursor: pointer;
    }

    .care-role-option .care-role-note {
        font-size: 0.78rem;
        color: #A09080;
        margin-left: auto;
    }

    .care-btn {
        width: 100%;
        padding: 0.9rem;
        background: linear-gradient(135deg, var(--care-primary) 0%, #5E8AAE 100%);
        color: white;
        border: none;
        border-radius: 12px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: transform 0.15s, box-shadow 0.2s, opacity 0.2s;
        letter-spacing: 0.02em;
        position: relative;
        overflow: hidden;
    }

    .care-btn:hover:not(:disabled) {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(124, 158, 178, 0.35);
    }

    .care-btn:active:not(:disabled) {
        transform: scale(0.98);
    }

    .care-btn:disabled {
        opacity: 0.7;
        cursor: wait;
    }

    .care-btn .care-btn-text {
        transition: opacity 0.2s;
    }

    .care-btn .care-btn-loading {
        position: absolute;
        inset: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.6rem;
        opacity: 0;
        transition: opacity 0.2s;
    }

    .care-btn.loading .care-btn-text { opacity: 0; }
    .care-btn.loading .care-btn-loading { opacity: 1; }

    .care-spinner {
        width: 18px;
        height: 18px;
        border: 2.5px solid rgba(255,255,255,0.35);
        border-top-color: white;
        border-radius: 50%;
        animation: care-spin 0.8s linear infinite;
    }

    @keyframes care-spin {
        to { transform: rotate(360deg); }
    }

    .care-footer {
        text-align: center;
        margin-top: 1.5rem;
        font-size: 0.9rem;
        color: #5A7A8C;
    }

    .care-footer a {
        color: var(--care-primary);
        font-weight: 600;
        text-decoration: none;
    }

    .care-footer a:hover {
        text-decoration: underline;
    }

    /* ── Modal écran de succès (transition) ── */
    .care-success-overlay {
        position: fixed;
        inset: 0;
        background: rgba(214, 228, 239, 0.7);
        backdrop-filter: blur(6px);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 999;
        animation: fade-in 0.35s ease;
    }

    @keyframes fade-in {
        from { opacity: 0; }
        to   { opacity: 1; }
    }

    .care-success-card {
        background: white;
        border-radius: 20px;
        padding: 2.5rem 2rem;
        max-width: 380px;
        text-align: center;
        box-shadow: 0 12px 40px rgba(124, 158, 178, 0.25);
        animation: pop-in 0.4s cubic-bezier(0.2, 0.8, 0.2, 1);
    }

    @keyframes pop-in {
        from { transform: scale(0.85); opacity: 0; }
        to   { transform: scale(1);    opacity: 1; }
    }

    .care-success-emoji {
        font-size: 3.5rem;
        margin-bottom: 0.8rem;
        animation: gentle-float 3s ease-in-out infinite;
    }

    .care-success-title {
        font-size: 1.2rem;
        font-weight: 600;
        color: #2D4A5E;
        margin-bottom: 0.5rem;
    }

    .care-success-message {
        font-size: 0.95rem;
        color: #5A7A8C;
        line-height: 1.6;
        margin-bottom: 1.5rem;
    }

    .care-success-btn {
        padding: 0.8rem 2rem;
        background: var(--care-success);
        color: white;
        border: none;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.95rem;
        cursor: pointer;
        transition: background 0.2s;
    }

    .care-success-btn:hover {
        background: #6AAA90;
    }

    .care-dont-show {
        display: none;
    }
</style>

<div class="care-wrap">
    <!-- Illustration apaisante (plante/sunrise) -->
    <svg class="care-illustration" viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
        <circle cx="100" cy="60" r="35" fill="#F0D9A8" opacity="0.6"/>
        <circle cx="100" cy="60" r="25" fill="#F5E4B8" opacity="0.7"/>
        <path d="M100 95 C 80 115, 75 145, 90 170 C 95 178, 105 178, 110 170 C 125 145, 120 115, 100 95Z" fill="#6DA39A" opacity="0.7"/>
        <path d="M100 130 C 85 140, 80 155, 90 170" stroke="#4D8577" stroke-width="2" fill="none" opacity="0.6"/>
        <path d="M100 110 L 85 125" stroke="#4D8577" stroke-width="2" fill="none" opacity="0.5"/>
        <path d="M100 110 L 115 125" stroke="#4D8577" stroke-width="2" fill="none" opacity="0.5"/>
        <circle cx="140" cy="80" r="6" fill="#F0D9A8" opacity="0.5"/>
        <circle cx="70" cy="75" r="4" fill="#F0D9A8" opacity="0.4"/>
    </svg>

    <div class="care-card">
        <div class="care-emoji-top">🌱</div>
        <h2 class="care-title">Bienvenue dans ton espace sécurisé</h2>
        <p class="care-phrase">
            <em>Bravo.</em> Faire le premier pas et décider d'en parler est toujours le plus difficile.<br>
            Tu es exactement là où tu dois être.
        </p>

        <form id="careForm" method="POST" action="/inscription" novalidate>
            @csrf

            {{-- Nom / Pseudo --}}
            <div class="care-field-group">
                <label class="care-label" for="care_name">
                    Comment veux-tu qu'on t'appelle ici ?<br>
                    <em>(Choisis un pseudo pour rester 100% anonyme)</em>
                </label>
                <input type="text" id="care_name" name="name"
                    placeholder="Par exemple : Léa, Sof, Luna..."
                    class="care-input"
                    value="{{ old('name') }}"
                    required
                    maxlength="50">
                <div id="care-name-error" class="care-error" style="display:none;"></div>
            </div>

            {{-- Email --}}
            <div class="care-field-group">
                <label class="care-label" for="care_email">
                    On a besoin d'un moyen de te retrouver, juste en cas.<br>
                    <em>(Reste confidentiel, promis.)</em>
                </label>
                <input type="email" id="care_email" name="email"
                    placeholder="toutovich@exemple.fr"
                    class="care-input"
                    value="{{ old('email') }}"
                    required>
                <div id="care-email-error" class="care-error" style="display:none;"></div>
            </div>

            {{-- Mot de passe --}}
            <div class="care-field-group">
                <label class="care-label" for="care_password">
                    Choisis un mot de passe solide.<br>
                    <em>(Il gardera ton jardin secret bien fermé.)</em>
                </label>
                <input type="password" id="care_password" name="password"
                    placeholder="••••••••"
                    class="care-input"
                    required
                    minlength="6">
                <div id="care-password-error" class="care-error" style="display:none;"></div>
            </div>

            {{-- Confirmation mot de passe --}}
            <div class="care-field-group">
                <label class="care-label" for="care_password_confirmation">
                    On recommence pour être sûrs d'être bien-alignés.<br>
                    <em>(Répète ton mot de passe pour confirmation.)</em>
                </label>
                <input type="password" id="care_password_confirmation" name="password_confirmation"
                    placeholder="••••••••"
                    class="care-input"
                    required
                    minlength="6">
            </div>

            {{-- Rôle --}}
            <div class="care-role-group">
                <div class="care-role-label">Je m'inscris en tant que :</div>
                <label class="care-role-option">
                    <input type="radio" name="role_choisi" value="jeune" checked>
                    <strong>Membre</strong> <span style="color:#7A8A9A; font-size:0.8rem;">(étudiant)</span>
                </label>
                <label class="care-role-option">
                    <input type="radio" name="role_choisi" value="pair-aidant">
                    <strong>Pair-aidant</strong>
                    <span class="care-role-note">validation admin requise</span>
                </label>
                <label class="care-role-option">
                    <input type="radio" name="role_choisi" value="psychologue">
                    <strong>Psychologue</strong>
                    <span class="care-role-note">validation admin requise</span>
                </label>
            </div>

            {{-- Bouton avec animation de chargement --}}
            <button type="submit" id="careSubmitBtn" class="care-btn">
                <span class="care-btn-text">Je franchis le pas</span>
                <span class="care-btn-loading">
                    <span class="care-spinner"></span>
                    Création de ton espace…
                </span>
            </button>
        </form>

        <div class="care-footer">
            Déjà un compte ? <a href="/connexion">Se connecter</a>
        </div>
    </div>
</div>

{{-- ── Modal écran de succès (caché par défaut) ── --}}
<div id="careSuccessOverlay" class="care-success-overlay care-dont-show">
    <div class="care-success-card">
        <div class="care-success-emoji">🎉</div>
        <h3 class="care-success-title">C'est fait !</h3>
        <p class="care-success-message">
            Nous sommes fiers de t'accueillir.<br>
            <em>Respire un grand coup, et allons-y ensemble.</em>
        </p>
        <button id="careSuccessBtn" class="care-success-btn">Continuer vers l'espace</button>
    </div>
</div>

<script>
    // ── Care Design : validation douce côté client ──
    const form = document.getElementById('careForm');
    const submitBtn = document.getElementById('careSubmitBtn');
    const nameInput  = document.getElementById('care_name');
    const emailInput = document.getElementById('care_email');
    const passInput  = document.getElementById('care_password');
    const passConf   = document.getElementById('care_password_confirmation');

    function hideError(id) {
        document.getElementById(id).style.display = 'none';
    }
    function showError(id, msg) {
        const el = document.getElementById(id);
        el.textContent = msg;
        el.style.display = 'block';
    }

    function validateField(input, errorId, check, msg) {
        if (check(input.value)) {
            hideError(errorId);
            return true;
        } else {
            showError(errorId, msg);
            return false;
        }
    }

    nameInput.addEventListener('blur', () => validateField(nameInput, 'care-name-error',
        v => v.trim().length >= 2, "Hmm, un petitpseudo de 2 lettres minimum pour qu'on te reconnaîsse."));
    emailInput.addEventListener('blur', () => validateField(emailInput, 'care-email-error',
        v => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v), "Cet email a l'air… peu conventionnel. Une petite recheck ?"));
    passInput.addEventListener('blur', () => validateField(passInput, 'care-password-error',
        v => v.length >= 6, "Oups, le mot de passe est un peu trop court. Ajoute quelques caractères de plus pour être bien protégé !"));

    passConf.addEventListener('input', () => {
        const passVal = passInput.value.trim();
        const confVal = passConf.value.trim();
        if (confVal && confVal !== passVal) {
            showError('care-password-error', "Les deux mots de passe ne sont pas identiques. On les aligne ?");
        } else if (confVal === passVal && confVal.length >= 6) {
            hideError('care-password-error');
        }
    });

    // ── Soumission avec animation douce ──
    form.addEventListener('submit', function(e) {
        // Validation rapide
        const isNameOk  = nameInput.value.trim().length >= 2;
        const isEmailOk = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailInput.value);
        const isPassOk  = passInput.value.length >= 6;
        const isPassConfOk = passConf.value.trim() === passInput.value.trim() && passConf.value.trim().length >= 6;

        if (!isNameOk) { showError('care-name-error', "Un petit pseudo de 2 lettres minimum pour qu'on te reconnaîsse."); nameInput.focus(); return; }
        if (!isEmailOk) { showError('care-email-error', "Cet email a l'air… peu conventionnel. Une petite recheck ?"); emailInput.focus(); return; }
        if (!isPassOk)  { showError('care-password-error', "Oups, le mot de passe est un peu trop court. Ajoute quelques caractères de plus pour être bien protégé !"); passInput.focus(); return; }
        if (!isPassConfOk) { showError('care-password-error', "Les deux mots de passe ne sont pas identiques. On les aligne ?"); passConf.focus(); return; }

        // Animation de chargement
        submitBtn.classList.add('loading');
        submitBtn.disabled = true;
    });

    // ── Modal succès (géré par Laravel qui affiche welcome via session) ──
    // Après redirection vers /, Laravel affiche le message. On affiche aussi la modal.
    // Si on arrive sur / avec session('welcome'), on affiche la modal automatiquement.
    document.addEventListener('DOMContentLoaded', function() {
        const welcomeMsg = @json(session('welcome') ?? '');
        if (welcomeMsg) {
            document.getElementById('careSuccessOverlay').classList.remove('care-dont-show');
            document.getElementById('careSuccessBtn').addEventListener('click', function() {
                document.getElementById('careSuccessOverlay').classList.add('care-dont-show');
            });
        }
    });
</script>
@endsection
