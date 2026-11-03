<?php
namespace App\Core;

use App\Models\User;

/** Centralise l'authentification et les contrôles de rôle. */
final class Auth
{
    public static function login(array $user): void
    {
        session_regenerate_id(true);
        $_SESSION['user_id'] = (int)$user['id'];
        $_SESSION['role'] = $user['role'];
    }

    public static function logout(): void
    {
        $_SESSION = [];
        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
        }
        session_destroy();
    }

    public static function check(): bool { return isset($_SESSION['user_id']); }
    public static function id(): ?int { return isset($_SESSION['user_id']) ? (int)$_SESSION['user_id'] : null; }
    public static function isAdmin(): bool { return ($_SESSION['role'] ?? '') === 'admin'; }

    public static function user(): ?array
    {
        return self::id() ? (new User())->findById(self::id()) : null;
    }

    public static function requireLogin(): void
    {
        if (!self::check()) { Flash::add('danger', 'Veuillez vous connecter.'); header('Location: /login'); exit; }
    }

    public static function requireAdmin(): void
    {
        self::requireLogin();
        if (!self::isAdmin()) { http_response_code(403); exit('Accès interdit.'); }
    }
}