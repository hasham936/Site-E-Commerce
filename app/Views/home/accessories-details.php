<!-- Section Détails Accessoires -->
<?php if ($accessoriesDetails): ?>
  <div class="kit-detail-container">

    <div class="left-side-grid">
      <img class="kit-detail-image"
        src="/mini_mvc/public/image/product/<?= htmlspecialchars($accessoriesDetails['image']) ?>">
    </div>

    <div class="right-side-grid">
      <p class="kit-detail-title"><?= htmlspecialchars($accessoriesDetails['name']) ?></p>
      <p class="kit-detail-price"> Price : <?= htmlspecialchars($accessoriesDetails['price']) ?> €</p>

      <form method="POST" action="/mini_mvc/public/cart/add-from-form">
        <input type="hidden" name="product_id" value="<?= $accessoriesDetails['id'] ?>">
        <input type="hidden" name="size" value="">
        
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
            <p><?= htmlspecialchars($accessoriesDetails['description']) ?></p>
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
     onclick="window.location.href='/mini_mvc/public/accessories-details?id=<?= $product['id'] ?>'">
      <p class="product-price"><?= htmlspecialchars($product['price']) ?> €</p>
      <p class="product-name"><?= htmlspecialchars($product['name']) ?></p>
    </div>
  <?php endforeach; ?>
</div>