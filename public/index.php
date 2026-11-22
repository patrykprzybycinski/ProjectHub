<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/src/controllers/DefaultController.php';
require_once dirname(__DIR__) . '/src/controllers/AuthController.php';
require_once dirname(__DIR__) . '/src/controllers/ProjectController.php';
require_once dirname(__DIR__) . '/src/controllers/TaskController.php';
require_once dirname(__DIR__) . '/src/controllers/WorkspaceApiController.php';
require_once dirname(__DIR__) . '/src/controllers/DashboardController.php';
require_once dirname(__DIR__) . '/Routing.php';

$routing = new Routing();

// TU BĘDZIEMY DEFINIOWAĆ WSZYSTKIE TRASY WYSTĘPUJĄCE W NASZYM PROJEKCIE
$routing->get('/projects', ProjectController::class, 'index');
$routing->get('/projects/new', ProjectController::class, 'create');
$routing->post('/projects', ProjectController::class, 'store');
$routing->get('/projects/{id}', ProjectController::class, 'show');
$routing->get('/', DefaultController::class, 'index');
$routing->get('/login', AuthController::class, 'showLogin');
$routing->post('/login', AuthController::class, 'login');
$routing->get('/register', AuthController::class, 'showRegister');
$routing->post('/register', AuthController::class, 'register');
$routing->get('/dashboard', DashboardController::class, 'index');
$routing->get('/tasks', TaskController::class, 'index');
$routing->get('/tasks/new', TaskController::class, 'create');
$routing->post('/tasks', TaskController::class, 'store');
$routing->get('/time', DashboardController::class, 'time');

$routing->get('/api/projects', WorkspaceApiController::class, 'projects');
$routing->post('/api/projects/search', WorkspaceApiController::class, 'searchProjects');
$routing->get('/api/tasks', WorkspaceApiController::class, 'tasks');
$routing->post('/api/tasks/search', WorkspaceApiController::class, 'searchTasks');

$routeFound = $routing->dispatch(
    $_SERVER['REQUEST_METHOD'],
    $_SERVER['REQUEST_URI'],
);

if (!$routeFound) {
    http_response_code(404);
    (new DefaultController())->notFound();
}
