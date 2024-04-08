<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="d-flex justify-content-center align-items-center vh-100">
    <div class="container">
        <div class="box form-box bg-light p-4 rounded shadow w-50 m-auto">
            <header class="text-center mb-4">
                <h4 class="display-4">Login</h4>
            </header>
            <form action="" method="post">
                <div class="field input mb-3">
                    <label for="username" class="form-label">Usuário</label>
                    <input type="text" name="username" id="username" class="form-control"
                        placeholder="Insira seu nome de usário" autocomplete="off" required>
                </div>
                <div class="field input mb-3">
                    <label for="password" class="form-label">Senha</label>
                    <div class="input-group">
                        <input type="password" name="password" id="password" class="form-control"
                            placeholder="Insira sua senha" autocomplete="off" required>
                    </div>
                </div>
                <div class="field button mb-3">
                    <input type="submit" name="submit" value="Login" class="btn btn-primary w-100" required>
                </div>
                <div class="links text-center">
                    Não possui uma conta? <a href="registro.php">Clique aqui</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>