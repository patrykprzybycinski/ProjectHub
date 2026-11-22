<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/src/Database.php';

if (PHP_SAPI !== 'cli') {
    http_response_code(404);
    exit;
}

$database = null;
$locked = false;
$migration = 'initialization';
$exitCode = 0;

try {
    $database = (new Database())->connect();
    $database->exec("SET lock_timeout = '60s'");
    // Stały klucz wspólny dla wszystkich uruchomień migracji ProjectHub.
    $database->query('SELECT pg_advisory_lock(724019831)');
    $locked = true;

    $database->exec(
        'CREATE TABLE IF NOT EXISTS schema_migrations (
            version VARCHAR(255) PRIMARY KEY,
            checksum CHAR(64) NOT NULL,
            executed_at TIMESTAMPTZ NOT NULL DEFAULT CURRENT_TIMESTAMP
        )',
    );
    $applied = $database->query('SELECT version, checksum FROM schema_migrations')->fetchAll(PDO::FETCH_KEY_PAIR);
    $files = glob(__DIR__ . '/[0-9]*-*.sql');
    if ($files === false) {
        throw new RuntimeException('Nie udało się odczytać katalogu migracji.');
    }
    natsort($files);

    $available = array_map('basename', $files);
    foreach ($applied as $version => $checksum) {
        if (!in_array($version, $available, true)) {
            throw new RuntimeException('Brakuje pliku wykonanej migracji: ' . $version);
        }
    }

    // Sprawdzamy wszystkie sumy przed wykonaniem kolejnych zmian.
    $migrations = [];
    foreach ($files as $file) {
        $migration = basename($file);
        $sql = file_get_contents($file);
        if ($sql === false || trim($sql) === '') {
            throw new RuntimeException('Pusty lub nieczytelny plik migracji: ' . $migration);
        }
        $sql = str_replace("\r\n", "\n", $sql);
        $checksum = hash('sha256', $sql);
        if (isset($applied[$migration]) && !hash_equals($applied[$migration], $checksum)) {
            throw new RuntimeException('Zmieniono wykonaną migrację: ' . $migration . '. Dodaj nowy plik SQL.');
        }
        $migrations[$migration] = ['sql' => $sql, 'checksum' => $checksum];
    }

    foreach ($migrations as $migration => $content) {
        if (isset($applied[$migration])) {
            fwrite(STDOUT, 'Pominięto wykonaną migrację: ' . $migration . PHP_EOL);
            continue;
        }
        $database->beginTransaction();
        $database->exec($content['sql']);
        $statement = $database->prepare(
            'INSERT INTO schema_migrations (version, checksum) VALUES (:version, :checksum)',
        );
        $statement->execute(['version' => $migration, 'checksum' => $content['checksum']]);
        $database->commit();
        fwrite(STDOUT, 'Wykonano migrację: ' . $migration . PHP_EOL);
    }
    fwrite(STDOUT, 'Schemat bazy danych jest aktualny.' . PHP_EOL);
} catch (Throwable $exception) {
    if ($database !== null && $database->inTransaction()) {
        $database->rollBack();
    }
    fwrite(STDERR, 'Błąd migracji (' . $migration . '): ' . $exception->getMessage() . PHP_EOL);
    $exitCode = 1;
} finally {
    if ($locked && $database !== null) {
        $database->query('SELECT pg_advisory_unlock(724019831)');
    }
}

exit($exitCode);
