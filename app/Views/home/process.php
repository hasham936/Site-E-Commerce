<?php

use Mini\Core\Database;
use PDO;

$pdo = Database::getPDO();

if(isset($_POST['register-submit'])) {
    // Récupération des données
    $username = $_POST['register-username'];
    $email = $_POST['register-email'];
    $password = $_POST['register-password'];
    
    // Vérifier si l'email existe déjà
    $checkEmail = $pdo->prepare("SELECT id FROM user WHERE email = :email");
    $checkEmail->execute([':email' => $email]);
    
    if($checkEmail->rowCount() > 0) {
        echo "Cet email est déjà utilisé";
    } else {
        // Hasher le mot de passe
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        // Insertion dans la base de données
        $requete = $pdo->prepare("INSERT INTO user (id, nom, email, mot_de_passe) VALUES (NULL, :username, :email, :password)");
        $requete->execute([
            ':username' => $username,
            ':email' => $email,
            ':password' => $hashedPassword
        ]);
        
        // Redirection après succès
        echo "Inscription réussie ! <a href='login.php'>Se connecter</a>";
    }
}
?>