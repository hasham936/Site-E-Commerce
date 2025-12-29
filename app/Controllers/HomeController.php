<?php
// Active le mode strict pour la vérification des types
declare(strict_types=1);
// Déclare l'espace de noms pour ce contrôleur
namespace Mini\Controllers;
// Importe la classe de base Controller du noyau
use Mini\Core\Controller;
use Mini\Models\User;
use Mini\Models\Product;
// Déclare la classe finale HomeController qui hérite de Controller
final class HomeController extends Controller
{
    // Déclare la méthode d'action par défaut qui ne retourne rien
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

    public function users(): void
    {
        // Appelle le moteur de rendu avec la vue et ses paramètres
        $this->render('home/users', params: [
            // Définit le titre transmis à la vue
            'users' => $users = User::getAll(),
        ]);
    }

    public function cart(): void
    {
        // Appelle le moteur de rendu avec la vue et ses paramètres
        $this->render('home/cart', params: [
            // Définit le titre transmis à la vue
            'title' => 'Shopping Cart',
        ]);
    }

    public function authentication(): void
    {
        // Appelle le moteur de rendu avec la vue et ses paramètres
        $this->render('home/authentication', params: [
            // Définit le titre transmis à la vue
            'title' => 'Authentication',
        ]);
    }

    public function process(): void
    {
        // Appelle le moteur de rendu avec la vue et ses paramètres
        $this->render('home/process', params: [
            // Définit le titre transmis à la vue
            'title' => 'Process Registration',
        ]);
    }
}