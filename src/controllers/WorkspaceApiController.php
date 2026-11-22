<?php

declare(strict_types=1);

require_once __DIR__ . '/AppController.php';
require_once dirname(__DIR__) . '/WorkspaceData.php';

final class WorkspaceApiController extends AppController
{
    public function projects(): void
    {
        $this->respond(WorkspaceData::PROJECTS);
    }

    public function tasks(): void
    {
        $this->respond(WorkspaceData::TASKS);
    }

    public function searchProjects(): void
    {
        $this->search(WorkspaceData::PROJECTS, 'name');
    }

    public function searchTasks(): void
    {
        $this->search(WorkspaceData::TASKS, 'title');
    }

    private function search(array $items, string $field): void
    {
        $body = file_get_contents('php://input');
        $payload = json_decode($body === false ? '' : $body);
        $query = $payload->query ?? null;

        if (!is_string($query) || trim($query) === '') {
            $this->respond(['error' => 'Podaj niepuste pole „query” w obiekcie JSON.'], 400);
            return;
        }

        $pattern = '~' . preg_quote(trim($query), '~') . '~iu';
        $matches = array_filter($items, static fn (array $item): bool => preg_match($pattern, $item[$field]) === 1);
        $this->respond(array_values($matches));
    }

    private function respond(array $data, int $status = 200): void
    {
        http_response_code($status);
        header('Content-Type: application/json; charset=UTF-8');
        echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_THROW_ON_ERROR);
    }
}
