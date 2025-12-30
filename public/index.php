<?php

declare(strict_types=1);

// Démarrer la session
session_start();

require dirname(__DIR__) . '/vendor/autoload.php';

use Mini\Core\Router;

// Table des routes
$routes = [
    // Routes publiques
    ['GET', '/', [Mini\Controllers\HomeController::class, 'index']],
    ['GET', '/users', [Mini\Controllers\HomeController::class, 'users']],
    
    // Routes produits
    ['GET', '/products', [Mini\Controllers\ProductController::class, 'products']],
    ['GET', '/recent-kits', [Mini\Controllers\ProductController::class, 'recentKits']],
    ['GET', '/retro-kits', [Mini\Controllers\ProductController::class, 'retroKits']],
    ['GET', '/accessories', [Mini\Controllers\ProductController::class, 'accessories']],
    ['GET', '/recent-kits-details', [Mini\Controllers\ProductController::class, 'recentKitsDetails']],
    ['GET', '/retro-kits-details', [Mini\Controllers\ProductController::class, 'retroKitsDetails']],
    ['GET', '/accessories-details', [Mini\Controllers\ProductController::class, 'accessoriesDetails']],
    
    // Routes panier
    ['GET', '/cart', [Mini\Controllers\CartController::class, 'index']],
    ['POST', '/cart/add', [Mini\Controllers\CartController::class, 'add']],
    ['GET', '/cart/remove', [Mini\Controllers\CartController::class, 'remove']],
    ['GET', '/cart/clear', [Mini\Controllers\CartController::class, 'clear']],
    
    // Routes commandes
    ['GET', '/checkout', [Mini\Controllers\OrderController::class, 'checkout']],
    ['POST', '/order/confirm', [Mini\Controllers\OrderController::class, 'confirm']],
    ['GET', '/order/success', [Mini\Controllers\OrderController::class, 'success']],
    ['GET', '/order/history', [Mini\Controllers\OrderController::class, 'history']],
    ['GET', '/order/details', [Mini\Controllers\OrderController::class, 'details']],
    
    // Routes authentification
    ['GET', '/authentication', [Mini\Controllers\AuthController::class, 'authentication']],
    ['POST', '/register', [Mini\Controllers\AuthController::class, 'register']],
    ['POST', '/login', [Mini\Controllers\AuthController::class, 'login']],
    ['GET', '/logout', [Mini\Controllers\AuthController::class, 'logout']],
];

// Bootstrap du router
$router = new Router($routes);
$router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);