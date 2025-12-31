<div class="cart-page">
    <h1>Mon Panier</h1>

    <?php if (isset($message)): ?>
        <div class="alert alert-<?= $messageType ?>">
            <?= htmlspecialchars($message) ?>
        </div>
    <?php endif; ?>

    <?php if (empty($cartItems)): ?>
        <div class="empty-cart">
            <p>Votre panier est vide</p>
            <a href="/mini_mvc/public/" class="btn-continue">Continuer mes achats</a>
        </div>
    <?php else: ?>
        <div class="cart-container">
            
            <!-- Liste des articles -->
            <div class="cart-items">
                <?php foreach ($cartItems as $item): ?>
                    <div class="cart-item">
                        <img src="/mini_mvc/public/image/product/<?= htmlspecialchars($item['image']) ?>" 
                             alt="<?= htmlspecialchars($item['nom']) ?>">
                        
                        <div class="item-details">
                            <h3><?= htmlspecialchars($item['nom']) ?></h3>
                            <p class="item-category">
                                Catégorie: <?= htmlspecialchars($item['categorie_nom'] ?? 'Non classé') ?>
                            </p>
                            <p>Prix unitaire: <?= number_format($item['prix'], 2) ?> €</p>
                            
                            <!-- Formulaire de mise à jour de la quantité -->
                            <form method="POST" action="/mini_mvc/public/cart/update" class="quantity-form">
                                <input type="hidden" name="cart_id" value="<?= $item['panier_id'] ?>">
                                <label for="quantity-<?= $item['panier_id'] ?>">Quantité:</label>
                                <input type="number" 
                                       id="quantity-<?= $item['panier_id'] ?>" 
                                       name="quantite" 
                                       value="<?= $item['quantite'] ?>" 
                                       min="1" 
                                       max="<?= $item['stock'] ?>">
                                <button type="submit" class="btn-update">Mettre à jour</button>
                            </form>
                            
                            <p class="stock-info">Stock disponible: <?= $item['stock'] ?></p>
                            <p class="item-total">
                                Total: <?= number_format($item['prix'] * $item['quantite'], 2) ?> €
                            </p>
                        </div>

                        <form method="POST" action="/mini_mvc/public/cart/remove" 
                              onsubmit="return confirm('Supprimer cet article ?')">
                            <input type="hidden" name="cart_id" value="<?= $item['panier_id'] ?>">
                            <button type="submit" class="btn-remove">Supprimer</button>
                        </form>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Résumé de la commande -->
            <div class="cart-summary">
                <h2>Résumé</h2>
                
                <div class="summary-line">
                    <span>Sous-total:</span>
                    <span><?= number_format($total, 2) ?> €</span>
                </div>

                <div class="summary-line">
                    <span>Livraison:</span>
                    <span>Gratuite</span>
                </div>

                <div class="summary-total">
                    <span>Total:</span>
                    <span><?= number_format($total, 2) ?> €</span>
                </div>

                <form method="POST" action="/mini_mvc/public/orders/create">
                    <input type="hidden" name="user_id" value="<?= $user_id ?>">
                    <button type="submit" class="btn-checkout">
                        Valider la commande
                    </button>
                </form>

                <form method="POST" action="/mini_mvc/public/cart/clear" 
                      onsubmit="return confirm('Vider le panier ?')">
                    <input type="hidden" name="user_id" value="<?= $user_id ?>">
                    <button type="submit" class="btn-clear">
                        Vider le panier
                    </button>
                </form>

                <a href="/mini_mvc/public/" class="btn-continue">
                    Continuer mes achats
                </a>
            </div>

        </div>
    <?php endif; ?>
</div>

<style>
.cart-page {
    max-width: 1200px;
    margin: 50px auto;
    padding: 20px;
}

.cart-page h1 {
    font-size: 32px;
    margin-bottom: 30px;
    font-family: 'Agrandir';
}

/* Styles pour les alertes */
.alert {
    padding: 15px;
    margin-bottom: 20px;
    border-radius: 5px;
    font-family: 'Agrandir';
}

.alert-error {
    background-color: #ffcccc;
    color: #cc0000;
}

.alert-success {
    background-color: #ccffcc;
    color: #008000;
}

.empty-cart {
    text-align: center;
    padding: 50px;
    background-color: white;
    border-radius: 8px;
}

.empty-cart p {
    font-size: 20px;
    margin-bottom: 20px;
    font-family: 'Agrandir';
}

.cart-container {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 30px;
}

.cart-items {
    background-color: white;
    padding: 20px;
    border-radius: 8px;
}

.cart-item {
    display: grid;
    grid-template-columns: 150px 1fr auto;
    gap: 20px;
    padding: 20px;
    border-bottom: 1px solid #ddd;
}

.cart-item:last-child {
    border-bottom: none;
}

.cart-item img {
    width: 150px;
    height: 180px;
    object-fit: cover;
    border-radius: 5px;
}

.item-details h3 {
    margin: 0 0 10px 0;
    font-size: 18px;
    font-family: 'Agrandir';
}

.item-details p {
    margin: 5px 0;
    color: #666;
    font-family: 'Agrandir';
}

.item-category {
    font-size: 14px;
    color: #999;
    font-style: italic;
}

.stock-info {
    font-size: 14px;
    color: #0052CC;
}

.quantity-form {
    display: flex;
    align-items: center;
    gap: 10px;
    margin: 10px 0;
}

.quantity-form input[type="number"] {
    width: 60px;
    padding: 5px;
    border: 1px solid #ddd;
    border-radius: 3px;
    font-family: 'Agrandir';
}

.btn-update {
    padding: 5px 15px;
    background-color: #0052CC;
    color: white;
    border: none;
    border-radius: 3px;
    cursor: pointer;
    font-family: 'Agrandir';
    font-size: 14px;
}

.btn-update:hover {
    background-color: #003d99;
}

.item-total {
    font-weight: bold;
    color: #000;
    font-size: 18px;
    margin-top: 10px;
    font-family: 'Agrandir';
}

.btn-remove {
    background-color: #ff4444;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    height: fit-content;
    align-self: center;
    font-family: 'Agrandir';
}

.btn-remove:hover {
    background-color: #cc0000;
}

.cart-summary {
    background-color: white;
    padding: 30px;
    border-radius: 8px;
    height: fit-content;
}

.cart-summary h2 {
    margin-top: 0;
    margin-bottom: 20px;
    font-family: 'Agrandir';
}

.summary-line {
    display: flex;
    justify-content: space-between;
    margin-bottom: 15px;
    font-size: 16px;
    font-family: 'Agrandir';
}

.summary-total {
    display: flex;
    justify-content: space-between;
    font-size: 22px;
    font-weight: bold;
    margin: 20px 0;
    padding-top: 20px;
    border-top: 2px solid #ddd;
    font-family: 'Agrandir';
}

.btn-checkout,
.btn-clear,
.btn-continue {
    display: block;
    width: 100%;
    padding: 15px;
    text-align: center;
    text-decoration: none;
    border-radius: 5px;
    margin-bottom: 10px;
    font-weight: bold;
    font-family: 'Agrandir';
    border: none;
    cursor: pointer;
    font-size: 16px;
}

.btn-checkout {
    background-color: #0052CC;
    color: white;
}

.btn-checkout:hover {
    background-color: #003d99;
}

.btn-clear {
    background-color: #ff4444;
    color: white;
}

.btn-clear:hover {
    background-color: #cc0000;
}

.btn-continue {
    background-color: #666;
    color: white;
}

.btn-continue:hover {
    background-color: #444;
}

@media (max-width: 768px) {
    .cart-container {
        grid-template-columns: 1fr;
    }
    
    .cart-item {
        grid-template-columns: 100px 1fr;
    }
    
    .btn-remove {
        grid-column: 1 / -1;
        text-align: center;
    }
}
</style>