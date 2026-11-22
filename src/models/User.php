<?php

declare(strict_types=1);

final class User
{
    public function __construct(
        private ?int $id,
        private string $email,
        private string $passwordHash,
        private ?DateTimeImmutable $createdAt = null,
    ) {
        $this->email = strtolower(trim($email));
        if (strlen($this->email) > 254 || filter_var($this->email, FILTER_VALIDATE_EMAIL) === false) {
            throw new InvalidArgumentException('Podaj prawidłowy adres e-mail.');
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPasswordHash(): string
    {
        return $this->passwordHash;
    }

    public function getCreatedAt(): ?DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setPersistenceData(int $id, DateTimeImmutable $createdAt): void
    {
        $this->id = $id;
        $this->createdAt = $createdAt;
    }
}
