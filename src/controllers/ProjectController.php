<?php

declare(strict_types=1);

require_once __DIR__ . '/AppController.php';

final class ProjectController extends AppController
{
    public function index(): void
    {
        $this->render('projects', [
            'pageTitle' => 'Projekty',
            'workspaceSection' => '/projects',
        ]);
    }

    public function show(int $id): void
    {
        $this->render('project', [
            'pageTitle' => 'Szczegóły projektu',
            'workspaceSection' => '/projects',
            'projectId' => $id,
        ]);
    }

    public function create(): void
    {
        $this->render('project-create', [
            'pageTitle' => 'Nowy projekt',
            'workspaceSection' => '/projects',
        ]);
    }

    public function store(): void
    {
        http_response_code(501);
        header('Content-Type: text/plain; charset=UTF-8');
        echo 'Zapisywanie projektów będzie dostępne po podłączeniu bazy danych.';
    }
}
