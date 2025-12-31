<div class="cart-page">
    <h1>Mon Panier</h1>

    <?php if (isset($message) && $message): ?>
        <div class="alert alert-<?= $messageType === 'success' ? 'success' : 'error' ?>">
            <?= htmlspecialchars($message) ?>
        </div>
    <?php endif; ?>

    <?php if (empty($cartItems)): ?>
        <div class="empty-cart">
            <p>Votre panier est vide</p>
            <a href="/mini_mvc/public/" class="button-continue">Continuer mes achats</a>
        </div>
    <?php else: ?>
        <div class="cart-container">
            
            <!-- Liste des articles -->
            <div class="cart-items">
                <?php foreach ($cartItems as $item): ?>
                    <div class="cart-item">
                        <img src="/mini_mvc/public/image/product/<?= htmlspecialchars($item['image']) ?>" 
                             alt="<?= htmlspecialchars($item['name']) ?>">
                        
                        <div class="item-details">
                            <h3><?= htmlspecialchars($item['name']) ?></h3>
                            <?php if (isset($item['size']) && $item['size']): ?>
                                <p>Taille : <?= htmlspecialchars($item['size']) ?></p>
                            <?php endif; ?>
                            <p>Prix unitaire : <?= htmlspecialchars($item['price']) ?> €</p>
                            <p>Quantité : <?= htmlspecialchars($item['quantity']) ?></p>
                            <p class="item-total">
                                Total : <?= number_format($item['price'] * $item['quantity'], 2) ?> €
                            </p>
                        </div>

                        <form method="POST" action="/mini_mvc/public/cart/remove" style="display: inline;">
                            <input type="hidden" name="cart_id" value="<?= $item['cart_id'] ?>">
                            <button type="submit" class="button-remove">
                                Supprimer
                            </button>
                        </form>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Résumé de la commande -->
            <div class="cart-summary">
                <h2>Résumé</h2>
                
                <div class="summary-line">
                    <span>Sous-total :</span>
                    <span><?= number_format($total, 2) ?> €</span>
                </div>

                <div class="summary-line">
                    <span>Livraison :</span>
                    <span>Gratuite</span>
                </div>

                <div class="summary-total">
                    <span>Total :</span>
                    <span><?= number_format($total, 2) ?> €</span>
                </div>

                <form method="POST" action="/mini_mvc/public/orders/create">
                    <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?? 1 ?>">
                    <button type="submit" class="button-checkout">
                        Passer la commande
                    </button>
                </form>

                <form method="POST" action="/mini_mvc/public/cart/clear" style="margin-top: 10px;">
                    <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?? 1 ?>">
                    <button type="submit" class="button-clear">
                        Vider le panier
                    </button>
                </form>

                <a href="/mini_mvc/public/" class="button-continue">
                    Continuer mes achats
                </a>
            </div>

        </div>
    <?php endif; ?>
</div>