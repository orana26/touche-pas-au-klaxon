<?php
namespace App\Models;

use App\Core\Database;

/** CRUD des agences, réservé à l'administration. */
final class Agency
{
    public function all(): array
    {
        return Database::getConnection()->query('SELECT * FROM agencies ORDER BY city')->fetchAll();
    }
    public function find(int $id): ?array
    {
        $s=Database::getConnection()->prepare('SELECT * FROM agencies WHERE id=?'); $s->execute([$id]); return $s->fetch() ?: null;
    }
    public function create(string $city): int
    {
        $s=Database::getConnection()->prepare('INSERT INTO agencies(city) VALUES(?)'); $s->execute([$city]); return (int)Database::getConnection()->lastInsertId();
    }
    public function update(int $id,string $city): void
    {
        $s=Database::getConnection()->prepare('UPDATE agencies SET city=? WHERE id=?'); $s->execute([$city,$id]);
    }
    public function delete(int $id): void
    {
        $s=Database::getConnection()->prepare('DELETE FROM agencies WHERE id=?'); $s->execute([$id]);
    }
}