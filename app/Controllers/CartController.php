<?php

declare(strict_types=1);

namespace Mini\Controllers;

use Mini\Core\Controller;
use Mini\Models\Cart;
use Mini\Models\Product;

final class CartController extends Controller
{
    // Afficher le panier
    public function index(): void
    {
        if (!isset($_SESSION['user_id'])) {
            $_SESSION['error'] = 'Vous devez être connecté pour voir votre panier';
            header('Location: /mini_mvc/public/authentication');
            exit;
        }

        $user_id = (int) $_SESSION['user_id'];

        $cartItems = Cart::getByUserId($user_id);
        $total = Cart::getTotal($user_id);

        $this->render('home/cart', [
            'title' => 'Mon Panier',
            'cartItems' => $cartItems,
            'total' => $total,
            'error' => $_SESSION['error'] ?? null,
            'success' => $_SESSION['success'] ?? null,
        ]);

        unset($_SESSION['error']);
        unset($_SESSION['success']);
    }

    // Ajouter un produit au panier
    public function add(): void
    {
        if (!isset($_SESSION['user_id'])) {
            $_SESSION['error'] = 'Vous devez être connecté pour ajouter au panier';
            header('Location: /mini_mvc/public/authentication');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /mini_mvc/public/');
            exit;
        }

        // Convertir les valeurs pour éviter le TypeError
        $product_id = (int) ($_POST['product_id'] ?? 0);
        $quantity   = (int) ($_POST['quantity'] ?? 1);
        $size       = $_POST['size'] ?? null;

        // Vérifier que le produit existe
        $product = Product::getById($product_id);

        if (!$product) {
            $_SESSION['error'] = 'Produit introuvable';
            header('Location: /mini_mvc/public/');
            exit;
        }

        // Créer l'objet Cart
        $cart = new Cart();
        $cart->setUserId((int) $_SESSION['user_id']);
        $cart->setProductId($product_id);
        $cart->setQuantity($quantity);
        $cart->setSize($size);

        if ($cart->add()) {
            $_SESSION['success'] = 'Produit ajouté au panier !';
        } else {
            $_SESSION['error'] = 'Erreur lors de l\'ajout au panier';
        }

        $referer = $_SERVER['HTTP_REFERER'] ?? '/mini_mvc/public/';
        header('Location: ' . $referer);
        exit;
    }

    // Supprimer un article du panier
    public function remove(): void
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /mini_mvc/public/authentication');
            exit;
        }

        $cart_id = (int) ($_GET['id'] ?? 0);

        if (Cart::remove($cart_id)) {
            $_SESSION['success'] = 'Article retiré du panier';
        } else {
            $_SESSION['error'] = 'Erreur lors de la suppression';
        }

        header('Location: /mini_mvc/public/cart');
        exit;
    }

    // Vider le panier
    public function clear(): void
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /mini_mvc/public/authentication');
            exit;
        }

        $user_id = (int) $_SESSION['user_id'];

        if (Cart::clear($user_id)) {
            $_SESSION['success'] = 'Panier vidé';
        } else {
            $_SESSION['error'] = 'Erreur lors du vidage du panier';
        }

        header('Location: /mini_mvc/public/cart');
        exit;
    }
}
