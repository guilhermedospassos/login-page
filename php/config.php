<?php
declare(strict_types=1);

require_once __DIR__ . '/bootstrap.php';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$host = getenv('DB_HOST') ?: '127.0.0.1';
$user = getenv('DB_USER');
$pass = getenv('DB_PASSWORD');
$name = getenv('DB_NAME');
$port = getenv('DB_PORT') ?: '3306';

if ($user === false || $pass === false || $name === false || !ctype_digit((string) $port)) {
    http_response_code(503);
    exit('Configuração do banco indisponível.');
}

try {
    $connect = new mysqli($host, $user, $pass, $name, (int) $port);
    $connect->set_charset('utf8mb4');
} catch (mysqli_sql_exception $exception) {
    error_log('Falha na conexão com o banco: ' . $exception->getCode());
    http_response_code(503);
    exit('Serviço temporariamente indisponível.');
}
