<?php
namespace App\Models;

use App\Core\Database;
use PDO;

/** Accès aux employés importés depuis le SI RH. */
final class User
{
    public function findByEmail(string $email): ?array
    {
        $stmt = Database::getConnection()->prepare('SELECT * FROM users WHERE email = ? LIMIT 1');
        $stmt->execute([$email]);
        return $stmt->fetch() ?: null;
    }

    public function findById(int $id): ?array
    {
        $stmt = Database::getConnection()->prepare('SELECT * FROM users WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    }

    /** @return array<int,array<string,mixed>> */
    public function all(): array
    {
        return Database::getConnection()->query('SELECT id, firstname, lastname, email, phone, role FROM users ORDER BY lastname, firstname')->fetchAll();
    }
}