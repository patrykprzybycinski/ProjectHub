<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/models/Project.php';

final class ProjectRepository
{
    public function __construct(private PDO $database)
    {
    }

    /** @return list<Project> */
    public function findAll(): array
    {
        $statement = $this->database->query(
            'SELECT id, title, description, status, created_at, updated_at
             FROM projects ORDER BY created_at DESC, id DESC',
        );
        return array_map($this->mapRowToProject(...), $statement->fetchAll());
    }

    public function find(int $id): ?Project
    {
        $statement = $this->database->prepare(
            'SELECT id, title, description, status, created_at, updated_at
             FROM projects WHERE id = :id',
        );
        $statement->execute(['id' => $id]);
        $row = $statement->fetch();
        return $row === false ? null : $this->mapRowToProject($row);
    }

    public function save(Project $project): void
    {
        if ($project->getId() !== null) {
            throw new InvalidArgumentException('Projekt jest już zapisany.');
        }
        $statement = $this->database->prepare(
            'INSERT INTO projects (title, description, status)
             VALUES (:title, :description, :status)
             RETURNING id, created_at, updated_at',
        );
        $statement->execute([
            'title' => $project->getTitle(),
            'description' => $project->getDescription(),
            'status' => $project->getStatus(),
        ]);
        $row = $statement->fetch();
        $project->setPersistenceData(
            (int) $row['id'],
            new DateTimeImmutable($row['created_at']),
            new DateTimeImmutable($row['updated_at']),
        );
    }

    public function update(Project $project): bool
    {
        if ($project->getId() === null) {
            throw new InvalidArgumentException('Nie można zaktualizować projektu bez id.');
        }
        $statement = $this->database->prepare(
            'UPDATE projects SET title = :title, description = :description,
                 status = :status, updated_at = CURRENT_TIMESTAMP
             WHERE id = :id RETURNING created_at, updated_at',
        );
        $statement->execute([
            'id' => $project->getId(),
            'title' => $project->getTitle(),
            'description' => $project->getDescription(),
            'status' => $project->getStatus(),
        ]);
        $row = $statement->fetch();
        if ($row === false) {
            return false;
        }
        $project->setPersistenceData(
            $project->getId(),
            new DateTimeImmutable($row['created_at']),
            new DateTimeImmutable($row['updated_at']),
        );
        return true;
    }

    public function delete(int $id): bool
    {
        $statement = $this->database->prepare('DELETE FROM projects WHERE id = :id');
        $statement->execute(['id' => $id]);
        return $statement->rowCount() > 0;
    }

    private function mapRowToProject(array $row): Project
    {
        return new Project(
            (int) $row['id'],
            $row['title'],
            $row['description'],
            $row['status'],
            new DateTimeImmutable($row['created_at']),
            new DateTimeImmutable($row['updated_at']),
        );
    }
}
