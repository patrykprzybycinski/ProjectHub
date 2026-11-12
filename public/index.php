<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/src/controllers/DefaultController.php';
require_once dirname(__DIR__) . '/src/controllers/ProjectController.php';
require_once dirname(__DIR__) . '/src/controllers/DashboardController.php';
require_once dirname(__DIR__) . '/Routing.php';

$routing = new Routing();

// TU BĘDZIEMY DEFINIOWAĆ WSZYSTKIE TRASY WYSTĘPUJĄCE W NASZYM PROJEKCIE
$routing->get('/projects', ProjectController::class, 'index');
$routing->get('/projects/{id}', ProjectController::class, 'show');
$routing->get('/', DefaultController::class, 'index');
$routing->get('/dashboard', DashboardController::class, 'index');
$routing->get('/tasks', DashboardController::class, 'tasks');
$routing->get('/time', DashboardController::class, 'time');

$routeFound = $routing->dispatch(
    $_SERVER['REQUEST_METHOD'],
    $_SERVER['REQUEST_URI'],
);

if (!$routeFound) {
    http_response_code(404);
    (new DefaultController())->notFound();
}
