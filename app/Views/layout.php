<!doctype html>
<!-- Définit la langue du document -->
<html lang="fr">
<!-- En-tête du document HTML -->
<head>
    <!-- Déclare l'encodage des caractères -->
    <meta charset="utf-8">
    <!-- Configure le viewport pour les appareils mobiles -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Définit le titre de la page avec échappement -->
    <title><?= isset($title) ? htmlspecialchars($title) : 'App' ?></title>
    <!-- Lien vers les feuilles de style CSS -->
    <link rel="stylesheet" href="/mini_mvc/public/css/header.css">
    <link rel="stylesheet" href="/mini_mvc/public/css/accueil.css">
    <link rel="stylesheet" href="/mini_mvc/public/css/product.css">
    <link rel="stylesheet" href="/mini_mvc/public/css/product-page.css">
    <link rel="stylesheet" href="/mini_mvc/public/css/kit-details.css">
    <link rel="stylesheet" href="/mini_mvc/public/css/authentication.css">
    <link rel="stylesheet" href="/mini_mvc/public/css/cart.css">
    <!-- Lien vers une police -->
    <link href="https://db.onlinewebfonts.com/c/1dc7840abb13fcda12aa8d1cb21fb832?family=Agrandir" rel="stylesheet" type="text/css"/>
    <!-- Lien vers la bibliothèque d'icônes Lucide -->
    <script src="https://unpkg.com/lucide@latest"></script>

</head>
<!-- Corps du document -->
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
                <a href="/mini_mvc/public/logout" title="Se déconnecter">
                    <i data-lucide="log-out"></i>
                </a>
            <?php else: ?>
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

</body>
</html>