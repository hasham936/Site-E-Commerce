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

        <div class="success-actions">
            <a href="/mini_mvc/public/" class="btn-home">Retour à l'accueil</a>
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
    font-family: 'Agrandir';
}

.success-message {
    font-size: 18px;
    color: #666;
    margin-bottom: 30px;
    font-family: 'Agrandir';
}

.order-info {
    background-color: #f9f9f9;
    padding: 20px;
    border-radius: 8px;
    margin-bottom: 30px;
    text-align: left;
}

.order-info p {
    margin: 10px 0;
    font-size: 16px;
    font-family: 'Agrandir';
}

.success-actions {
    display: flex;
    gap: 15px;
    justify-content: center;
}

.btn-home {
    padding: 15px 30px;
    text-decoration: none;
    border-radius: 5px;
    font-weight: bold;
    background-color: #0052CC;
    color: white;
    font-family: 'Agrandir';
}

.btn-home:hover {
    background-color: #003d99;
}
</style>