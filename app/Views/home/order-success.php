<div class="success-page">
    <div class="success-container">
        
        <div class="success-icon">
            ✓
        </div>

        <h1>Commande confirmée !</h1>
        <p class="success-message">Merci pour votre commande. Nous avons bien reçu votre demande.</p>

        <div class="order-info">
            <p><strong>Numéro de commande :</strong> #<?= $order['id'] ?></p>
            <p><strong>Date :</strong> <?= date('d/m/Y H:i', strtotime($order['created_at'])) ?></p>
            <p><strong>Total :</strong> <?= number_format($order['total'], 2) ?> €</p>
            <p><strong>Statut :</strong> <?= htmlspecialchars($order['status']) ?></p>
        </div>

        <div class="delivery-info">
            <h3>Informations de livraison</h3>
            <p><strong>Nom :</strong> <?= htmlspecialchars($order['fullname']) ?></p>
            <p><strong>Adresse :</strong> <?= htmlspecialchars($order['address']) ?></p>
            <p><strong>Code postal :</strong> <?= htmlspecialchars($order['zipcode']) ?></p>
            <p><strong>Ville :</strong> <?= htmlspecialchars($order['city']) ?></p>
            <p><strong>Téléphone :</strong> <?= htmlspecialchars($order['phone']) ?></p>
            <p><strong>Mode de paiement :</strong> <?= htmlspecialchars($order['payment_method']) ?></p>
        </div>

        <div class="success-actions">
            <a href="/mini_mvc/public/" class="btn-home">Retour à l'accueil</a>
            <a href="/mini_mvc/public/order/history" class="btn-orders">Voir mes commandes</a>
        </div>

    </div>
</div>

<style>
.success-page {
    min-height: 80vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
}

.success-container {
    max-width: 700px;
    background-color: white;
    padding: 50px;
    border-radius: 10px;
    text-align: center;
}

.success-icon {
    width: 100px;
    height: 100px;
    background-color: #4CAF50;
    color: white;
    font-size: 60px;
    line-height: 100px;
    border-radius: 50%;
    margin: 0 auto 30px;
}

.success-container h1 {
    font-size: 32px;
    color: #333;
    margin-bottom: 15px;
}

.success-message {
    font-size: 18px;
    color: #666;
    margin-bottom: 30px;
}

.order-info {
    background-color: #f9f9f9;
    padding: 20px;
    border-radius: 8px;
    margin-bottom: 20px;
    text-align: left;
}

.order-info p {
    margin: 10px 0;
    font-size: 16px;
}

.delivery-info {
    background-color: #f0f8ff;
    padding: 20px;
    border-radius: 8px;
    margin-bottom: 30px;
    text-align: left;
}

.delivery-info h3 {
    margin-top: 0;
    margin-bottom: 15px;
    color: #0052CC;
}

.delivery-info p {
    margin: 8px 0;
    font-size: 15px;
}

.success-actions {
    display: flex;
    gap: 15px;
    justify-content: center;
}

.btn-home,
.btn-orders {
    padding: 15px 30px;
    text-decoration: none;
    border-radius: 5px;
    font-weight: bold;
}

.btn-home {
    background-color: #666;
    color: white;
}

.btn-home:hover {
    background-color: #444;
}

.btn-orders {
    background-color: #0052CC;
    color: white;
}

.btn-orders:hover {
    background-color: #003d99;
}
</style>