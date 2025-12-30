<div class="order-details-page">
    <div class="back-link">
        <a href="/mini_mvc/public/order/history">← Retour à mes commandes</a>
    </div>

    <h1>Détails de la commande #<?= $order['id'] ?></h1>

    <div class="details-container">
        
        <!-- Informations de la commande -->
        <div class="order-infos">
            <h2>Informations générales</h2>
            
            <div class="info-row">
                <span class="info-label">Numéro de commande :</span>
                <span class="info-value">#<?= $order['id'] ?></span>
            </div>

            <div class="info-row">
                <span class="info-label">Date :</span>
                <span class="info-value"><?= date('d/m/Y à H:i', strtotime($order['created_at'])) ?></span>
            </div>

            <div class="info-row">
                <span class="info-label">Statut :</span>
                <span class="status-badge <?= strtolower(str_replace(' ', '-', $order['status'])) ?>">
                    <?= htmlspecialchars($order['status']) ?>
                </span>
            </div>

            <div class="info-row">
                <span class="info-label">Total :</span>
                <span class="info-value total"><?= number_format($order['total'], 2) ?> €</span>
            </div>
        </div>

        <!-- Informations de livraison -->
        <div class="delivery-infos">
            <h2>Informations de livraison</h2>
            
            <div class="info-row">
                <span class="info-label">Nom :</span>
                <span class="info-value"><?= htmlspecialchars($order['fullname']) ?></span>
            </div>

            <div class="info-row">
                <span class="info-label">Adresse :</span>
                <span class="info-value"><?= htmlspecialchars($order['address']) ?></span>
            </div>

            <div class="info-row">
                <span class="info-label">Code postal :</span>
                <span class="info-value"><?= htmlspecialchars($order['zipcode']) ?></span>
            </div>

            <div class="info-row">
                <span class="info-label">Ville :</span>
                <span class="info-value"><?= htmlspecialchars($order['city']) ?></span>
            </div>

            <div class="info-row">
                <span class="info-label">Téléphone :</span>
                <span class="info-value"><?= htmlspecialchars($order['phone']) ?></span>
            </div>

            <div class="info-row">
                <span class="info-label">Mode de paiement :</span>
                <span class="info-value"><?= htmlspecialchars($order['payment_method']) ?></span>
            </div>
        </div>

    </div>
</div>

<style>
.order-details-page {
    max-width: 1000px;
    margin: 50px auto;
    padding: 20px;
}

.back-link {
    margin-bottom: 20px;
}

.back-link a {
    color: #0052CC;
    text-decoration: none;
    font-weight: bold;
}

.back-link a:hover {
    text-decoration: underline;
}

.order-details-page h1 {
    font-size: 32px;
    margin-bottom: 30px;
}

.details-container {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 30px;
}

/* Sections d'infos */
.order-infos,
.delivery-infos {
    background-color: white;
    padding: 30px;
    border-radius: 8px;
}

.order-infos h2,
.delivery-infos h2 {
    margin-top: 0;
    margin-bottom: 20px;
}

.info-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
    padding-bottom: 15px;
    border-bottom: 1px solid #eee;
}

.info-row:last-child {
    border-bottom: none;
}

.info-label {
    font-weight: bold;
    color: #666;
}

.info-value {
    color: #333;
    text-align: right;
}

.info-value.total {
    font-size: 24px;
    font-weight: bold;
    color: #0052CC;
}

.status-badge {
    padding: 6px 12px;
    border-radius: 15px;
    font-size: 14px;
    font-weight: bold;
}

.status-badge.en-attente {
    background-color: #fff3cd;
    color: #856404;
}

.status-badge.en-cours {
    background-color: #cce5ff;
    color: #004085;
}

.status-badge.livree {
    background-color: #d4edda;
    color: #155724;
}

@media (max-width: 768px) {
    .details-container {
        grid-template-columns: 1fr;
    }
}
</style>