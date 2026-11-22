<?php

declare(strict_types=1);

// W kontenerze PHP używamy wewnętrznego portu PostgreSQL.
return [
    'host' => getenv('DB_HOST') ?: 'db',
    'port' => getenv('DB_PORT') ?: '5432',
    'database' => getenv('POSTGRES_DB'),
    'username' => getenv('POSTGRES_USER'),
    'password' => getenv('POSTGRES_PASSWORD'),
];
