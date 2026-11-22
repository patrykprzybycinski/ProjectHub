<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/src/controllers/DefaultController.php';
require_once dirname(__DIR__) . '/src/controllers/AuthController.php';
require_once dirname(__DIR__) . '/src/controllers/ProjectController.php';
require_once dirname(__DIR__) . '/src/controllers/TaskController.php';
require_once dirname(__DIR__) . '/src/controllers/WorkspaceApiController.php';
require_once dirname(__DIR__) . '/src/controllers/DashboardController.php';
require_once dirname(__DIR__) . '/Routing.php';
require_once dirname(__DIR__) . '/src/Database.php';

session_start([
    'cookie_httponly' => true,
    'cookie_samesite' => 'Lax',
    'use_strict_mode' => true,
]);
$_SESSION['csrf_token'] ??= bin2hex(random_bytes(32));

// Połączenie powstaje raz na żądanie, dopiero gdy potrzebne są projekty.
$projectRepository = null;
$getProjectRepository = static function () use (&$projectRepository): ProjectRepository {
    return $projectRepository ??= new ProjectRepository((new Database())->connect());
};

$routing = new Routing(static function (string $class) use ($getProjectRepository): AppController {
    return match ($class) {
        ProjectController::class => new ProjectController($getProjectRepository()),
        WorkspaceApiController::class => new WorkspaceApiController($getProjectRepository),
        default => new $class(),
    };
});

// TU BĘDZIEMY DEFINIOWAĆ WSZYSTKIE TRASY WYSTĘPUJĄCE W NASZYM PROJEKCIE
$routing->get('/projects', ProjectController::class, 'index');
$routing->get('/projects/new', ProjectController::class, 'create');
$routing->post('/projects', ProjectController::class, 'store');
$routing->get('/projects/{id}', ProjectController::class, 'show');
$routing->get('/projects/{id}/edit', ProjectController::class, 'edit');
$routing->post('/projects/{id}/update', ProjectController::class, 'update');
$routing->post('/projects/{id}/delete', ProjectController::class, 'delete');
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

try {
    $routeFound = $routing->dispatch(
        $_SERVER['REQUEST_METHOD'],
        $_SERVER['REQUEST_URI'],
    );

    if (!$routeFound) {
        http_response_code(404);
        (new DefaultController())->notFound();
    }
} catch (Throwable $exception) {
    error_log((string) $exception);
    http_response_code(500);
    if (str_starts_with($_SERVER['REQUEST_URI'], '/api/')) {
        header('Content-Type: application/json; charset=UTF-8');
        echo json_encode(['error' => 'Nie udało się obsłużyć żądania. Spróbuj ponownie później.']);
    } else {
        (new DefaultController())->serverError();
    }
}
