<?php

declare(strict_types=1);

require dirname(__DIR__) . '/vendor/autoload.php';

use Mini\Core\Router;

// Table des routes minimaliste
$routes = [
    ['GET', '/', [Mini\Controllers\HomeController::class, 'index']],
    ['GET', '/users', [Mini\Controllers\HomeController::class, 'users']],
    ['GET', '/products',[Mini\Controllers\ProductController::class,'products']],
    ['GET', '/recent-kits', [Mini\Controllers\ProductController::class, 'recentKits']],
    ['GET', '/retro-kits', [Mini\Controllers\ProductController::class, 'retroKits']],
    ['GET', '/accessories', [Mini\Controllers\ProductController::class, 'accessories']],
    ['GET', '/recent-kits-details', [Mini\Controllers\ProductController::class, 'recentKitsDetails']],
    ['GET', '/retro-kits-details', [Mini\Controllers\ProductController::class, 'retroKitsDetails']],
    ['GET', '/accessories-details', [Mini\Controllers\ProductController::class, 'accessoriesDetails']],
    ['GET', '/cart', [Mini\Controllers\HomeController::class, 'cart']],
    ['GET', '/authentication', [Mini\Controllers\HomeController::class, 'authentication']],
    ['POST', '/process', [Mini\Controllers\HomeController::class, 'process']],
];

// Bootstrap du router
$router = new Router($routes);
$router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);


