<?php

declare(strict_types=1);

final class Database
{
    public function connect(): PDO
    {
        $config = require dirname(__DIR__) . '/config.php';
        foreach (['database', 'username', 'password'] as $key) {
            if (!is_string($config[$key]) || $config[$key] === '') {
                throw new RuntimeException('Brak konfiguracji połączenia z bazą danych.');
            }
        }

        try {
            return new PDO(
                sprintf(
                    'pgsql:host=%s;port=%d;dbname=%s;connect_timeout=5',
                    $config['host'],
                    (int) $config['port'],
                    $config['database'],
                ),
                $config['username'],
                $config['password'],
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ],
            );
        } catch (PDOException $exception) {
            throw new RuntimeException('Nie udało się połączyć z bazą danych.', 0, $exception);
        }
    }
}
