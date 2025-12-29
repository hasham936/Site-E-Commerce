<!-- Section Vidéo -->

<div class="palmer-video-container">
  <video autoplay muted loop class="palmer-video">
    <source src="/mini_mvc/public/image/cole-palmer.mp4" type="video/mp4">
    Your browser does not support the video tag.
  </video>
  <div class="button-video">
    <button class="shop-now-button" onclick="window.location.href='/mini_mvc/public/recent-kits'">Shop Now</button>
    <button class="learn-more-button">Learn More</button>
  </div>
</div>

<!-- Section Nouveauté -->

<p class="new-in-text">NEW IN</p>

<div class="product-grid">
  <?php foreach ($newProducts as $product): ?>
    <div class="product-card">
      <img src="/mini_mvc/public/image/product/<?= htmlspecialchars($product['image']) ?>" 
     class="product-image" 
     onclick="window.location.href='/mini_mvc/public/<?= $product['id_category']?>'">
      <p class="product-price"><?= htmlspecialchars($product['price']) ?> €</p>
      <p class="product-name"><?= htmlspecialchars($product['name']) ?></p>
    </div>
  <?php endforeach; ?>
</div>

<!-- Section Bannières -->

<div class="banner-container">
  <div class="banner-images">
    <img src="/mini_mvc/public/image/product/caicedo.png" class="banner" alt="Banner Image 1" onclick="window.location.href='/mini_mvc/public/recent-kits'">
    <img src="/mini_mvc/public/image/product/retro-kit.webp" class="banner" alt="Banner Image 2">
  </div>

  <div class="banner-text-button-left" onclick="window.location.href='/mini_mvc/public/recent-kits'">
    <p class="banner-text">Recent Kits</p>
    <button class="banner-button" onclick="window.location.href='/mini_mvc/public/recent-kits'">Shop Now</button>
  </div>

  <div class="banner-text-button-right">
    <p class="banner-text">Retro Kits</p>
    <button class="banner-button" onclick="window.location.href='/mini_mvc/public/retro-kits'">Shop Now</button>
  </div>
</div>

