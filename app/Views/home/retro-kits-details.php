<!-- Section Détails Retro Kits -->

<?php if ($retroKitsDetails): ?>
  <div class="kit-detail-container">

    <div class="left-side-grid">
      <img class="kit-detail-image"
        src="/mini_mvc/public/image/product/<?= htmlspecialchars($retroKitsDetails['image']) ?>">
    </div>

    <div class="right-side-grid">
      <p class="kit-detail-title"><?= htmlspecialchars($retroKitsDetails['name']) ?></p>
      <p class="kit-detail-price"> Price : <?= htmlspecialchars($retroKitsDetails['price']) ?> €</p>
      
      <!-- Formulaire d'ajout au panier -->
      <form method="POST" action="/mini_mvc/public/cart/add-from-form">        
        <input type="hidden" name="product_id" value="<?= $retroKitsDetails['id'] ?>">
        <div class="size-grid">
          <p class="size-title">Size:</p>
          <div class="size-button-container">
            <input type="radio" name="size" value="XS" id="xs-retro" required>
            <label for="xs-retro" class="size-button">XS</label>
            
            <input type="radio" name="size" value="S" id="s-retro">
            <label for="s-retro" class="size-button">S</label>
            
            <input type="radio" name="size" value="M" id="m-retro">
            <label for="m-retro" class="size-button">M</label>
            
            <input type="radio" name="size" value="L" id="l-retro">
            <label for="l-retro" class="size-button">L</label>
            
            <input type="radio" name="size" value="XL" id="xl-retro">
            <label for="xl-retro" class="size-button">XL</label>
            
            <input type="radio" name="size" value="2XL" id="2xl-retro">
            <label for="2xl-retro" class="size-button">2XL</label>
            
            <input type="radio" name="size" value="3XL" id="3xl-retro">
            <label for="3xl-retro" class="size-button">3XL</label>
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
            <p><?= htmlspecialchars($retroKitsDetails['description']) ?></p>
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
     onclick="window.location.href='/mini_mvc/public/retro-kits-details?id=<?= $product['id'] ?>'">
      <p class="product-price"><?= htmlspecialchars($product['price']) ?> €</p>
      <p class="product-name"><?= htmlspecialchars($product['name']) ?></p>
    </div>
  <?php endforeach; ?>
</div>