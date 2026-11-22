<?php

declare(strict_types=1);

require_once __DIR__ . '/AppController.php';
require_once dirname(__DIR__) . '/repositories/ProjectRepository.php';

final class ProjectController extends AppController
{
    public function __construct(private ProjectRepository $projects)
    {
    }

    public function index(): void
    {
        $this->render('projects', [
            'pageTitle' => 'Projekty',
            'workspaceSection' => '/projects',
            'projects' => $this->projects->findAll(),
        ]);
    }

    public function show(int $id): void
    {
        $project = $this->projects->find($id);
        if ($project === null) {
            $this->notFound();
            return;
        }
        $this->render('project', [
            'pageTitle' => $project->getTitle(),
            'workspaceSection' => '/projects',
            'project' => $project,
        ]);
    }

    public function create(): void
    {
        $this->form();
    }

    public function edit(int $id): void
    {
        $project = $this->projects->find($id);
        if ($project === null) {
            $this->notFound();
            return;
        }
        $this->form($project);
    }

    public function store(): void
    {
        if (!$this->verifyCsrf()) {
            return;
        }
        $project = $this->submittedProject();
        if ($project === null) {
            return;
        }
        $this->projects->save($project);
        header('Location: /projects/' . $project->getId(), true, 303);
    }

    public function update(int $id): void
    {
        if (!$this->verifyCsrf()) {
            return;
        }
        if ($this->projects->find($id) === null) {
            $this->notFound();
            return;
        }
        $project = $this->submittedProject($id);
        if ($project === null) {
            return;
        }
        if (!$this->projects->update($project)) {
            $this->notFound();
            return;
        }
        header('Location: /projects/' . $id, true, 303);
    }

    public function delete(int $id): void
    {
        if (!$this->verifyCsrf()) {
            return;
        }
        if (!$this->projects->delete($id)) {
            $this->notFound();
            return;
        }
        header('Location: /projects', true, 303);
    }

    private function submittedProject(?int $id = null): ?Project
    {
        // Starszy formularz wysyłał nazwę w polu "name".
        $title = $_POST['title'] ?? $_POST['name'] ?? '';
        $description = $_POST['description'] ?? '';
        $status = $_POST['status'] ?? 'planned';

        if (!is_string($title) || !is_string($description) || !is_string($status)) {
            http_response_code(422);
            $this->form(null, 'Nieprawidłowy format danych formularza.', [], $id);
            return null;
        }

        $values = ['title' => trim($title), 'description' => trim($description), 'status' => $status];
        try {
            return new Project(
                $id,
                $values['title'],
                $values['description'] === '' ? null : $values['description'],
                $status,
            );
        } catch (InvalidArgumentException $exception) {
            http_response_code(422);
            $this->form(null, $exception->getMessage(), $values, $id);
            return null;
        }
    }

    private function form(?Project $project = null, ?string $error = null, array $values = [], ?int $id = null): void
    {
        $projectId = $project?->getId() ?? $id;
        $this->render('project-create', [
            'pageTitle' => $projectId === null ? 'Nowy projekt' : 'Edycja projektu',
            'workspaceSection' => '/projects',
            'projectId' => $projectId,
            'values' => $values ?: [
                'title' => $project?->getTitle() ?? '',
                'description' => $project?->getDescription() ?? '',
                'status' => $project?->getStatus() ?? 'planned',
            ],
            'error' => $error,
        ]);
    }

    private function verifyCsrf(): bool
    {
        $token = $_POST['csrf_token'] ?? null;
        if (!is_string($token) || !hash_equals($_SESSION['csrf_token'], $token)) {
            http_response_code(403);
            header('Content-Type: text/plain; charset=UTF-8');
            echo 'Formularz wygasł. Otwórz go ponownie i spróbuj jeszcze raz.';
            return false;
        }
        return true;
    }

    private function notFound(): void
    {
        http_response_code(404);
        $this->render('not-found', ['pageTitle' => 'Nie znaleziono projektu', 'workspaceSection' => '/projects']);
    }
}
