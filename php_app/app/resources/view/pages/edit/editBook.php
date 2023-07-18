<?php
session_start();
ob_start();
include_once '../../../config.php';
$connection = connect();

$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

$query_books_id = "SELECT * FROM books WHERE id = $id";
$result_books_id = $connection->prepare($query_books_id);
$result_books_id->execute();


if (($result_books_id) and ($result_books_id->rowCount() != 0)) {
    $row_books_id = $result_books_id->fetch(PDO::FETCH_ASSOC);
} else {
    $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Livro não encontrado!</p>";
    header("Location: /front/pages/list/listBooks");
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
    <title>Editar de livros</title>

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
                <a class="nav-link px-3" href="../../pages/list/listBooks">Voltar a listagem</a>
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
                                <span data-feather="listCostumers" class="align-text-bottom">Usuarios</span>

                            </a>

                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../../pages/list/listAuthors">
                                <span data-feather="listAuthors" class="align-text-bottom">Autores</span>

                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../../pages/list/listPublishers">
                                <span data-feather="listPublishers" class="align-text-bottom">Editoras</span>

                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../../pages/list/listEmployees">
                                <span data-feather="listEmployees" class="align-text-bottom">Funcionário(a)</span>

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

                        <div class="container ">
                            <main>
                                <div class="py-5 ml-2 text-center">
                                    <h2>Editar de Livros</h2>
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
                                        include_once '../../../controllerDB/update/updateBook.php'
                                    ?>

                                </div>
                                <div class="row g-5 px-5 mx-3 ">

                                    <div class="col-md-7 col-lg-12">
                                        <h5 class="mb-3">Edite as innformações revelantes sobre o livro</h5>
                                        <form class="needs-validation" action="" method="POST" novalidate="">
                                            <div class="row g-3">
                                                <div class="col-sm-7">
                                                    <label for="titule_book" class="form-label">Titulo</label>
                                                    <input type="text" class="form-control" name="titule" id="titule_book" placeholder="A bela e a fera" value="<?php
                                                                                                                                                                if (isset($titule))
                                                                                                                                                                    echo $titule;
                                                                                                                                                                elseif (isset($row_books_id['titule']))
                                                                                                                                                                    echo $row_books_id['titule'];
                                                                                                                                                                ?>">
                                                    <div class="invalid-feedback">
                                                        É necessario digitar o titulo do livro.
                                                    </div>
                                                </div>

                                                <div class="col-sm-2">
                                                    <label for="paginas_book" class="form-label">Número de
                                                        páginas</label>
                                                    <input type="number" class="form-control" name="page" id="paginas_book" placeholder="123" value="<?php
                                                                                                                                                        if (isset($page))
                                                                                                                                                            echo $page;
                                                                                                                                                        elseif (isset($row_books_id['page']))
                                                                                                                                                            echo $row_books_id['page'];
                                                                                                                                                        ?>">
                                                    <div class="invalid-feedback">
                                                        É necessario digitar quantidade de páginas do livro.
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <label for="realese_book" class="form-label">Data de
                                                        lançamento</label>
                                                    <input type="number" min="1900" max="2099" step="1" class="form-control" name="realese_date" id="realese_book" placeholder="1999" value="<?php
                                                                                                                                                                                                if (isset($realese_date))
                                                                                                                                                                                                    echo $realese_date;
                                                                                                                                                                                                elseif (isset($row_books_id['realese_date']))
                                                                                                                                                                                                    echo $row_books_id['realese_date'];
                                                                                                                                                                                                ?>">
                                                    <div class="invalid-feedback">
                                                        É necessario digitar o ano de lançamento do livro.
                                                    </div>
                                                </div>

                                                <div class="col-sm-2">

                                                    <label for="floatingSelect">Selecionar o autor</label>
                                                    <select class="form-select" id="floatingSelect" name="author_id" aria-label="Floating label select example">

                                                        <!-- Seleção para nomes dos autores section -->
                                                        <?php
                                                        $query_authors = "SELECT * FROM authors ";
                                                        $result_authors = $connection->prepare($query_authors);
                                                        $result_authors->execute();

                                                        if (($result_authors) and ($result_authors->rowCount() != 0)) {
                                                            while ($row_authors = $result_authors->fetch(PDO::FETCH_ASSOC)) {
                                                                echo "<option value='$row_authors[id]'>$row_authors[name]</option>";
                                                            }
                                                        } else {
                                                            echo "<p style='color:red;'>Não foi realizadar a listagem com sucesso.</p>";
                                                        };
                                                        ?>
                                                    </select>

                                                </div>
                                                <div class="col-sm-2">

                                                    <label for="floatingSelect">Selecionar o livraria</label>
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
                                                <div class="col-sm-2">

                                                    <label for="floatingSelect">Selecionar a editora</label>
                                                    <select class="form-select" id="floatingSelect" name="publisher_id" aria-label="Floating label select example">
                                                        <!-- Seleção para nomes das editoras section -->
                                                        <?php
                                                        $query_publishers = "SELECT * FROM publishers ";
                                                        $result_publishers = $connection->prepare($query_publishers);
                                                        $result_publishers->execute();

                                                        if (($result_publishers) and ($result_publishers->rowCount() != 0)) {
                                                            while ($row_publishers = $result_publishers->fetch(PDO::FETCH_ASSOC)) {
                                                                echo "<option value='$row_publishers[id]'>$row_publishers[name]</option>";
                                                            }
                                                        } else {
                                                            echo "<p style='color:red;'>Não foi realizadar a listagem com sucesso.</p>";
                                                        };
                                                        ?>
                                                    </select>

                                                </div>

                                            </div>

                                            <hr class="my-4">

                                            <input class="w-20 btn btn-primary btn-ls" type="submit" value="Salvar" name="edit_books">
                                        </form>
                                    </div>
                                </div>
                            </main>
                        </div>
                    </body>
                </div>
            </main>
            <footer class="text-muted text-center py-5">
                <div class="container">
                    <p class="mb-1">© 2023 Biblioteca Pedbot</p>
                </div>
            </footer>


        </div>



    </div>
    <script src="../../../bootstrap-5.2.3/dist/css/bootstrap.css"></script>
    <script src="../../../bootstrap-5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
    <script src="dashboard.js"></script>

</body>

</html>