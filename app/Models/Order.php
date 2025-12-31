<?php

namespace Mini\Models;

use Mini\Core\Database;
use Mini\Models\Cart;
use Mini\Models\Product;
use PDO;

class Order
{
    private $id;
    private $user_id;
    private $statut;
    private $total;
    private $created_at;
    private $updated_at;

    // =====================
    // Getters / Setters
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

    public function getStatut()
    {
        return $this->statut;
    }

    public function setStatut($statut)
    {
        $this->statut = $statut;
    }

    public function getTotal()
    {
        return $this->total;
    }

    public function setTotal($total)
    {
        $this->total = $total;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;
    }

    // =====================
    // Méthodes CRUD
    // =====================

    /**
     * Récupère toutes les commandes d'un utilisateur
     * @param int $user_id
     * @return array
     */
    public static function getByUserId($user_id)
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("
            SELECT * FROM orders 
            WHERE user_id = ? 
            ORDER BY created_at DESC
        ");
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère toutes les commandes validées
     * @return array
     */
    public static function getValidatedOrders()
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->query("
            SELECT o.*, u.nom as user_nom, u.email as user_email
            FROM orders o
            INNER JOIN user u ON o.user_id = u.id
            WHERE o.status = 'validee'
            ORDER BY o.created_at DESC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère une commande par son ID avec ses produits
     * @param int $id
     * @return array|null
     */
    public static function findByIdWithProducts($id)
    {
        $pdo = Database::getPDO();
        
        // Récupère la commande
        $stmt = $pdo->prepare("
            SELECT o.*, u.nom as user_nom, u.email as user_email
            FROM orders o
            INNER JOIN user u ON o.user_id = u.id
            WHERE o.id = ?
        ");
        $stmt->execute([$id]);
        $order = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$order) {
            return null;
        }
        
        // Récupère les produits de la commande
        $stmt = $pdo->prepare("
            SELECT op.*, p.name as product_nom, p.image, cat.name as category_name
            FROM order_product op
            INNER JOIN product p ON op.product_id = p.id
            LEFT JOIN category cat ON p.category_id = cat.id
            WHERE op.order_id = ?
        ");
        $stmt->execute([$id]);
        $order['products'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $order;
    }

    /**
     * Crée une nouvelle commande à partir du panier
     * @param int $user_id
     * @return int|false L'ID de la commande créée ou false en cas d'erreur
     */
    public static function createFromCart($user_id)
    {
        $pdo = Database::getPDO();
        
        // Récupère les articles du panier
        $cartItems = Cart::getByUserId($user_id);
        
        if (empty($cartItems)) {
            return false;
        }
        
        // Calcule le total
        $total = Cart::getTotalByUserId($user_id);
        
        try {
            $pdo->beginTransaction();
            
            // Crée la commande
            $stmt = $pdo->prepare("INSERT INTO orders (user_id, status, total) VALUES (?, 'validee', ?)");
            $stmt->execute([$user_id, $total]);
            $orderId = $pdo->lastInsertId();
            
            // Ajoute les produits à la commande
            $stmt = $pdo->prepare("INSERT INTO order_product (order_id, product_id, quantity, unit_price) VALUES (?, ?, ?, ?)");
            
            foreach ($cartItems as $item) {
                $product = Product::findById($item['id']);
                if ($product) {
                    $stmt->execute([
                        $orderId,
                        $item['id'],
                        $item['quantity'],
                        $product['price']
                    ]);
                }
            }
            
            // Vide le panier
            Cart::clearByUserId($user_id);
            
            $pdo->commit();
            return $orderId;
            
        } catch (\Exception $e) {
            $pdo->rollBack();
            return false;
        }
    }

    /**
     * Met à jour le statut d'une commande
     * @return bool
     */
    public function update()
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("UPDATE orders SET status = ?, total = ? WHERE id = ?");
        return $stmt->execute([$this->statut, $this->total, $this->id]);
    }

    /**
     * Supprime une commande
     * @return bool
     */
    public function delete()
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("DELETE FROM orders WHERE id = ?");
        return $stmt->execute([$this->id]);
    }
}