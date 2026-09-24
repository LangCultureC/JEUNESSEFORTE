<!-- Widget de Don Latéral - JeunesseForte -->
<!-- Ce widget est visible sur TOUTES les pages, sans connexion -->
<div id="don-widget" style="position: fixed; top: 80px; right: 20px; width: 320px; background: white; border-radius: 16px; box-shadow: 0 10px 40px rgba(0,0,0,0.15); padding: 20px; z-index: 200; border: 2px solid #C8963E;">

    <!-- En-tête du widget -->
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:15px;">
        <div>
            <span style="background:#C8963E;color:white;padding:4px 10px;border-radius:20px;font-weight:700;font-size:0.75rem;">SOUTIEN</span>
        </div>
        <button onclick="toggleDonPanel()" style="background:none;border:none;cursor:pointer;font-size:1.2rem;color:#64748B;">⛏️</button>
    </div>

    <!-- Contenu principal -->
    <div style="font-family:'Plus Jakarta Sans',sans-serif;">
        <!-- Titre + Description -->
        <h3 style="font-size:1.1rem;color:#1A5C3A;font-weight:700;margin-bottom:5px;">Faire un don</h3>
        <p style="font-size:0.8rem;color:#64748B;margin-bottom:15px;line-height:1.4;">
            Soutenez JeunesseForte pour accompagner les étudiants en détresse psychologique au Burkina Faso.
        </p>

        <!-- Bouton de donation rapide -->
        <button onclick="showDonForm()" style="width:100%;background:#1A5C3A;color:white;padding:12px;border:none;border-radius:12px;font-weight:700;font-size:1rem;cursor:pointer;margin-bottom:15px;transition:background 0.2s;">
            🤝 Faire un don maintenant
        </button>

        <!-- Forme de don (masquée par défaut) -->
        <div id="don-form" style="display:none;background:#F8FAFC;border-radius:12px;padding:15px;">

            <!-- Montant -->
            <label style="font-size:0.85rem;font-weight:600;color:#0F172A;display:block;margin-bottom:5px;">Montant (FCFA)</label>
            <div style="display:flex;gap:8px;margin-bottom:12px;flex-wrap:wrap;">
                <button onclick="setMontant(1000)" style="background:white;border:1px solid #E2E8F0;padding:8px 12px;border-radius:8px;font-weight:600;font-size:0.85rem;cursor:pointer;">1 000 ₣</button>
                <button onclick="setMontant(2500)" style="background:white;border:1px solid #E2E8F0;padding:8px 12px;border-radius:8px;font-weight:600;font-size:0.85rem;cursor:pointer;">2 500 ₣</button>
                <button onclick="setMontant(5000)" style="background:white;border:1px solid #E2E8F0;padding:8px 12px;border-radius:8px;font-weight:600;font-size:0.85rem;cursor:pointer;">5 000 ₣</button>
                <button onclick="setMontant(10000)" style="background:white;border:1px solid #E2E8F0;padding:8px 12px;border-radius:8px;font-weight:600;font-size:0.85rem;cursor:pointer;">10 000 ₣</button>
            </div>
            <input type="number" id="don-montant" min="100" step="100" placeholder="Montant en FCFA" style="width:100%;padding:10px;border:1px solid #E2E8F0;border-radius:8px;font-size:1rem;outline:none;">

            <!-- Méthodes de paiement -->
            <label style="font-size:0.85rem;font-weight:600;color:#0F172A;display:block;margin-bottom:8px;">Méthode de paiement</label>
            <div style="display:flex;flex-direction:column;gap:6px;margin-bottom:15px;">
                <!-- Orange Money -->
                <label style="display:flex;align-items:center;gap:10px;padding:8px 12px;background:white;border:1px solid #E2E8F0;border-radius:8px;cursor:pointer;">
                    <input type="radio" name="payment" value="orange" style="accent-color:#FF6600;">
                    <span style="font-weight:600;">🟠 Orange Money</span>
                    <span style="margin-left:auto;font-size:0.75rem;color:#64748B;">Burkina Faso</span>
                </label>
                <!-- Moov Money -->
                <label style="display:flex;align-items:center;gap:10px;padding:8px 12px;background:white;border:1px solid #E2E8F0;border-radius:8px;cursor:pointer;">
                    <input type="radio" name="payment" value="moov" style="accent-color:#0099FF;">
                    <span style="font-weight:600;">🔵 Moov Money</span>
                    <span style="margin-left:auto;font-size:0.75rem;color:#64748B;">Burkina Faso</span>
                </label>
                <!-- Telecel Money -->
                <label style="display:flex;align-items:center;gap:10px;padding:8px 12px;background:white;border:1px solid #E2E8F0;border-radius:8px;cursor:pointer;">
                    <input type="radio" name="payment" value="telecel" style="accent-color:#00C4CC;">
                    <span style="font-weight:600;">🟢 Telecel Money</span>
                    <span style="margin-left:auto;font-size:0.75rem;color:#64748B;">Burkina Faso</span>
                </label>
                <!-- Carte Bancaire -->
                <label style="display:flex;align-items:center;gap:10px;padding:8px 12px;background:white;border:1px solid #E2E8F0;border-radius:8px;cursor:pointer;">
                    <input type="radio" name="payment" value="carte" style="accent-color:#333333;">
                    <span style="font-weight:600;">💳 Carte Bancaire (Visa/Mastercard)</span>
                </label>
                <!-- PayPal -->
                <label style="display:flex;align-items:center;gap:10px;padding:8px 12px;background:white;border:1px solid #E2E8F0;border-radius:8px;cursor:pointer;">
                    <input type="radio" name="payment" value="paypal" style="accent-color:#0070BA;">
                    <span style="font-weight:600;">🅿️ PayPal (International)</span>
                </label>
                <!-- Western Union -->
                <label style="display:flex;align-items:center;gap:10px;padding:8px 12px;background:white;border:1px solid #E2E8F0;border-radius:8px;cursor:pointer;">
                    <input type="radio" name="payment" value="westernunion" style="accent-color:#582F1E;">
                    <span style="font-weight:600;">🌍 Western Union (International)</span>
                </label>
            </div>

            <!-- Boutons d'action -->
            <div style="display:flex;gap:8px;">
                <button onclick="closeDonForm()" style="flex:1;background:#E2E8F0;color:#0F172A;border:none;padding:10px;border-radius:8px;font-weight:600;cursor:pointer;">Annuler</button>
                <button onclick="processDon()" style="flex:2;background:#C8963E;color:white;border:none;padding:10px;border-radius:8px;font-weight:700;cursor:pointer;">
                    Confirmer le don
                </button>
            </div>
        </div>

        <!-- Messages de confirmation -->
        <div id="don-message" style="display:none;background:#d4edda;border:2px solid #28a745;border-radius:12px;padding:12px;margin-top:10px;"></div>
    </div>
</div>

<style>
    /* Animation d'ouverture/fermeture */
    #don-widget {
        transition: transform 0.3s ease, opacity 0.3s ease;
    }
    @media (max-width: 768px) {
        #don-widget {
            position: fixed;
            top: auto;
            bottom: 0;
            right: 0;
            left: 0;
            width: 100%;
            border-radius: 16px 16px 0 0;
            box-shadow: 0 -10px 40px rgba(0,0,0,0.15);
            max-height: 80vh;
            overflow-y: auto;
        }
    }
</style>

<script>
    // Variables globales
    let montantSelected = 5000;
    let paymentMethod = 'orange';

    // Toggle panel
    function toggleDonPanel() {
        const panel = document.getElementById('don-form');
        panel.style.display = panel.style.display === 'none' ? 'block' : 'none';
    }

    // Show form
    function showDonForm() {
        document.getElementById('don-form').style.display = 'block';
    }

    // Close form
    function closeDonForm() {
        document.getElementById('don-form').style.display = 'none';
    }

    // Set montant
    function setMontant(montant) {
        montantSelected = montant;
        document.getElementById('don-montant').value = montant;
    }

    // Process don
    function processDon() {
        const montant = document.getElementById('don-montant').value;
        if (!montant || montant < 100) {
            alert('Veuillez entrer un montant valide (minimum 100 FCFA)');
            return;
        }

        const selectedPayment = document.querySelector('input[name="payment"]:checked');
        if (!selectedPayment) {
            alert('Veuillez sélectionner une méthode de paiement');
            return;
        }

        const payment = selectedPayment.value;
        const messageDiv = document.getElementById('don-message');

        // Simulation de confirmation (à remplacer par un vrai traitement)
        const messages = {
            'orange': {
                title: '✅ Don Orange Money confirmé',
                text: `Un SMS va vous être envoyé pour finaliser le virement de ${montant} FCFA vers Orange Money.`
            },
            'moov': {
                title: '✅ Don Moov Money confirmé',
                text: `Un SMS va vous être envoyé pour finaliser le virement de ${montant} FCFA vers Moov Money.`
            },
            'telecel': {
                title: '✅ Don Telecel Money confirmé',
                text: `Un SMS va vous être envoyé pour finaliser le virement de ${montant} FCFA vers Telecel Money.`
            },
            'carte': {
                title: '✅ Paiement par carte confirmé',
                text: `Vous allez être redirigé vers la page de paiement sécurisé pour finaliser le don de ${montant} FCFA.`
            },
            'paypal': {
                title: '✅ Don PayPal confirmé',
                text: `Vous allez être redirigé vers PayPal pour finaliser le don de ${montant} FCFA.`
            },
            'westernunion': {
                title: '✅ Don Western Union confirmé',
                text: `Vous allez recevoir les instructions par email pour envoyer ${montant} FCFA via Western Union.`
            }
        };

        const msg = messages[payment] || { title: '✅ Don confirmé', text: `Merci pour votre soutien de ${montant} FCFA !` };

        messageDiv.style.display = 'block';
        messageDiv.innerHTML = `<b>${msg.title}</b><br>${msg.text}`;
        messageDiv.style.animation = 'fadeIn 0.3s';

        // Reset
        montantSelected = 0;
        document.getElementById('don-montant').value = '';
    }

    // Animation fadeIn
    const style = document.createElement('style');
    style.textContent = `
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    `;
    document.head.appendChild(style);
</script>
