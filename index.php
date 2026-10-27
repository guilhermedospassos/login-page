<?php
require_once __DIR__ . '/php/config.php';
if (!empty($_SESSION['user_id'])) { header('Location: home.php'); exit; }
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $email = post_string('email');
    $password = isset($_POST['password']) && is_string($_POST['password']) ? $_POST['password'] : '';
    if (filter_var($email, FILTER_VALIDATE_EMAIL) && $password !== '') {
        try {
            $stmt = $connect->prepare('SELECT Id, Username, Email, Age, Password FROM users WHERE Email = ? LIMIT 1');
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $row = $stmt->get_result()->fetch_assoc();
            $stored = $row['Password'] ?? '';
            $valid = $row && (password_verify($password, $stored) || (password_get_info($stored)['algo'] === null && hash_equals($stored, $password)));
            if ($valid) {
                if (password_get_info($stored)['algo'] === null) {
                    $hash = password_hash($password, PASSWORD_DEFAULT);
                    $update = $connect->prepare('UPDATE users SET Password = ? WHERE Id = ?');
                    $update->bind_param('si', $hash, $row['Id']);
                    $update->execute();
                } elseif (password_needs_rehash($stored, PASSWORD_DEFAULT)) {
                    $hash = password_hash($password, PASSWORD_DEFAULT);
                    $update = $connect->prepare('UPDATE users SET Password = ? WHERE Id = ?');
                    $update->bind_param('si', $hash, $row['Id']);
                    $update->execute();
                }
                session_regenerate_id(true);
                $_SESSION['user_id'] = (int) $row['Id'];
                unset($_SESSION['valid'], $_SESSION['id'], $_SESSION['username'], $_SESSION['idade']);
                header('Location: home.php'); exit;
            }
        } catch (mysqli_sql_exception $exception) {
            error_log('Falha ao autenticar: ' . $exception->getCode());
        }
    }
    $error = 'E-mail ou senha inválidos.';
}
?>
<!DOCTYPE html>
<html lang="pt-br"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Login</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"></head>
<body class="d-flex justify-content-center align-items-center min-vh-100 bg-light">
<main class="container" style="max-width:500px"><div class="card p-4 shadow-sm"><h1 class="h3 text-center mb-4">Login</h1>
<?php if ($error): ?><div class="alert alert-danger" role="alert"><?= e($error) ?></div><?php endif; ?>
<form method="post"><input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
<div class="mb-3"><label class="form-label" for="email">E-mail</label><input class="form-control" type="email" name="email" id="email" autocomplete="username" maxlength="254" required></div>
<div class="mb-3"><label class="form-label" for="password">Senha</label><input class="form-control" type="password" name="password" id="password" autocomplete="current-password" required></div>
<button class="btn btn-primary w-100" type="submit">Entrar</button></form>
<p class="text-center mt-3 mb-0">Não possui conta? <a href="registro.php">Cadastre-se</a></p></div></main></body></html>
