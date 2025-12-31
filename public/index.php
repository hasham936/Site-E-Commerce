<?php

declare(strict_types=1);

// Démarrer la session
session_start();

require dirname(__DIR__) . '/vendor/autoload.php';

use Mini\Core\Router;

// Table des routes
$routes = [
    ['GET', '/', [Mini\Controllers\HomeController::class, 'index']],
    ['GET', '/users', [Mini\Controllers\HomeController::class, 'users']],
    
    ['GET', '/products', [Mini\Controllers\ProductController::class, 'products']],
    ['GET', '/recent-kits', [Mini\Controllers\ProductController::class, 'recentKits']],
    ['GET', '/retro-kits', [Mini\Controllers\ProductController::class, 'retroKits']],
    ['GET', '/accessories', [Mini\Controllers\ProductController::class, 'accessories']],
    ['GET', '/recent-kits-details', [Mini\Controllers\ProductController::class, 'recentKitsDetails']],
    ['GET', '/retro-kits-details', [Mini\Controllers\ProductController::class, 'retroKitsDetails']],
    ['GET', '/accessories-details', [Mini\Controllers\ProductController::class, 'accessoriesDetails']],
    
    ['GET', '/cart', [Mini\Controllers\CartController::class, 'show']],
    ['POST', '/cart/add', [Mini\Controllers\CartController::class, 'add']],
    ['POST', '/cart/add-from-form', [Mini\Controllers\CartController::class, 'addFromForm']],
    ['POST', '/cart/update', [Mini\Controllers\CartController::class, 'update']],
    ['POST', '/cart/remove', [Mini\Controllers\CartController::class, 'remove']],
    ['POST', '/cart/clear', [Mini\Controllers\CartController::class, 'clear']],
    
    ['GET', '/orders', [Mini\Controllers\OrderController::class, 'listByUser']],
    ['GET', '/orders/validated', [Mini\Controllers\OrderController::class, 'listValidated']],
    ['GET', '/orders/show', [Mini\Controllers\OrderController::class, 'show']],
    ['POST', '/orders/create', [Mini\Controllers\OrderController::class, 'create']],
    ['POST', '/orders/update-status', [Mini\Controllers\OrderController::class, 'updateStatus']],
    
    ['GET', '/checkout', [Mini\Controllers\OrderController::class, 'checkout']],
    ['POST', '/order/confirm', [Mini\Controllers\OrderController::class, 'confirm']],
    ['GET', '/order/success', [Mini\Controllers\OrderController::class, 'success']],
    ['GET', '/order/history', [Mini\Controllers\OrderController::class, 'history']],
    ['GET', '/order/details', [Mini\Controllers\OrderController::class, 'details']],
    
    ['GET', '/authentication', [Mini\Controllers\AuthController::class, 'authentication']],
    ['POST', '/register', [Mini\Controllers\AuthController::class, 'register']],
    ['POST', '/login', [Mini\Controllers\AuthController::class, 'login']],
    ['GET', '/logout', [Mini\Controllers\AuthController::class, 'logout']],
];

// Bootstrap du router
$router = new Router($routes);
$router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);