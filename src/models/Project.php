<?php

declare(strict_types=1);

final class Project
{
    public const STATUSES = [
        'planned' => 'Planowane',
        'active' => 'W realizacji',
        'completed' => 'Ukończono',
    ];

    public function __construct(
        private ?int $id,
        private string $title,
        private ?string $description,
        private string $status,
        private ?DateTimeImmutable $createdAt = null,
        private ?DateTimeImmutable $updatedAt = null,
    ) {
        if (
            preg_match('//u', $title) !== 1 ||
            trim($title) === '' ||
            str_contains($title, "\0") ||
            preg_match_all('/./us', $title) > 150
        ) {
            throw new InvalidArgumentException('Nazwa projektu musi mieć od 1 do 150 znaków.');
        }
        if ($description !== null && (preg_match('//u', $description) !== 1 || str_contains($description, "\0"))) {
            throw new InvalidArgumentException('Opis projektu zawiera nieprawidłowe znaki.');
        }
        if (!array_key_exists($status, self::STATUSES)) {
            throw new InvalidArgumentException('Wybierz prawidłowy status projektu.');
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getCreatedAt(): ?DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setPersistenceData(int $id, DateTimeImmutable $createdAt, DateTimeImmutable $updatedAt): void
    {
        $this->id = $id;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public function getStatusLabel(): string
    {
        return self::STATUSES[$this->status];
    }

    public function getState(): string
    {
        return match ($this->status) {
            'active' => 'active',
            'completed' => 'done',
            default => 'pending',
        };
    }
}
