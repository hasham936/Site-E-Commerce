<?php

declare(strict_types=1);

namespace Mini\Controllers;

use Mini\Core\Controller;
use Mini\Models\User;

final class AuthController extends Controller
{
    public function authentication(): void
    {
        $this->render('home/authentication', [
            'title' => 'Authentication',
            'error' => $_SESSION['error'] ?? null,
            'success' => $_SESSION['success'] ?? null,
        ]);
        
        unset($_SESSION['error']);
        unset($_SESSION['success']);
    }

    // inscription
    public function register(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /mini_mvc/public/authentication');
            exit;
        }

        $nom = $_POST['register-username'] ?? '';
        $email = $_POST['register-email'] ?? '';
        $password = $_POST['register-password'] ?? '';

        if (empty($nom) || empty($email) || empty($password)) {
            $_SESSION['error'] = 'Tous les champs sont obligatoires';
            header('Location: /mini_mvc/public/authentication');
            exit;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = 'Email invalide';
            header('Location: /mini_mvc/public/authentication');
            exit;
        }

        $existingUser = User::findByEmail($email);
        if ($existingUser) {
            $_SESSION['error'] = 'Cet email est déjà utilisé';
            header('Location: /mini_mvc/public/authentication');
            exit;
        }

        $user = new User();
        $user->setNom($nom);
        $user->setEmail($email);
        $user->setPassword($password);

        if ($user->save()) {
            $_SESSION['success'] = 'Inscription réussie ! Vous pouvez maintenant vous connecter.';
        } else {
            $_SESSION['error'] = 'Erreur lors de l\'inscription';
        }

        header('Location: /mini_mvc/public/authentication');
        exit;
    }

    // connexion
    public function login(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /mini_mvc/public/authentication');
            exit;
        }

        $email = $_POST['login-email'] ?? '';
        $password = $_POST['login-password'] ?? '';

        if (empty($email) || empty($password)) {
            $_SESSION['error'] = 'Email et mot de passe obligatoires';
            header('Location: /mini_mvc/public/authentication');
            exit;
        }

        $user = User::findByEmail($email);

        if (!$user) {
            $_SESSION['error'] = 'Email ou mot de passe incorrect';
            header('Location: /mini_mvc/public/authentication');
            exit;
        }

        if ($password !== $user['mot_de_passe']) {
            $_SESSION['error'] = 'Email ou mot de passe incorrect';
            header('Location: /mini_mvc/public/authentication');
            exit;
        }

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_nom'] = $user['nom'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['success'] = 'Connexion réussie !';

        header('Location: /mini_mvc/public/');
        exit;
    }

    // déconnexion
    public function logout(): void
    {
        session_unset();
        session_destroy();
        header('Location: /mini_mvc/public/');
        exit;
    }
}