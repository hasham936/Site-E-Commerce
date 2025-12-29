<?php

namespace Mini\Models;

use Mini\Core\Database;
use PDO;

class Category
{
    private $id;
    private $name;

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

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    // =====================
    // Méthodes CRUD
    // =====================
    /**
     * Récupère toutes les catégories
     * @return array
     */
    public static function getAll()
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->query("SELECT * FROM category ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
  }