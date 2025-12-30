<?php

namespace Mini\Models;

use Mini\Core\Database;
use PDO;

class Order
{
    private $id;
    private $user_id;
    private $total;
    private $status;
    private $fullname;
    private $address;
    private $zipcode;
    private $city;
    private $phone;
    private $payment_method;

    // Getters et Setters
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

    public function getTotal()
    {
        return $this->total;
    }

    public function setTotal($total)
    {
        $this->total = $total;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getFullname()
    {
        return $this->fullname;
    }

    public function setFullname($fullname)
    {
        $this->fullname = $fullname;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function getZipcode()
    {
        return $this->zipcode;
    }

    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function setCity($city)
    {
        $this->city = $city;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function getPaymentMethod()
    {
        return $this->payment_method;
    }

    public function setPaymentMethod($payment_method)
    {
        $this->payment_method = $payment_method;
    }

    // Créer une nouvelle commande
    public function create()
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("
            INSERT INTO orders (user_id, total, status, fullname, address, zipcode, city, phone, payment_method) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");
        $result = $stmt->execute([
            $this->user_id, 
            $this->total, 
            $this->status, 
            $this->fullname, 
            $this->address, 
            $this->zipcode, 
            $this->city, 
            $this->phone, 
            $this->payment_method
        ]);
        
        if ($result) {
            $this->id = $pdo->lastInsertId();
            return true;
        }
        return false;
    }

    // Récupérer toutes les commandes d'un utilisateur
    public static function getByUserId($user_id)
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("SELECT * FROM orders WHERE user_id = ? ORDER BY created_at DESC");
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupérer une commande par son ID
    public static function getById($order_id)
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("SELECT * FROM orders WHERE id = ?");
        $stmt->execute([$order_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}