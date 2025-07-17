<?php

namespace App\Models;

use App\Core\Application;

class BaseModel 
{
    protected static string $table;
    protected static \PDO $connection;

    private static function getPDO(): \PDO
    {
        if (!isset(self::$connection)) {
            self::$connection = Application::getDBConnection()->getConnection();
        }

        return self::$connection;
    }
    
    public static function select(?string $columns = null): array
    {
        $query = "SELECT " . ($columns ?? '*') . " FROM " . static::$table;
        $stmt = static::getPDO()->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function insert(array $data): bool
    {
        $columns = array_keys($data);
        $columnsList = implode(', ', $columns);
        $placeholders = implode(', ', array_map(fn($key) => ":{$key}", $columns));
        $query = "INSERT INTO " . static::$table . " ({$columnsList}) VALUES ({$placeholders})";

        $stmt = static::getPDO()->prepare($query);
        foreach ($data as $key => $value) {
            $stmt->bindValue(":{$key}", $value);
        }
        return $stmt->execute();
    }

    public static function insertId(array $data): int
    {
        self::insert($data);
        return static::getPDO()->lastInsertId();
    }

    public static function query(string $query, array $params = []): array
    {
        $stmt = static::getPDO()->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}