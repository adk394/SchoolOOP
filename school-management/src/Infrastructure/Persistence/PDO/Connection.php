<?php

declare(strict_types=1);

namespace SchoolManagement\Infrastructure\Persistence\PDO;

use PDO;
use SchoolManagement\Config\Env;

final class Connection
{
    private static ?PDO $instance = null;

    public static function getInstance(): PDO
    {
        if (self::$instance === null) {
            self::$instance = self::create();
        }
        return self::$instance;
    }

    private static function create(): PDO
    {
        $host = Env::get('DB_HOST', 'localhost');
        $port = Env::get('DB_PORT', '3306');
        $dbName = Env::get('DB_NAME', 'school_managment');
        $username = Env::get('DB_USER', 'root');
        $password = Env::get('DB_PASSWORD', 'root');

        $dsn = "mysql:host={$host};port={$port};dbname={$dbName};charset=utf8mb4";

        try {
            $pdo = new PDO(
                $dsn,
                $username,
                $password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]
            );
            return $pdo;
        } catch (\PDOException $e) {
            throw new \RuntimeException("Database connection failed: " . $e->getMessage());
        }
    }

    public static function closeConnection(): void
    {
        self::$instance = null;
    }
}
