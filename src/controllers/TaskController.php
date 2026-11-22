<?php

declare(strict_types=1);

require_once __DIR__ . '/AppController.php';
require_once dirname(__DIR__) . '/WorkspaceData.php';

final class TaskController extends AppController
{
    public function index(): void
    {
        $this->render('tasks', [
            'pageTitle' => 'Moje zadania',
            'workspaceSection' => '/tasks',
            'tasks' => WorkspaceData::TASKS,
        ]);
    }

    public function create(): void
    {
        $this->render('task-create', [
            'pageTitle' => 'Nowe zadanie',
            'workspaceSection' => '/tasks',
        ]);
    }

    public function store(): void
    {
        http_response_code(501);
        header('Content-Type: text/plain; charset=UTF-8');
        echo 'Zapisywanie zadań będzie dostępne po podłączeniu bazy danych.';
    }
}
