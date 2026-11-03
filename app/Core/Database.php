<?php
namespace App\Core;

use PDO;

/** Fournit une connexion PDO unique à la base de données. */
final class Database
{
    private static ?PDO $connection = null;

    public static function getConnection(): PDO
    {
        if (self::$connection === null) {
            $config = require dirname(__DIR__, 2) . '/config/config.php';
            $dsn = sprintf('mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4',
                $config['db']['host'], $config['db']['port'], $config['db']['name']);
            self::$connection = new PDO($dsn, $config['db']['user'], $config['db']['password'], [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]);
        }
        return self::$connection;
    }

    public static function setConnection(PDO $pdo): void
    {
        self::$connection = $pdo;
    }
}