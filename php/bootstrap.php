<?php
declare(strict_types=1);

ini_set('session.use_strict_mode', '1');
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_set_cookie_params([
        'lifetime' => 0,
        'path' => '/',
        'secure' => !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off',
        'httponly' => true,
        'samesite' => 'Lax',
    ]);
    session_start();
}

function e(mixed $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function post_string(string $key): string
{
    return isset($_POST[$key]) && is_string($_POST[$key]) ? trim($_POST[$key]) : '';
}

function csrf_token(): string
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function verify_csrf(): void
{
    $token = $_POST['csrf_token'] ?? null;
    if (!is_string($token) || !hash_equals(csrf_token(), $token)) {
        http_response_code(400);
        exit('Requisição inválida. Atualize a página e tente novamente.');
    }
}

function require_login(): int
{
    if (empty($_SESSION['user_id']) || !is_numeric($_SESSION['user_id'])) {
        header('Location: index.php');
        exit;
    }
    return (int) $_SESSION['user_id'];
}

function profile_validation_error(string $username, string $email, string $age): ?string
{
    if ($username === '' || strlen($username) > 80) {
        return 'Informe um nome de usuário com até 80 caracteres.';
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) > 254) {
        return 'Informe um e-mail válido.';
    }
    if ($age === '' || !ctype_digit($age) || (int) $age > 120) {
        return 'Informe uma idade válida (0 a 120).';
    }
    return null;
}
