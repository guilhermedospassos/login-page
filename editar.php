<?php
require_once __DIR__ . '/php/config.php';
$id = require_login(); $error = ''; $success = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $username = post_string('username'); $email = post_string('email'); $age = post_string('idade');
    $error = profile_validation_error($username, $email, $age) ?? '';
    if (!$error) {
        try {
            $ageInt = (int) $age;
            $stmt = $connect->prepare('UPDATE users SET Username = ?, Email = ?, Age = ? WHERE Id = ?');
            $stmt->bind_param('ssii', $username, $email, $ageInt, $id);
            $stmt->execute();
            $success = 'Dados atualizados com sucesso.';
        } catch (mysqli_sql_exception $exception) {
            error_log('Falha ao editar usuário: ' . $exception->getCode());
            $error = $exception->getCode() === 1062 ? 'Este e-mail já está cadastrado.' : 'Não foi possível atualizar seus dados.';
        }
    }
}
$stmt = $connect->prepare('SELECT Username, Email, Age FROM users WHERE Id = ? LIMIT 1');
$stmt->bind_param('i', $id); $stmt->execute(); $user = $stmt->get_result()->fetch_assoc();
if (!$user) { $_SESSION = []; session_destroy(); header('Location: index.php'); exit; }
?>
<!DOCTYPE html><html lang="pt-br"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Editar perfil</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"></head>
<body class="d-flex justify-content-center align-items-center min-vh-100 bg-light"><main class="container" style="max-width:500px"><div class="card p-4 shadow-sm">
<h1 class="h3 text-center mb-4">Editar perfil</h1>
<?php if ($error): ?><div class="alert alert-danger" role="alert"><?= e($error) ?></div><?php endif; ?>
<?php if ($success): ?><div class="alert alert-success" role="status"><?= e($success) ?></div><?php endif; ?>
<form method="post"><input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
<div class="mb-3"><label for="username" class="form-label">Usuário</label><input class="form-control" id="username" name="username" maxlength="80" required value="<?= e($user['Username']) ?>"></div>
<div class="mb-3"><label for="email" class="form-label">E-mail</label><input class="form-control" id="email" name="email" type="email" maxlength="254" required value="<?= e($user['Email']) ?>"></div>
<div class="mb-3"><label for="idade" class="form-label">Idade</label><input class="form-control" id="idade" name="idade" type="number" min="0" max="120" required value="<?= e($user['Age']) ?>"></div>
<button type="submit" class="btn btn-primary w-100">Salvar alterações</button></form><a href="home.php" class="btn btn-link mt-2">Voltar</a></div></main></body></html>
