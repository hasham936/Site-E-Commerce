<?php

namespace Mini\Models;

use Mini\Core\Database;
use PDO;

class Product
{
    private $id;
    private $image;
    private $name;
    private $description;
    private $category;
    private $price;
    private $id_category;
    private $stock; // AJOUT

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

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getIdCategory()
    {
        return $this->id_category;
    }

    public function setIdCategory($id_category)
    {
        $this->id_category = $id_category;
    }

    // NOUVEAU
    public function getStock()
    {
        return $this->stock;
    }

    public function setStock($stock)
    {
        $this->stock = $stock;
    }

    // =====================
    // Méthodes CRUD
    // =====================

    /**
     * Récupère tous les produits
     * @return array
     */
    public static function getAll()
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->query("SELECT * FROM product ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère les derniers produits ajoutés
     * @param int $limit
     * @return array
     */
    public static function getLatest(int $limit = 5)
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("SELECT * FROM product ORDER BY created_at DESC LIMIT :limit");
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère un produit par son ID
     * @param int $id
     * @return array|null
     */
    public static function getById(int $id)
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("SELECT * FROM product WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * NOUVEAU : Alias de getById pour cohérence avec CartController
     * @param int $id
     * @return array|null
     */
    public static function findById($id)
    {
        return self::getById($id);
    }

    /**
     * Récupère les produits par catégorie
     * @param int $id_category
     * @return array
     */
    public static function getByCategory(int $id_category)
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("SELECT * FROM product WHERE id_category = :id");
        $stmt->execute(['id' => $id_category]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * NOUVEAU : Sauvegarde ou met à jour un produit
     * @return bool
     */
    public function save()
    {
        $pdo = Database::getPDO();
        
        if ($this->id) {
            // Mise à jour
            $stmt = $pdo->prepare("
                UPDATE product 
                SET name = ?, description = ?, price = ?, id_category = ?, image = ?, stock = ?
                WHERE id = ?
            ");
            return $stmt->execute([
                $this->name,
                $this->description,
                $this->price,
                $this->id_category,
                $this->image,
                $this->stock,
                $this->id
            ]);
        } else {
            // Insertion
            $stmt = $pdo->prepare("
                INSERT INTO product (name, description, price, id_category, image, stock)
                VALUES (?, ?, ?, ?, ?, ?)
            ");
            $result = $stmt->execute([
                $this->name,
                $this->description,
                $this->price,
                $this->id_category,
                $this->image,
                $this->stock
            ]);
            
            if ($result) {
                $this->id = $pdo->lastInsertId();
            }
            
            return $result;
        }
    }
}