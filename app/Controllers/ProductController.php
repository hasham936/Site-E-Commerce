<?php

declare(strict_types=1);

namespace Mini\Controllers;

use Mini\Core\Controller;
use Mini\Models\User;
use Mini\Models\Product;

final class ProductController extends Controller
{
    public function index(): void
    {   
        try {
        $pdo = \Mini\Core\Database::getPDO();
        $testMessage = "✅ Connexion à la base de données réussie !";
        } catch (\Exception $e) {
        $testMessage = "❌ Erreur de connexion : " . $e->getMessage();
        }
        $products = Product::getAll();
        $newProducts = Product::getLatest(5);
        $accessoriesProducts = Product::getByCategory(3);
        // Appelle le moteur de rendu avec la vue et ses paramètres
        $this->render('home/index', [
            // Définit le titre transmis à la vue
            'title' => '',
            'prenom' => 'Toto',
            'prenom2' => 'Tata',
            'dbTest' => $testMessage,
            'products' => $products,
            'newProducts' => $newProducts,
            'accessoriesProducts' => $accessoriesProducts,
        ]);
    }

        public function products(): void
    {
        $newProducts = Product::getLatest(5);
        $accessoriesProducts = Product::getByCategory(3);
        // Appelle le moteur de rendu avec la vue et ses paramètres
        $this->render('home/products', params: [
            // Définit le titre transmis à la vue
            'products' => $products = Product::getAll(),
            'newProducts' => $newProducts,
        ]);
    }
    
    /* Fonctions pour afficher les differentes pages de produits */
    public function recentKits(): void
    {
    $recentKits = Product::getByCategory(1);
    $this->render('home/recent-kits', params: [
        'recentKits' => $recentKits,
    ]);
    }

    public function retroKits(): void
    {
    $retroKits = Product::getByCategory(2);
    $this->render('home/retro-kits', params: [
        'retroKits' => $retroKits,
    ]);
    }
    public function accessories(): void
    {
    $accessories = Product::getByCategory(3);
    $this->render('home/accessories', params: [
        'accessories' => $accessories,
    ]);
    }

    /* Fonctions pour afficher les details des produits */
    
    public function recentKitsDetails(): void
    {

    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    $recentKitsDetails = Product::getById($id);   
    $newProducts = Product::getLatest(7);

    $this->render('home/recent-kits-details', params: [
        'recentKitsDetails' => $recentKitsDetails,
        'newProducts' => $newProducts,
    ]);
    }

    public function retroKitsDetails(): void
    {

    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    $retroKitsDetails = Product::getById($id);    
    $newProducts = Product::getLatest(7);

    $this->render('home/retro-kits-details', params: [
        'retroKitsDetails' => $retroKitsDetails,
        'newProducts' => $newProducts,
    ]);
    }

    public function accessoriesDetails(): void
    {
        
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    $accessoriesDetails = Product::getById($id);
    $newProducts = Product::getLatest(7);
    
    $this->render('home/accessories-details', params: [
        'accessoriesDetails' => $accessoriesDetails,
        'newProducts' => $newProducts,
    ]);
    }
}
