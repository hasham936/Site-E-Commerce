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
    <!-- Lien vers la feuille de style CSS -->
    <link rel="stylesheet" href="/mini_mvc/public/css/header.css">
    <link rel="stylesheet" href="/mini_mvc/public/css/accueil.css">
    <link rel="stylesheet" href="/mini_mvc/public/css/product.css">
    <link rel="stylesheet" href="/mini_mvc/public/css/product-page.css">
    <link rel="stylesheet" href="/mini_mvc/public/css/kit-details.css">
    <!-- Lien vers une police en ligne -->
    <link href="https://db.onlinewebfonts.com/c/1dc7840abb13fcda12aa8d1cb21fb832?family=Agrandir" rel="stylesheet" type="text/css"/>
    <!-- Lien vers les icônes Lucide -->
    <script src="https://unpkg.com/lucide@latest"></script>

</head>
<!-- Corps du document -->
<body>
<!-- En-tête de la page -->
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
            <a href="/mini_mvc/public/authentication"><i data-lucide="user"></i></a>
            <a href="/mini_mvc/public/cart"><i data-lucide="shopping-bag"></i></a>  
        </div>
    </div>
</header>
<!-- Zone de contenu principal -->
<main>
    <!-- Insère le contenu rendu de la vue -->
    <?= $content ?>
    
</main>
<!-- Fin du corps de la page -->
<script>
    lucide.createIcons();
</script>
</body>
<!-- Fin du document HTML -->
</html>

