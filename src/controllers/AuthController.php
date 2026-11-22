<?php

declare(strict_types=1);

require_once __DIR__ . '/AppController.php';
require_once dirname(__DIR__) . '/repositories/UserRepository.php';

final class AuthController extends AppController
{
    public function __construct(private Closure $getUserRepository)
    {
    }

    public function showLogin(): void
    {
        $registered = $_SESSION['registration_success'] ?? false;
        unset($_SESSION['registration_success']);
        $this->render('login', ['pageTitle' => 'Logowanie', 'registered' => $registered]);
    }

    public function login(): void
    {
        http_response_code(501);
        header('Content-Type: text/plain; charset=UTF-8');
        echo 'Logowanie będzie dostępne po wdrożeniu uwierzytelniania.';
    }

    public function showRegister(): void
    {
        $this->registrationForm();
    }

    public function register(): void
    {
        $token = $_POST['csrf_token'] ?? null;
        if (!is_string($token) || !hash_equals($_SESSION['csrf_token'], $token)) {
            http_response_code(403);
            $this->registrationForm('Formularz wygasł. Spróbuj ponownie.');
            return;
        }

        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        if (!is_string($email) || !is_string($password)) {
            http_response_code(422);
            $this->registrationForm('Nieprawidłowy format danych formularza.');
            return;
        }
        $email = strtolower(trim($email));
        if (strlen($email) > 254 || filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            http_response_code(422);
            $this->registrationForm('Podaj prawidłowy adres e-mail.', $email);
            return;
        }
        if (
            preg_match('//u', $password) !== 1 ||
            str_contains($password, "\0") ||
            preg_match_all('/./us', $password) < 8 ||
            strlen($password) > 72
        ) {
            http_response_code(422);
            $this->registrationForm('Hasło musi mieć co najmniej 8 znaków i maksymalnie 72 bajty.', $email);
            return;
        }

        $users = ($this->getUserRepository)();
        if ($users->findByEmail($email) !== null) {
            http_response_code(422);
            $this->registrationForm('Ten adres e-mail jest już zajęty.', $email);
            return;
        }

        $user = new User(null, $email, password_hash($password, PASSWORD_BCRYPT));
        if (!$users->save($user)) {
            http_response_code(422);
            $this->registrationForm('Ten adres e-mail jest już zajęty.', $email);
            return;
        }
        $_SESSION['registration_success'] = true;
        header('Location: /login', true, 303);
    }

    private function registrationForm(?string $error = null, string $email = ''): void
    {
        $this->render('register', [
            'pageTitle' => 'Rejestracja',
            'error' => $error,
            'email' => $email,
        ]);
    }
}
