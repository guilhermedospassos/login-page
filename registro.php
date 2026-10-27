<?php
require_once __DIR__ . '/php/config.php';
$error = ''; $success = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $username = post_string('username'); $email = post_string('email'); $age = post_string('idade');
    $password = isset($_POST['password']) && is_string($_POST['password']) ? $_POST['password'] : '';
    $error = profile_validation_error($username, $email, $age) ?? '';
    if (!$error && strlen($password) < 12) $error = 'A senha deve ter pelo menos 12 caracteres.';
    if (!$error && strlen($password) > 4096) $error = 'A senha informada é muito longa.';
    if (!$error) {
        try {
            $stmt = $connect->prepare('SELECT Id FROM users WHERE Email = ? LIMIT 1');
            $stmt->bind_param('s', $email); $stmt->execute();
            if ($stmt->get_result()->fetch_assoc()) {
                $error = 'Este e-mail já está cadastrado.';
            } else {
                $hash = password_hash($password, PASSWORD_DEFAULT); $ageInt = (int) $age;
                $stmt = $connect->prepare('INSERT INTO users (Username, Email, Age, Password) VALUES (?, ?, ?, ?)');
                $stmt->bind_param('ssis', $username, $email, $ageInt, $hash);
                $stmt->execute();
                $success = 'Usuário cadastrado com sucesso. Faça seu login.';
            }
        } catch (mysqli_sql_exception $exception) {
            error_log('Falha ao registrar: ' . $exception->getCode());
            $error = $exception->getCode() === 1062 ? 'Este e-mail já está cadastrado.' : 'Não foi possível cadastrar agora.';
        }
    }
}
?>
<!DOCTYPE html><html lang="pt-br"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Cadastro</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"></head>
<body class="d-flex justify-content-center align-items-center min-vh-100 bg-light">
<main class="container" style="max-width:500px"><div class="card p-4 shadow-sm"><h1 class="h3 text-center mb-4">Cadastro</h1>
<?php if ($error): ?><div class="alert alert-danger" role="alert"><?= e($error) ?></div><?php endif; ?>
<?php if ($success): ?><div class="alert alert-success" role="status"><?= e($success) ?> <a href="index.php">Entrar</a></div><?php endif; ?>
<form method="post"><input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
<div class="mb-3"><label for="username" class="form-label">Usuário</label><input class="form-control" id="username" name="username" maxlength="80" required value="<?= e($username ?? '') ?>"></div>
<div class="mb-3"><label for="email" class="form-label">E-mail</label><input class="form-control" id="email" type="email" name="email" maxlength="254" required value="<?= e($email ?? '') ?>"></div>
<div class="mb-3"><label for="idade" class="form-label">Idade</label><input class="form-control" id="idade" type="number" name="idade" min="0" max="120" required value="<?= e($age ?? '') ?>"></div>
<div class="mb-3"><label for="password" class="form-label">Senha (mínimo 12 caracteres)</label><input class="form-control" id="password" type="password" name="password" minlength="12" autocomplete="new-password" required></div>
<button class="btn btn-primary w-100" type="submit">Registrar</button></form>
<p class="text-center mt-3 mb-0">Já tem conta? <a href="index.php">Entrar</a></p></div></main></body></html>
