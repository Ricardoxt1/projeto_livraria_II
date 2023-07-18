<?php
session_start();
?>
<!doctype html>
<html lang="pt">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Um projeto voltado ao sistema de gestão para biblioteca">
    <meta name="Ricardo" content="Sistema de biblioteca">
    <meta name="generator" content="Ricardo">
    <title>Cadastro de Usuarios</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/dashboard/">
    <link href="../../../bootstrap-5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../dashboard/dashboard.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
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
                        <li class="nav-item">
                            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
                                <span>Cadastro</span>
                            </h6>

                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../../pages/register/registerBook">
                                <span data-feather="registerBook" class="align-text-bottom">Livros</span>
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
                            <a class="nav-link" href="../../pages/register/registerEmployee">
                                <span name="registerEmployee" data-feather="funcionário(a)" class="align-text-bottom">Funcionário(a)</span>
                            </a>
                        </li>

                    </ul>

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
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">

                    <body class="bg-body-tertiary">

                        <div class="container">
                            <main>
                                <div class="py-5 text-center">
                                    <h2>Cadastro de Usuarios</h2>
                                </div>
                                <?php
                                if (isset($_SESSION['msg'])) {
                                    echo $_SESSION['msg'];
                                    unset($_SESSION['msg']);
                                }
                                ?>
                                <div class="row g-5">

                                    <div class="col-md-7 col-lg-12">
                                        <h4 class="mb-3">Registro dados pessoais</h4>
                                        <form class="needs-validation" action="../../../../app/Controller/Register" method="post">
                                            <div class="row g-3">
                                                <div class="col-sm-7">
                                                    <label for="nome_costumer" class="form-label">Nome completo</label>
                                                    <input type="text" class="form-control" name="name" id="nome_costumer" placeholder="fulano da silva " value="" required="">
                                                    <div class="invalid-feedback">
                                                        É necessario digitar o seu nome.
                                                    </div>
                                                </div>

                                                <div class="col-sm-5">
                                                    <label for="numero_costumer" class="form-label">Telefone</label>
                                                    <input type="number" class="form-control" name="phone_number" id="numero_costumer" placeholder="(00) 0000-0000" value="" required="">
                                                    <div class="invalid-feedback">
                                                        É necessario digitar o seu telefone.
                                                    </div>
                                                </div>
                                                <div class="col-sm-7">
                                                    <label for="email_costumer" class="form-label">Email <span class="text-body-secondary">(Optional)</span></label>
                                                    <input type="email" class="form-control" name="email" id="email_costumer" placeholder="you@example.com">
                                                    <div class="invalid-feedback">
                                                        Por favor, entre com um email valido.
                                                    </div>
                                                </div>

                                                <div class="col-sm-5">
                                                    <label for="cpf_costumer" class="form-label">CPF</label>
                                                    <input type="number" class="form-control" name="cpf" id="cpf_costumer" placeholder="123.456.789-09" min="1" max="14" value="" required="">
                                                    <div class="invalid-feedback">
                                                        É necessario digitar o cpf.
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <label for="address_costumer" class="form-label">Endereço</label>
                                                    <input type="text" class="form-control" name="address" id="address_costumer" placeholder="Main ST 1234" required="">
                                                    <div class="invalid-feedback">
                                                        Por favor, entre com endereço valido.
                                                    </div>
                                                </div>

                                            </div>

                                            <hr class="my-4">

                                            <button class="w-20 btn btn-primary btn-ls" name="register" type="submit">Enviar</button>
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