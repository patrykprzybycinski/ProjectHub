<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/models/User.php';

final class UserRepository
{
    public function __construct(private PDO $database)
    {
    }

    public function findByEmail(string $email): ?User
    {
        $statement = $this->database->prepare(
            'SELECT id, email, password_hash, created_at FROM users WHERE email = :email',
        );
        $statement->execute(['email' => strtolower(trim($email))]);
        $row = $statement->fetch();
        return $row === false ? null : new User(
            (int) $row['id'],
            $row['email'],
            $row['password_hash'],
            new DateTimeImmutable($row['created_at']),
        );
    }

    // false oznacza konflikt adresu, także przy równoczesnej rejestracji.
    public function save(User $user): bool
    {
        if ($user->getId() !== null) {
            throw new InvalidArgumentException('Użytkownik jest już zapisany.');
        }
        $statement = $this->database->prepare(
            'INSERT INTO users (email, password_hash) VALUES (:email, :password_hash)
             ON CONFLICT ON CONSTRAINT users_email_unique DO NOTHING
             RETURNING id, created_at',
        );
        $statement->execute([
            'email' => $user->getEmail(),
            'password_hash' => $user->getPasswordHash(),
        ]);
        $row = $statement->fetch();
        if ($row === false) {
            return false;
        }
        $user->setPersistenceData((int) $row['id'], new DateTimeImmutable($row['created_at']));
        return true;
    }
}
