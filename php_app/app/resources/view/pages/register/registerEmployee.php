<?php
session_start();
include_once('../../../config.php');
$connection = connect();
?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de funcionários</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/dashboard/">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link href="../dashboard/dashboard.css" rel="stylesheet">
    <link href="../../../bootstrap-5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../bootstrap-5.2.3/dist/css/pages.css">

</head>

<body>

    <?php
    include_once '../../component/navbar.php';
    ?>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3 sidebar-sticky">
                    <ul class="nav flex-column">
                        <li>
                            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
                                <span>Cadastro</span>
                            </h6>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../../pages/register/registerCostumer">
                                <span data-feather="registerCostumer" class="align-text-bottom">Usuarios</span>

                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../../pages/register/registerAuthor">
                                <span data-feather="registerAuthor" class="align-text-bottom">Autores</span>

                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../../pages/register/registerPublisher">
                                <span data-feather="registerPublisher" class="align-text-bottom">Editoras</span>

                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../../pages/register/registerBook">
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
                                    <h2>Cadastro de Funcionário(a)</h2>
                                </div>
                                <?php
                                if (isset($_SESSION['msg'])) {
                                    echo $_SESSION['msg'];
                                    unset($_SESSION['msg']);
                                }
                                ?>
                                <div class="row g-5">

                                    <div class="col-md-7 col-lg-12">
                                        <h4 class="mb-3">Registro de dados</h4>
                                        <form class="needs-validation" action="../../../controllerDB/register/registerEmployee" method="post" novalidate="">
                                            <div class="row g-3">
                                                <div class="col-sm-7">
                                                    <label for="nome_employees" class="form-label">Nome completo</label>
                                                    <input type="text" class="form-control" name="name" id="nome_employees" placeholder="Fulano da Silva " value="" required="">
                                                    <div class="invalid-feedback">
                                                        É necessario digitar o nome do funcionário(a).
                                                    </div>
                                                </div>

                                                <div class="col-sm-5">
                                                    <label for="pis_employees" class="form-label">PIS</label>
                                                    <input type="number" class="form-control" min="1" name="pis" id="pis_employees" placeholder="123.45678.91-0" value="" required="">
                                                    <div class="invalid-feedback">
                                                        É necessario digitar o seu telefone.
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="cargo_employees" class="form-lab  el">Cargo</label>
                                                    <input type="text" class="form-control" name="office" id="cargo_employees" placeholder="Vendedor">
                                                    <div class="invalid-feedback">
                                                        Por favor, digite o cargo do funcionário(a).
                                                    </div>
                                                </div>

                                                <div class="col-sm-4">
                                                    <label for="departamento_employees" class="form-lab  el">Departamento</label>
                                                    <input type="text" class="form-control" name="departament" id="departamento_employees" placeholder="Vendas">
                                                    <div class="invalid-feedback">
                                                        Por favor, digite o departamento do funcionário(a).
                                                    </div>
                                                </div>

                                                <div class="col-sm-3">
                                                    <label for="departamento_employees" class="form-lab  el">Livraria</label>
                                                    <select class="form-select" id="floatingSelect" name="library_id" aria-label="Floating label select example">
                                                        <option selected></option>
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

                                            <button class="w-20 btn btn-primary btn-ls" type="submit">Enviar</button>
                                        </form>
                                    </div>
                                </div>
                            </main>

                            <footer class="text-muted text-center py-5">
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