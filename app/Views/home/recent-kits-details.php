<!-- Section Détails Recent Kits -->

<?php if ($recentKitsDetails): ?>
  <div class="kit-detail-container">

    <div class="left-side-grid">
      <img class="kit-detail-image"
        src="/mini_mvc/public/image/product/<?= htmlspecialchars($recentKitsDetails['image']) ?>">
    </div>

    <div class="right-side-grid">
      <p class="kit-detail-title"><?= htmlspecialchars($recentKitsDetails['name']) ?></p>
      <p class="kit-detail-price"> Price : <?= htmlspecialchars($recentKitsDetails['price']) ?> €</p>
      
      <!-- Formulaire d'ajout au panier -->
      <form method="POST" action="/mini_mvc/public/cart/add">
        <input type="hidden" name="product_id" value="<?= $recentKitsDetails['id'] ?>">
        
        <div class="size-grid">
          <p class="size-title">Size:</p>
          <div class="size-button-container">
            <input type="radio" name="size" value="XS" id="xs" required>
            <label for="xs" class="size-button">XS</label>
            
            <input type="radio" name="size" value="S" id="s">
            <label for="s" class="size-button">S</label>
            
            <input type="radio" name="size" value="M" id="m">
            <label for="m" class="size-button">M</label>
            
            <input type="radio" name="size" value="L" id="l">
            <label for="l" class="size-button">L</label>
            
            <input type="radio" name="size" value="XL" id="xl">
            <label for="xl" class="size-button">XL</label>
            
            <input type="radio" name="size" value="2XL" id="2xl">
            <label for="2xl" class="size-button">2XL</label>
            
            <input type="radio" name="size" value="3XL" id="3xl">
            <label for="3xl" class="size-button">3XL</label>
          </div>
        </div>

        <div class="purchase-row">
          <button type="submit" class="add-to-cart-button">Add to Cart</button>
          <div class="payment-logos">
            <img class="logo-payment" src="/mini_mvc/public/image/logo-visa.png" alt="Visa Logo">
            <img class="logo-payment" src="/mini_mvc/public/image/logo-mastercard.png" alt="Mastercard Logo">
            <img class="logo-payment" src="/mini_mvc/public/image/logo-paypal.png" alt="PayPal Logo">
          </div>
        </div>
      </form>

      <div class="list">
        <details class="list-item" open>
          <summary class="list-header">
            Description
          </summary>
          <div class="list-content">
            <p><?= htmlspecialchars($recentKitsDetails['description']) ?></p>
          </div>
        </details>

        <details class="list-item">
          <summary class="list-header">
            Shipping
          </summary>
          <div class="list-content">
            <p>This item will ship within 2 business days. 
              Please proceed to checkout for shipping options and additional transit times.
            </p>
          </div>
        </details>
      </div>

    </div>
  </div>
<?php endif; ?>

<!-- Section Recommandation -->

<p class="new-in-text">WE RECOMMAND</p>

<div class="product-grid">
  <?php foreach ($newProducts as $product): ?>
    <div class="product-card">
      <img src="/mini_mvc/public/image/product/<?= htmlspecialchars($product['image']) ?>" 
     class="product-image" 
     onclick="window.location.href='/mini_mvc/public/recent-kits-details?id=<?= $product['id'] ?>'">
      <p class="product-price"><?= htmlspecialchars($product['price']) ?> €</p>
      <p class="product-name"><?= htmlspecialchars($product['name']) ?></p>
    </div>
  <?php endforeach; ?>
</div>

<style>
/* Cacher les inputs radio */
.size-button-container input[type="radio"] {
  display: none;
}

/* Style des labels qui ressemblent à des boutons */
.size-button-container label {
  display: inline-block;
  width: 100px;
  height: 40px;
  margin-right: 10px;
  margin-bottom: 10px;
  font-size: 16px;
  border: 2px solid gray;
  background-color: #fff;
  cursor: pointer;
  font-family: 'Aggrandir';
  transition: background-color 0.3s, color 0.3s;
  text-align: center;
  line-height: 40px;
}

/* Style au hover */
.size-button-container label:hover {
  background-color: #f0f0f0;
}

/* Style quand le radio est sélectionné */
.size-button-container input[type="radio"]:checked + label {
  background-color: black;
  color: white;
  border-color: black;
}
</style>