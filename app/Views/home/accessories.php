<div class="product-page-grid">
  <?php foreach ($accessories as $product): ?>
    <div class="product-page-card">
      <img src="/mini_mvc/public/image/product/<?= htmlspecialchars($product['image']) ?>"
        class="product-page-image" 
        onclick="window.location.href='/mini_mvc/public/accessories-details?id=<?= $product['id'] ?>'">
      <p class="product-page-price"><?= htmlspecialchars($product['price']) ?> €</p>
      <p class="product-page-name"><?= htmlspecialchars($product['name']) ?></p>
    </div>
  <?php endforeach; ?>
</div>