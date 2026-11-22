<?php

declare(strict_types=1);

require_once __DIR__ . '/AppController.php';

final class AuthController extends AppController
{
    public function showLogin(): void
    {
        $this->render('login', ['pageTitle' => 'Logowanie']);
    }

    public function login(): void
    {
        http_response_code(501);
        header('Content-Type: text/plain; charset=UTF-8');
        echo 'Logowanie będzie dostępne po wdrożeniu uwierzytelniania.';
    }

    public function showRegister(): void
    {
        $this->render('register', ['pageTitle' => 'Rejestracja']);
    }

    public function register(): void
    {
        http_response_code(501);
        header('Content-Type: text/plain; charset=UTF-8');
        echo 'Rejestracja będzie dostępna po wdrożeniu obsługi kont.';
    }
}
