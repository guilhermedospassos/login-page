<?php 
    session_start();

    include('php/config.php');
    if(!isset($_SESSION['valid'])) {
        header('Location: index.php');
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
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
            <h1 class="text-primary mx-2">Logo</h1>
            <div class="ms-auto d-flex align-items-center gap-2">

                <?php 
            
            $id = $_SESSION['id'];
            $query = mysqli_query($connect, "SELECT * FROM users WHERE Id = '$id'");

            while($result = mysqli_fetch_assoc($query)){
                $res_Uname = $result['Username'];
                $res_Email = $result['Email'];
                $res_Age = $result['Age'];
                $res_id = $result['Id'];
            }

            echo "<a href='editar.php?Id=$res_id'>Editar Perfil</a>";

            ?>

                <a class="btn btn-primary mx-2" href="logout.php">Sair</a>
            </div>
        </div>
    </nav>

    <main class="container flex-grow-1 d-flex justify-content-center align-items-center">
        <div class="row w-100 justify-content-center">
            <div class="col-md-8 col-lg-10">
                <div class="card mb-3">
                    <div class="card-body text-center py-4 h-100 d-flex align-items-center justify-content-center">
                        <p class="lead mb-0">Olá, <b><?= $res_Uname ?></b>, seja bem-vindo!</p>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-body text-center py-4 h-100 d-flex align-items-center justify-content-center">
                        <p class="lead mb-0">Seu e-mail é: <b><?= $res_Email ?></b>.</p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body text-center py-4 h-100 d-flex align-items-center justify-content-center">
                        <p class="lead mb-0">E você tem <b><?= $res_Age ?></b> anos.</p>
                    </div>
                </div>
            </div>
        </div>
    </main>

</body>


</html>