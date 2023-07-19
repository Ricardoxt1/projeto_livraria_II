<?php
session_start();
ob_start();
include_once '../../../config.php';
$connection = connect();

$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

$query_employees = "SELECT  * FROM employees WHERE id = $id";
$result_employees = $connection->prepare($query_employees);
$result_employees->execute();


if (($result_employees) and ($result_employees->rowCount() != 0)) {
    $row_employees = $result_employees->fetch(PDO::FETCH_ASSOC);
} else {
    $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Funcionário não encontrado!</p>";
    header("Location: /front/pages/list/listEmployees");
    exit;
};
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar funcionários</title>

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
                <a class="nav-link px-3" href="../../pages/list/listEmployees">Voltar a listagem</a>
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
                            <a class="nav-link" href="../../pages/list/listPublishers">
                                <span data-feather="registerPublisher" class="align-text-bottom">Editoras</span>

                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../../pages/list/listBooks">
                                <span data-feather="registerBook" class="align-text-bottom">Livros</span>

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

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">

                    <body class="bg-body-tertiary">

                        <div class="container">
                            <main>
                                <div class="py-5 text-center">
                                    <h2>Editar Funcionário(a)</h2>
                                </div>
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
                                    include_once '../../../controllerDB/update/updateEmployee.php';
                                    ?>
                                </div>
                                <div>

                                    <div class="row g-5">

                                        <div class="col-md-7 col-lg-12">
                                            <h4 class="mb-3">Editar dados</h4>
                                            <form class="needs-validation" action="" method="post" novalidate="">
                                                <div class="row g-3">
                                                    <div class="col-sm-7">
                                                        <label for="nome_employees" class="form-label">Nome completo</label>
                                                        <input type="text" class="form-control" name="name" id="nome_employees" placeholder="Fulano da Silva " value="<?php
                                                                                                                                                                        if (isset($name))
                                                                                                                                                                            echo $name;
                                                                                                                                                                        elseif (isset($row_employees['name']))
                                                                                                                                                                            echo $row_employees['name'];
                                                                                                                                                                        ?>">
                                                        <div class="invalid-feedback">
                                                            É necessario digitar o nome do funcionário(a).
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-5">
                                                        <label for="pis_employees" class="form-label">PIS</label>
                                                        <input type="number" class="form-control" min="1" name="pis" id="pis_employees" placeholder="123.45678.91-0" value="<?php
                                                                                                                                                                            if (isset($pis))
                                                                                                                                                                                echo $pis;
                                                                                                                                                                            elseif (isset($row_employees['pis']))
                                                                                                                                                                                echo $row_employees['pis'];
                                                                                                                                                                            ?>">
                                                        <div class="invalid-feedback">
                                                            É necessario digitar o seu telefone.
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label for="cargo_employees" class="form-lab  el">Cargo</label>
                                                        <input type="text" class="form-control" name="office" id="cargo_employees" placeholder="Vendedor" value="<?php
                                                                                                                                                                    if (isset($office))
                                                                                                                                                                        echo $office;
                                                                                                                                                                    elseif (isset($row_employees['office']))
                                                                                                                                                                        echo $row_employees['office'];
                                                                                                                                                                    ?>">
                                                        <div class="invalid-feedback">
                                                            Por favor, digite o cargo do funcionário(a).
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <label for="departamento_employees" class="form-lab  el">Departamento</label>
                                                        <input type="text" class="form-control" name="departament" id="departamento_employees" placeholder="Vendas" value="<?php
                                                                                                                                                                            if (isset($departament))
                                                                                                                                                                                echo $departament;
                                                                                                                                                                            elseif (isset($row_employees['departament']))
                                                                                                                                                                                echo $row_employees['departament'];
                                                                                                                                                                            ?>">
                                                        <div class="invalid-feedback">
                                                            Por favor, digite o departamento do funcionário(a).
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-3">
                                                        <label for="departamento_employees" class="form-lab  el">Livraria</label>
                                                        <select class="form-select" id="floatingSelect" name="library_id" aria-label="Floating label select example">

                                                            <?php
                                                            $query_libraries = "SELECT * FROM libraries ";
                                                            $result_libraries = $connection->prepare($query_libraries);
                                                            $result_libraries->execute();

                                                            if (($result_libraries) and ($result_libraries->rowCount() != 0)) {
                                                                while ($row_libraries = $result_libraries->fetch(PDO::FETCH_ASSOC)) {
                                                                    echo "<option value='$row_libraries[id]'>$row_libraries[name]</option>";
                                                                }
                                                            } else {
                                                                echo "<p style='color:red;'>Não foi realizadar a listagem com sucesso.</p>";
                                                            };
                                                            ?>
                                                        </select>

                                                    </div>

                                                </div>

                                                <hr class="my-4">

                                                <input class="w-20 btn btn-primary btn-ls" type="submit" value="Salvar" name="edit_employees">
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