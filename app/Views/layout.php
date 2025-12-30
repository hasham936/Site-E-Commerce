<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= isset($title) ? htmlspecialchars($title) : 'App' ?></title>
    <link rel="stylesheet" href="/mini_mvc/public/css/header.css">
    <link rel="stylesheet" href="/mini_mvc/public/css/accueil.css">
    <link rel="stylesheet" href="/mini_mvc/public/css/product.css">
    <link rel="stylesheet" href="/mini_mvc/public/css/product-page.css">
    <link rel="stylesheet" href="/mini_mvc/public/css/kit-details.css">
    <link href="https://db.onlinewebfonts.com/c/1dc7840abb13fcda12aa8d1cb21fb832?family=Agrandir" rel="stylesheet" type="text/css"/>
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body>
<header>
    <div class="header-container">
        <nav class="nav-links">
            <a href="/mini_mvc/public/recent-kits">Recent Kits</a>
            <a href="/mini_mvc/public/retro-kits">Retro Kits</a>
            <a href="/mini_mvc/public/accessories">Accessories</a>
        </nav>

        <div class="logo-container">
            <a href="/mini_mvc/public/">
                <img src="/mini_mvc/public/image/logo.png" alt="Logo" class="logo">
            </a>
        </div>

        <div class="header-icons">
            <?php if (isset($_SESSION['user_id'])): ?>
                <!-- Utilisateur connecté -->
                <span class="user-name">Bonjour, <?= htmlspecialchars($_SESSION['user_nom']) ?></span>
                <a href="/mini_mvc/public/order/history" title="Mes commandes">
                    <i data-lucide="package"></i>
                </a>
                <a href="/mini_mvc/public/logout" title="Se déconnecter">
                    <i data-lucide="log-out"></i>
                </a>
            <?php else: ?>
                <!-- Utilisateur non connecté -->
                <a href="/mini_mvc/public/authentication" title="Se connecter">
                    <i data-lucide="user"></i>
                </a>
            <?php endif; ?>
            <a href="/mini_mvc/public/cart" title="Panier">
                <i data-lucide="shopping-bag"></i>
            </a>  
        </div>
    </div>
</header>

<main>
    <?= $content ?>
</main>

<script>
    lucide.createIcons();
</script>

<style>
.user-name {
    margin-right: 15px;
    font-family: 'Agrandir';
    font-size: 14px;
    font-weight: 600;
    color: #333;
}
</style>
</body>
</html>