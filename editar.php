<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mudar de conta</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="d-flex flex-column min-vh-100">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="text-decoration-none" href="home.php">
                <h1 class="text-primary mx-2">Logo</h1>
            </a>
            <div class="ms-auto d-flex align-items-center gap-2">
                <a href="editar.php">Editar Perfil</a>
                <a class="btn btn-primary mx-2" href="php/logout.php">Sair</a>
            </div>
        </div>
    </nav>

    <div class="container flex-grow-1 d-flex justify-content-center align-items-center">
        <div class="box form-box bg-light p-4 rounded shadow w-50 m-auto">
            <header class="text-center mb-4">
                <h4 class="display-4">Altere seus dados</h4>
            </header>
            <form action="" method="post">
                <div class="field input mb-3">
                    <label for="username" class="form-label">Usuário</label>
                    <input type="text" name="username" id="username" class="form-control"
                        placeholder="Insira seu novo nome de usário" autocomplete="off" required>
                </div>
                <div class="field input mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="text" name="email" id="email" class="form-control"
                        placeholder="Insira seu novo nome de usário" autocomplete="off" required>
                </div>
                <div class="field input mb-3">
                    <label for="idade" class="form-label">Idade</label>
                    <input type="number" name="idade" id="idade" class="form-control" placeholder="Insira sua idade"
                        autocomplete="off" min="0" required>
                </div>

                <div class="field button mb-3">
                    <input type="submit" name="submit" value="Atualizar" class="btn btn-primary w-100" required>
                </div>
            </form>
        </div>
    </div>
</body>


</html>