<?php
require_once __DIR__ . '/php/config.php';
$id = require_login();
$stmt = $connect->prepare('SELECT Id, Username, Email, Age FROM users WHERE Id = ? LIMIT 1');
$stmt->bind_param('i', $id); $stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
if (!$user) { $_SESSION = []; session_destroy(); header('Location: index.php'); exit; }
?>
<!DOCTYPE html><html lang="pt-br"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Minha conta</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"></head>
<body class="bg-light"><nav class="navbar navbar-light bg-white border-bottom"><div class="container"><a href="home.php" class="navbar-brand">Minha conta</a>
<form action="php/logout.php" method="post"><input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>"><button type="submit" class="btn btn-outline-secondary">Sair</button></form></div></nav>
<main class="container py-5" style="max-width:680px"><div class="card p-4 shadow-sm"><h1 class="h3">Olá, <?= e($user['Username']) ?>!</h1>
<p>Seu e-mail: <strong><?= e($user['Email']) ?></strong></p>
<p>Sua idade: <strong><?= e($user['Age']) ?></strong></p>
<a class="btn btn-primary" href="editar.php">Editar perfil</a></div></main></body></html>
