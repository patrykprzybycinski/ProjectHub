<?php

declare(strict_types=1);

require_once __DIR__ . '/AppController.php';


final class DashboardController extends AppController
{
    public function index(): void
    {
        $this->render('dashboard', [
            'pageTitle' => 'Panel główny',
            'workspaceSection' => '/dashboard',
        ]);
    }

    public function tasks(): void
    {
        $this->render('tasks', [
            'pageTitle' => 'Moje zadania',
            'workspaceSection' => '/tasks',
        ]);
    }

    public function time(): void
    {
        $this->render('time', [
            'pageTitle' => 'Mój czas',
            'workspaceSection' => '/time',
        ]);
    }

    public function notFound(): void
    {
        $this->render('not-found', [
            'pageTitle' => 'Nie znaleziono strony',
        ]);
    }
}
