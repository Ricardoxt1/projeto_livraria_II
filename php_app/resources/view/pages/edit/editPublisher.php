<?php
session_start();
ob_start();
include_once '../../../config.php';
$connection = connect();

$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

$query_publishers = "SELECT * FROM publishers WHERE id = $id";
$result_publishers = $connection->prepare($query_publishers);
$result_publishers->execute();


if (($result_publishers) and ($result_publishers->rowCount() != 0)) {
    $row_publishers = $result_publishers->fetch(PDO::FETCH_ASSOC);
} else {
    $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Editora não encontrado!</p>";
    header("Location: /front/pages/list/listPublishers");
    exit;
};

?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edição de Editoras</title>

    <link href="https://getbootstrap.com/docs/5.2/examples/dashboard/" rel="canonical">
    <link href="../../../bootstrap-5.2.3/dist/css/pages.css" rel="stylesheet">
    <link href="../../../bootstrap-5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../dashboard/dashboard.css" rel="stylesheet">

</head>

<body>
    <header class="navbar navbar-dark sticky-top bg-primary flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="#">Biblioteca Pedbot</a>
        <button class="navbar-toggler position-center d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-nav">
            <div class="nav-item text-nowrap">
                <a class="nav-link px-3" href="../../pages/list/listPublishers">Voltar a listagem</a>
            </div>
        </div>
    </header>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3 sidebar-sticky">
                    <ul class="nav flex-column">
                        <li>
                            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
                                <span>Editar</span>
                            </h6>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../../pages/list/listCostumers">
                                <span data-feather="registerCostumer" class="align-text-bottom">Usuarios</span>

                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../../pages/list/listAuthors">
                                <span data-feather="registerAuthor" class="align-text-bottom">Autores</span>

                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../../pages/list/listBooks">
                                <span data-feather="registerBook" class="align-text-bottom">Livros</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../../pages/list/listEmployees">
                                <span data-feather="registerEmployee" class="align-text-bottom">Funcionário(a)</span>
                            </a>
                        </li>
                        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
                            <span>Opções</span>
                        </h6>
                        <ul class="nav flex-column mb-2">
                            <li class="nav-item">
                                <a class="nav-link" href="../../pages/register/registerRental">
                                    <span name="rentals" class="align-text-bottom">Alugar livro</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../list/listCostumers">
                                    <span data-feather="list" class="align-text-bottom">Listagem</span>
                                </a>
                            </li>
                        </ul>
                    </ul>
                </div>
            </nav>

            <main class="col-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">

                    <body class="bg-body-tertiary">

                        <div class="container">
                            <main>
                                <div class="py-5 ml-2">
                                    <h2>Cadastro de Editoras</h2>
                                    <div>
                                        <?php
                                        if (isset($_SESSION['msg'])) {
                                            echo $_SESSION['msg'];
                                            unset($_SESSION['msg']);
                                        }
                                        ?>
                                    </div>
                                    <div>
                                        <?php
                                        include_once '../../../controllerDB/update/updatePublisher.php';
                                        ?>
                                    </div>
                                    <div class="row g-5 pt-5">
                                        <div class="col-md-7 col-lg-10">
                                            <h5 class="mb-3">Editar informações revelantes sobre a editora</h5>
                                        </div>
                                    </div>
                                    <form class="needs-validation" action="" method="post" novalidate="">
                                        <div class="row g-3">
                                            <div class="col-sm-7">
                                                <label for="name_publisher" class="form-label">Nome da editora</label>
                                                <input type="text" class="form-control" name="name" id="name_publisher" placeholder="Editora São Miguel" value="<?php
                                                                                                                                                                if (isset($name))
                                                                                                                                                                    echo $name;
                                                                                                                                                                elseif (isset($row_publishers['name']))
                                                                                                                                                                    echo $row_publishers['name'];
                                                                                                                                                                ?>">
                                                <div class="invalid-feedback">
                                                    É necessario digitar o nome da editora.
                                                </div>
                                                <hr class="my-4">

                                                <input class="w-20 btn btn-primary btn-ls" type="submit" value="Salvar" name="edit_publishers">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <footer class="text-muted py-5">
                                    <div class="container">
                                        <p class="mb-1">© 2023 Biblioteca Pedbot</p>
                                    </div>
                                </footer>
                            </main>
                        </div>

                    </body>

                </div>
            </main>
        </div>
    </div>
    <script src="../../../bootstrap-5.2.3/dist/css/bootstrap.css"></script>
    <script src="../../../bootstrap-5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
    <script src="dashboard.js"></script>

</body>

</html>