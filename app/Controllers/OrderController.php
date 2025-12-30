<?php

declare(strict_types=1);

namespace Mini\Controllers;

use Mini\Core\Controller;
use Mini\Models\Cart;
use Mini\Models\Order;

final class OrderController extends Controller
{
    // Afficher la page de validation de commande
    public function checkout(): void
    {
        // Vérifier si l'utilisateur est connecté
        if (!isset($_SESSION['user_id'])) {
            $_SESSION['error'] = 'Vous devez être connecté pour passer commande';
            header('Location: /mini_mvc/public/authentication');
            exit;
        }

        $user_id = $_SESSION['user_id'];
        
        // Récupérer les articles du panier
        $cartItems = Cart::getByUserId($user_id);
        
        // Vérifier que le panier n'est pas vide
        if (empty($cartItems)) {
            $_SESSION['error'] = 'Votre panier est vide';
            header('Location: /mini_mvc/public/cart');
            exit;
        }
        
        // Calculer le total
        $total = Cart::getTotal($user_id);

        $this->render('home/checkout', [
            'title' => 'Validation de commande',
            'cartItems' => $cartItems,
            'total' => $total,
        ]);
    }

    // Confirmer et créer la commande
    public function confirm(): void
    {
        // Vérifier si l'utilisateur est connecté
        if (!isset($_SESSION['user_id'])) {
            header('Location: /mini_mvc/public/authentication');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /mini_mvc/public/cart');
            exit;
        }

        $user_id = $_SESSION['user_id'];
        
        // Récupérer les données du formulaire
        $fullname = $_POST['fullname'] ?? '';
        $address = $_POST['address'] ?? '';
        $zipcode = $_POST['zipcode'] ?? '';
        $city = $_POST['city'] ?? '';
        $phone = $_POST['phone'] ?? '';
        $payment_method = $_POST['payment_method'] ?? '';

        // Vérifier que tous les champs sont remplis
        if (empty($fullname) || empty($address) || empty($zipcode) || empty($city) || empty($phone) || empty($payment_method)) {
            $_SESSION['error'] = 'Tous les champs sont obligatoires';
            header('Location: /mini_mvc/public/checkout');
            exit;
        }
        
        // Calculer le total du panier
        $total = Cart::getTotal($user_id);
        
        // Vérifier que le panier n'est pas vide
        if ($total <= 0) {
            $_SESSION['error'] = 'Votre panier est vide';
            header('Location: /mini_mvc/public/cart');
            exit;
        }

        // Créer la commande
        $order = new Order();
        $order->setUserId($user_id);
        $order->setTotal($total);
        $order->setStatus('en attente');
        $order->setFullname($fullname);
        $order->setAddress($address);
        $order->setZipcode($zipcode);
        $order->setCity($city);
        $order->setPhone($phone);
        $order->setPaymentMethod($payment_method);

        if ($order->create()) {
            // Vider le panier
            Cart::clear($user_id);

            // Message de succès
            $_SESSION['success'] = 'Commande validée avec succès !';
            $_SESSION['order_id'] = $order->getId();
            
            // Rediriger vers la page de confirmation
            header('Location: /mini_mvc/public/order/success');
            exit;
        } else {
            $_SESSION['error'] = 'Erreur lors de la validation de la commande';
            header('Location: /mini_mvc/public/checkout');
            exit;
        }
    }

    // Page de confirmation de commande
    public function success(): void
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /mini_mvc/public/authentication');
            exit;
        }

        if (!isset($_SESSION['order_id'])) {
            header('Location: /mini_mvc/public/');
            exit;
        }

        $order_id = $_SESSION['order_id'];
        $order = Order::getById($order_id);

        // Nettoyer la session
        unset($_SESSION['order_id']);

        $this->render('home/order-success', [
            'title' => 'Commande confirmée',
            'order' => $order,
        ]);
    }

    // Afficher l'historique des commandes
    public function history(): void
    {
        if (!isset($_SESSION['user_id'])) {
            $_SESSION['error'] = 'Vous devez être connecté';
            header('Location: /mini_mvc/public/authentication');
            exit;
        }

        $user_id = $_SESSION['user_id'];
        $orders = Order::getByUserId($user_id);

        $this->render('home/order-history', [
            'title' => 'Mes commandes',
            'orders' => $orders,
        ]);
    }

    // Voir les détails d'une commande
    public function details(): void
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /mini_mvc/public/authentication');
            exit;
        }

        $order_id = $_GET['id'] ?? 0;
        $order = Order::getById($order_id);

        // Vérifier que la commande appartient à l'utilisateur
        if (!$order || $order['user_id'] != $_SESSION['user_id']) {
            $_SESSION['error'] = 'Commande introuvable';
            header('Location: /mini_mvc/public/order/history');
            exit;
        }

        $this->render('home/order-details', [
            'title' => 'Détails de la commande',
            'order' => $order,
        ]);
    }
}