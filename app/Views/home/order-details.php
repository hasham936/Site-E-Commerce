<div class="order-details-page">
    <div class="back-link">
        <a href="/mini_mvc/public/orders?user_id=<?= $order['user_id'] ?>">← Retour à mes commandes</a>
    </div>

    <h1>Détails de la commande #<?= $order['id'] ?></h1>

    <?php if (isset($message)): ?>
        <div class="alert alert-<?= $messageType ?>">
            <?= htmlspecialchars($message) ?>
        </div>
    <?php endif; ?>

    <div class="details-container">
        
        <!-- Informations de la commande -->
        <div class="order-infos">
            <h2>Informations générales</h2>
            
            <div class="info-row">
                <span class="info-label">Numéro de commande:</span>
                <span class="info-value">#<?= $order['id'] ?></span>
            </div>

            <div class="info-row">
                <span class="info-label">Date:</span>
                <span class="info-value"><?= date('d/m/Y à H:i', strtotime($order['created_at'])) ?></span>
            </div>

            <div class="info-row">
                <span class="info-label">Statut:</span>
                <span class="status-badge status-<?= strtolower($order['statut']) ?>">
                    <?= htmlspecialchars(ucfirst($order['statut'])) ?>
                </span>
            </div>

            <div class="info-row">
                <span class="info-label">Total:</span>
                <span class="info-value total"><?= number_format($order['total'], 2) ?> €</span>
            </div>
        </div>

        <!-- Informations client -->
        <div class="delivery-infos">
            <h2>Informations client</h2>
            
            <div class="info-row">
                <span class="info-label">Nom:</span>
                <span class="info-value"><?= htmlspecialchars($order['user_nom']) ?></span>
            </div>

            <div class="info-row">
                <span class="info-label">Email:</span>
                <span class="info-value"><?= htmlspecialchars($order['user_email']) ?></span>
            </div>
        </div>
    </div>

    <!-- Liste des produits -->
    <div class="order-products">
        <h2>Produits commandés</h2>
        
        <table class="products-table">
            <thead>
                <tr>
                    <th>Produit</th>
                    <th>Catégorie</th>
                    <th>Prix unitaire</th>
                    <th>Quantité</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($order['products'] as $product): ?>
                    <tr>
                        <td class="product-info">
                            <img src="/mini_mvc/public/image/product/<?= htmlspecialchars($product['image_url']) ?>" 
                                 alt="<?= htmlspecialchars($product['product_nom']) ?>">
                            <span><?= htmlspecialchars($product['product_nom']) ?></span>
                        </td>
                        <td><?= htmlspecialchars($product['categorie_nom'] ?? 'Non classé') ?></td>
                        <td><?= number_format($product['prix_unitaire'], 2) ?> €</td>
                        <td><?= $product['quantite'] ?></td>
                        <td class="product-total">
                            <?= number_format($product['prix_unitaire'] * $product['quantite'], 2) ?> €
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr class="total-row">
                    <td colspan="4">Total de la commande:</td>
                    <td class="grand-total"><?= number_format($order['total'], 2) ?> €</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<style>
.order-details-page {
    max-width: 1200px;
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
    font-family: 'Agrandir';
}

.back-link a:hover {
    text-decoration: underline;
}

.order-details-page h1 {
    font-size: 32px;
    margin-bottom: 30px;
    font-family: 'Agrandir';
}

.alert {
    padding: 15px;
    margin-bottom: 20px;
    border-radius: 5px;
    font-family: 'Agrandir';
}

.alert-success {
    background-color: #ccffcc;
    color: #008000;
}

.details-container {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 30px;
    margin-bottom: 30px;
}

.order-infos,
.delivery-infos,
.order-products {
    background-color: white;
    padding: 30px;
    border-radius: 8px;
}

.order-infos h2,
.delivery-infos h2,
.order-products h2 {
    margin-top: 0;
    margin-bottom: 20px;
    font-family: 'Agrandir';
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
    font-family: 'Agrandir';
}

.info-value {
    color: #333;
    text-align: right;
    font-family: 'Agrandir';
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
    font-family: 'Agrandir';
}

.status-badge.status-en_attente {
    background-color: #fff3cd;
    color: #856404;
}

.status-badge.status-validee {
    background-color: #d4edda;
    color: #155724;
}

.status-badge.status-annulee {
    background-color: #f8d7da;
    color: #721c24;
}

/* Table des produits */
.products-table {
    width: 100%;
    border-collapse: collapse;
    font-family: 'Agrandir';
}

.products-table thead {
    background-color: #f5f5f5;
}

.products-table th,
.products-table td {
    padding: 15px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

.products-table th {
    font-weight: bold;
    color: #333;
}

.product-info {
    display: flex;
    align-items: center;
    gap: 15px;
}

.product-info img {
    width: 60px;
    height: 75px;
    object-fit: cover;
    border-radius: 5px;
}

.product-total {
    font-weight: bold;
}

.products-table tfoot {
    background-color: #f5f5f5;
}

.total-row td {
    font-weight: bold;
    font-size: 18px;
    padding: 20px 15px;
}

.grand-total {
    color: #0052CC;
    font-size: 22px;
}

@media (max-width: 768px) {
    .details-container {
        grid-template-columns: 1fr;
    }
    
    .products-table {
        font-size: 14px;
    }
    
    .product-info img {
        width: 40px;
        height: 50px;
    }
}
</style>