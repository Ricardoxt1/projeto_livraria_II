<?php
session_start();
ob_start();
include_once('../../../config.php');
$connection = connect();

$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

$query_rentals = "SELECT * FROM rentals WHERE id = $id";
$result_rentals = $connection->prepare($query_rentals);
$result_rentals->execute();

if (($result_rentals) and ($result_rentals->rowCount() != 0)) {
    $row_rentals = $result_rentals->fetch(PDO::FETCH_ASSOC);
} else {
    $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Alguel não encontrado!</p>";
    header("Location: /front/pages/list/listRentals");
    exit;
};
?>

<!doctype html>
<html lang="pt">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Um projeto voltado ao sistema de gestão para biblioteca">
    <meta name="Ricardo" content="Sistema de biblioteca">
    <meta name="generator" content="Ricardo">
    <title>Aluguel de livros</title>

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
                <a class="nav-link px-3" href="../../pages/list/listRentals">Voltar a listagem</a>
            </div>
        </div>
    </header>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3 sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
                                <span>Editar</span>
                            </h6>

                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../../pages/list_list_costumers">
                                <span data-feather="registerCostumer" class="align-text-bottom">Usuarios</span>

                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../../pages/list_list_books">
                                <span data-feather="registerBook" class="align-text-bottom">Livros</span>

                            </a>

                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../../pages/listAuthors">
                                <span data-feather="registerAuthor" class="align-text-bottom">Autores</span>

                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../../pages/list_list_publishers">
                                <span data-feather="registerPublisher" class="align-text-bottom">Editoras</span>

                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../../pages/list_list_employees">
                                <span name="registerEmployee" data-feather="registerEmployee" class="align-text-bottom">Funcionário(a)</span>

                            </a>
                        </li>

                    </ul>

                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
                        <span>Opções</span>
                    </h6>
                    <ul class="nav flex-column mb-2">
                        <li class="nav-item">
                            <a class="nav-link" href="../list/listCostumers">
                                <span data-feather="list" class="align-text-bottom">Listagem</span>

                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">

                    <body class="bg-body-tertiary">

                        <div class="container">
                            <main>
                                <div class="py-5 text-center">
                                    <h2>Aluguel de livros</h2>
                                    <div>
                                        <?php
                                        if (isset($_SESSION['msg'])) {
                                            echo $_SESSION['msg'];
                                            unset($_SESSION['msg']);
                                        }
                                        ?>
                                    </div>
                                </div>

                                <div class="row g-5">

                                    <div class="col-md-7 col-lg-12">
                                        <h4 class="mb-3">Registro sobre o aluguel</h4>
                                        <div>
                                            <div>
                                                <?php 
                                                    include_once '../../../controllerDB/update/updateRental.php';
                                                ?>
                                            </div>

                                            <form class="needs-validation" action="" method="post" novalidate="">
                                                <div class="row g-3">
                                                    <div class="col-sm-4">
                                                        <label for="floatingSelect">Selecionar o consumidor</label>
                                                        <select class="form-select" id="floatingSelect" name="id_costumers_rental" aria-label="Floating label select example">

                                                            <!-- Seleção para nomes dos consumidores section -->
                                                            <?php
                                                            $query_costumers = "SELECT * FROM costumers";
                                                            $result_costumers = $connection->prepare($query_costumers);
                                                            $result_costumers->execute();

                                                            if (($result_costumers) and ($result_costumers->rowCount() != 0)) {
                                                                while ($row_costumers = $result_costumers->fetch(PDO::FETCH_ASSOC)) {
                                                                    echo "<option value='$row_costumers[id]'>$row_costumers[name]</option>";
                                                                }
                                                            } else {
                                                                echo "<p style='color:red;'>Não foi realizadar a listagem com sucesso.</p>";
                                                            };
                                                            ?>
                                                        </select>

                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label for="floatingSelect">Selecionar o livro</label>
                                                        <select class="form-select" id="floatingSelect" name="id_book_rental" aria-label="Floating label select example">

                                                            <!-- Seleção para nomes dos livros section -->
                                                            <?php
                                                            $query_books = "SELECT * FROM books";
                                                            $result_books = $connection->prepare($query_books);
                                                            $result_books->execute();

                                                            if (($result_books) and ($result_books->rowCount() != 0)) {
                                                                while ($row_books = $result_books->fetch(PDO::FETCH_ASSOC)) {
                                                                    echo "<option value='$row_books[id]'>$row_books[titule]</option>";
                                                                }
                                                            } else {
                                                                echo "<p style='color:red;'>Não foi realizadar a listagem com sucesso.</p>";
                                                            };
                                                            ?>
                                                        </select>

                                                    </div>
                                                    <div class="col-sm-3">
                                                        <label for="floatingSelect">Selecionar o vendedor</label>
                                                        <select class="form-select" id="floatingSelect" name="id_employees_rental" aria-label="Floating label select example">
                                                            <!-- Seleção para nomes dos livros section -->
                                                            <?php
                                                            $query_employees = "SELECT * FROM employees";
                                                            $result_employees = $connection->prepare($query_employees);
                                                            $result_employees->execute();

                                                            if (($result_employees) and ($result_employees->rowCount() != 0)) {
                                                                while ($row_employees = $result_employees->fetch(PDO::FETCH_ASSOC)) {
                                                                    echo "<option value='$row_employees[id]'>$row_employees[name]</option>";
                                                                }
                                                            } else {
                                                                echo "<p style='color:red;'>Não foi realizadar a listagem com sucesso.</p>";
                                                            };
                                                            ?>
                                                        </select>

                                                    </div>
                                                    <div class="col-sm-2">
                                                        <label for="rental" class="form-label">Data do
                                                            aluguel</label>
                                                        <input type="date" class="form-control" name="rental" id="rental" value="<?php
                                                                                                                                    if (isset($rental))
                                                                                                                                        echo $rental;
                                                                                                                                    elseif (isset($row_rentals['rental']))
                                                                                                                                        echo $row_rentals['rental'];
                                                                                                                                    ?>">
                                                        <div class="invalid-feedback">
                                                            É necessario digitar a data do aluguel.
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <label for="delivery" class="form-label">Data previsão de
                                                            devolução</label>
                                                        <input type="date" class="form-control" name="delivery" id="delivery" value="<?php
                                                                                                                                        if (isset($delivery))
                                                                                                                                            echo $delivery;
                                                                                                                                        elseif (isset($row_rentals['delivery']))
                                                                                                                                            echo $row_rentals['delivery'];
                                                                                                                                        ?>">
                                                        <div class="invalid-feedback">
                                                            É necessario digitar a data da previsão de devolução.
                                                        </div>
                                                    </div>



                                                </div>

                                                <hr class="my-4">

                                                <input class="w-20 btn btn-primary btn-ls" type="submit" value="Salvar" name="edit_rentals">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </main>

                            <footer class="text-muted py-5">
                                <div class="container">
                                    <p class="mb-1">© 2023 Biblioteca Pedbot</p>
                                </div>
                            </footer>
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