# Projet E-Commerce PHP Vanilla - Mini MVC

Ce projet est une application de e-commerce réalisée en PHP pur (sans framework). Il permet de naviguer entre différentes catégories de produits (Recent Kits, Retro Kits, Accessoires), de gérer un panier et de s'authentifier.

## Installation

### 1. Prérequis

* Un serveur local (XAMPP, WAMP ou MAMP).
* PHP 7.4 ou supérieur.
* MySQL / MariaDB.

### 2. Installation de la Base de Données (via phpMyAdmin)

1. Ouvrez **phpMyAdmin** (`http://localhost/phpmyadmin`).
2. Cliquez sur l'onglet **"Nouvelle"** (New) dans la barre latérale gauche.
3. Nommez la base de données `mini_mvc`
4. Une fois créée, cliquez sur le nom de votre base de données dans la liste.
5. Allez dans l'onglet **"Importer"** (Import) en haut de la page.
6. Cliquez sur **"Choisir un fichier"** et sélectionnez le fichier `.sql` fourni avec ce projet.
7. Descendez et cliquez sur le bouton **"Importer"** ou **"Exécuter"**.

### 3. Configuration du code

1. Placez le dossier du projet dans votre répertoire Web (ex: `htdocs` pour XAMPP).
2. Assurez-vous que le dossier se nomme bien `mini_mvc`.
3. Modifiez votre fichier de configuration de connexion à la base de données (`config.php`) avec vos identifiants locaux :
* **Host :** `localhost`
* **DB Name :** `votre_nom_de_base`
* **User :** `root`
* **Password :** `""` (vide sur XAMPP).

---

## Fonctionnalités réalisées

* **Page d'accueil :** Affichage des nouveautés ("New In") et bannières promotionnelles.
* **Navigation par catégorie :** Pages dédiées pour les Recent Kits, Retro Kits et Accessoires.
* **Détails Produits :** Consultation de la description, du prix et choix de la taille (pour les vêtements).
* **Gestion du Panier :**
* Ajout de produits avec sélection de taille.
* Suppression d'articles.
* Calcul automatique du total.
* Possibilité de vider le panier.
* **Authentification :** Système complet d'inscription et de connexion.
* **Passage de commande :** Validation du panier pour créer une commande.

---

## Structure du Projet

* `public/` : Contient les images, le CSS et le index.php.
* `views/` : Contient les fichiers PHP d'affichage (ceux fournis comme `cart.php`, `authentication.php`, etc.).
* `image/product/` : Stockage des visuels produits.
* `controllers/` : Logique de traitement.
* `models/` : Requêtes SQL et interactions avec la base de données MySQL.
* `core` : Coeur du système.

---

##  Identifiants de test

Pour tester l'application sans créer de compte, vous pouvez utiliser :

* **Email :** `h@gmail.com`
* **Mot de passe :** `hasham`

---

## Notes pour l'évaluation

* **Base de données :** Contient les 5 tables requises (product,user, orders, cart, category).
* **PHP Vanilla :** Aucun framework n'a été utilisé, uniquement du PHP pur et du SQL.
* **Bonus :** Non inclus (Focus sur la stabilité des fonctionnalités minimales).