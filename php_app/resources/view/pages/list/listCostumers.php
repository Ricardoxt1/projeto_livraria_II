<?php
session_start();
ob_start();
include_once '../../../config.php';
$connection = connect();
?>
<!doctype html>
<html lang="pt">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Um projeto voltado ao sistema de gestão para biblioteca">
    <meta name="Ricardo" content="Sistema de biblioteca">
    <meta name="generator" content="Ricardo">
    <title>Listagem de Usuarios</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/dashboard/">
    <link rel="stylesheet" href="../../../bootstrap-5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../dashboard/dashboard.css">
    <link rel="stylesheet" href="../../../bootstrap-5.2.3/dist/css/pages.css">

</head>

<body>

    <?php
    include_once '../../componentNavbar/navbar.php';
    ?>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3 sidebar-sticky">
                    <ul class="nav flex-column">
                        <li>
                            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
                                <span>Listagem de itens</span>
                            </h6>

                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../list/listBooks">
                                <span data-feather="listBooks" class="align-text-bottom">Livros</span>
                            </a>

                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../list/listAuthors">
                                <span data-feather="listAuthors" class="align-text-bottom">Autores</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../list/listPublishers">
                                <span data-feather="listPublishers" class="align-text-bottom">Editoras</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../list/listEmployees">
                                <span data-feather="listEmployees" class="align-text-bottom">Funcionário(a)</span>
                            </a>
                        </li>

                    </ul>

                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
                        <span>Opções</span>
                    </h6>

                    <ul class="nav flex-column mb-2">
                        <li class="nav-item">
                            <a class="nav-link" href="../list/listRentals">
                                <span name="rentals" class="align-text-bottom">Alugueis</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../register/registerCostumer">
                                <span data-feather="file-text" class="align-text-bottom">Cadastrar</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="col-md-9 ms-sm col-lg-8 px-md-5">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Listagem de Usuarios</h1>
                </div>
                <div>
                    <?php
                    if (isset($_SESSION['msg'])) {
                        echo $_SESSION['msg'];
                        unset($_SESSION['msg']);
                    }
                    ?>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-ls">
                        <thead>
                            <tr>
                                <th scope="col">Nome</th>
                                <th scope="col">Telefone</th>
                                <th scope="col">Endereço</th>
                                <th scope="col">Email</th>

                            </tr>
                        </thead>

                        <?php
                        $query_costumers = "SELECT * FROM costumers";
                        $result_costumers = $connection->prepare($query_costumers);
                        $result_costumers->execute();

                        if ($result_costumers && $result_costumers->rowCount() != 0) {
                            while ($row_costumers = $result_costumers->fetch(PDO::FETCH_ASSOC)) {
                                $id = $row_costumers['id'];
                                echo "
                                    <form action='' method='get'>
                                        <tbody>
                                            <tr>
                                                <td name='name_costumers'>$row_costumers[name]</td>
                                                <td name='phone_number_costumers'>$row_costumers[phone_number]</td>
                                                <td name='address_costumers'>$row_costumers[address]</td>
                                                <td name='email_costumers'>$row_costumers[email]</td>
                                                <td name='edit_name'><a href='../edit/editCostumer.php?id=$id'><svg xmlns='http://www.w3.org/2000/svg' width='18' height='18' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16'>
                                                    <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
                                                    <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z'/></svg>
                                                </a>
                                                <td name='delete_name'>
                                                    <a href='#' data-toggle='modal' data-target='#confirmDeleteModal$id'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='18' height='18' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'>
                                                            <path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z' />
                                                            <path d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z' />
                                                        </svg>
                                                    </a>

                                                    <!-- Modal de confirmação de deleção -->
                                                    <div class='modal fade' id='confirmDeleteModal$id' tabindex='-1' role='dialog' aria-labelledby='confirmDeleteModalLabel' aria-hidden='true'>
                                                        <div class='modal-dialog' role='document'>
                                                            <div class='modal-content'>
                                                                <div class='modal-header'>
                                                                    <h5 class='modal-title' id='confirmDeleteModalLabel'>Confirmar Deleção</h5>
                                                                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                                                        <span aria-hidden='true'>&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class='modal-body'>
                                                                    Tem certeza de que deseja excluir este livro?
                                                                </div>
                                                                <div class='modal-footer'>
                                                                    <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>
                                                                    <a href='../../../controllerDB/delete/deleteCostumer.php?id=$id' class='btn btn-danger'>Excluir</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </form>";
                            }
                        } else {
                            echo "<p style='color:red;'>Não foi possível realizar a listagem com sucesso.</p>";
                        }
                        ?>

                    </table>


                </div>
                <footer class="text-muted text-center py-5">
                    <div class="container">
                        <p class="mb-1">© 2023 Biblioteca Pedbot</p>
                    </div>
                </footer>

            </main>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="../../../bootstrap-5.2.3/dist/css/bootstrap.css"></script>
    <script src="../../../bootstrap-5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
    <script src="dashboard.js"></script>
</body>

</html>