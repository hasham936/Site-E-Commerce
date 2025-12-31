<?php

namespace Mini\Models;

use Mini\Core\Database;
use PDO;

class Cart
{
    private $id;
    private $user_id;
    private $product_id;
    private $quantity;
    private $size;

    // =====================
    // Getters et Setters
    // =====================

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    public function getProductId()
    {
        return $this->product_id;
    }

    public function setProductId($product_id)
    {
        $this->product_id = $product_id;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    public function getSize()
    {
        return $this->size;
    }

    public function setSize($size)
    {
        $this->size = $size;
    }

    // =====================
    // Méthodes CRUD
    // =====================

    /**
     * Ajouter un produit au panier
     */
    public function add()
    {
        $pdo = Database::getPDO();
        
        // Vérifier si le produit existe déjà dans le panier avec la même taille
        $stmt = $pdo->prepare("SELECT * FROM cart WHERE user_id = ? AND product_id = ? AND size = ?");
        $stmt->execute([$this->user_id, $this->product_id, $this->size]);
        $existing = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existing) {
            // Si le produit existe déjà, on augmente la quantité
            $newQuantity = $existing['quantity'] + $this->quantity;
            $stmt = $pdo->prepare("UPDATE cart SET quantity = ? WHERE id = ?");
            return $stmt->execute([$newQuantity, $existing['id']]);
        } else {
            // Sinon on ajoute une nouvelle ligne
            $stmt = $pdo->prepare("INSERT INTO cart (user_id, product_id, quantity, size) VALUES (?, ?, ?, ?)");
            return $stmt->execute([$this->user_id, $this->product_id, $this->quantity, $this->size]);
        }
    }

    /**
     * Récupérer les articles du panier d'un utilisateur
     */
    public static function getByUserId($user_id)
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("
            SELECT c.*, p.name, p.price, p.image 
            FROM cart c
            JOIN product p ON c.product_id = p.id
            WHERE c.user_id = ?
        ");
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Supprimer un article du panier
     */
    public static function remove($cart_id)
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("DELETE FROM cart WHERE id = ?");
        return $stmt->execute([$cart_id]);
    }

    /**
     * Vider tout le panier d'un utilisateur
     */
    public static function clear($user_id)
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("DELETE FROM cart WHERE user_id = ?");
        return $stmt->execute([$user_id]);
    }

    /**
     * Calculer le total du panier
     */
    public static function getTotal($user_id)
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("
            SELECT SUM(c.quantity * p.price) as total
            FROM cart c
            JOIN product p ON c.product_id = p.id
            WHERE c.user_id = ?
        ");
        $stmt->execute([$user_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'] ?? 0;
    }

    /**
     * Compter le nombre d'articles dans le panier
     */
    public static function countItems($user_id)
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("SELECT SUM(quantity) as count FROM cart WHERE user_id = ?");
        $stmt->execute([$user_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'] ?? 0;
    }
}