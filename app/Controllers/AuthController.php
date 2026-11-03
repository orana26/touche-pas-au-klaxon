<?php
namespace App\Controllers;

use App\Core\Auth;
use App\Core\Flash;
use App\Models\User;

/** Contrôleur d'authentification. */
final class AuthController
{
    public function loginForm(): void { require dirname(__DIR__).'/Views/auth/login.php'; }

    public function login(): void
    {
        $email=trim($_POST['email'] ?? ''); $password=$_POST['password'] ?? '';
        $user=(new User())->findByEmail($email);
        if (!$user || !password_verify($password,$user['password'])) {
            Flash::add('danger','Identifiant ou mot de passe incorrect.');
            header('Location: /login'); exit;
        }
        Auth::login($user);
        Flash::add('success','Connexion réussie.');
        header('Location: /'); exit;
    }

    public function logout(): void
    {
        Auth::logout();
        session_start(); Flash::add('success','Vous êtes déconnecté.'); header('Location: /'); exit;
    }
}