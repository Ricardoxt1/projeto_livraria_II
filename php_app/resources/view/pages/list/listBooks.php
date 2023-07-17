<?php
session_start();
ob_start();
include_once '../../../config.php';
$connection = connect();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Um projeto voltado ao sistema de gestão para biblioteca">
    <meta name="Ricardo" content="Sistema de biblioteca">
    <meta name="generator" content="Ricardo">
    <title>Lista de livros</title>

    <link href="https://getbootstrap.com/docs/5.2/examples/album/" rel="canonical">
    <link href="../../../bootstrap-5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../../bootstrap-5.2.3/dist/css/pages.css" rel="stylesheet">

</head>

<body>

    <header>
        <header class="navbar navbar-dark sticky-top bg-primary flex-md-nowrap p-0 shadow">
            <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="#">Biblioteca Pedbot</a>
            <a href="https://getbootstrap.com/docs/5.2/examples/album/#" class="navbar-brand d-flex align-items-center">

                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="30" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" aria-hidden="true" class="me-2" viewBox="0 0 24 24">
                    <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z" />
                </svg>
                <strong>Livros</strong>
            </a>
            <div class="navbar-nav">
                <div class="nav-item text-nowrap">
                    <a class="nav-link px-3" href="../../pages/list/listCostumers">Voltar a listagem</a>
                </div>
            </div>
        </header>
    </header>



    <main>
        <div class='album py-5 bg-light'>
            <div class='container'>
                <div class='row g-1'>
                    <?php

                    if (isset($_SESSION['msg'])) {
                        echo $_SESSION['msg'];
                        unset($_SESSION['msg']);
                    }

                    ?>
                    <nav aria-label="Page navigation example ">
                        <ul class="pagination justify-content-center">
                            <?php
                            // Paginação
                            $limit = 3; // Número de itens por página
                            $query_count = "SELECT COUNT(*) as total FROM books";
                            $result_count = $connection->prepare($query_count);
                            $result_count->execute();
                            $row_count = $result_count->fetch(PDO::FETCH_ASSOC);
                            $total_pages = ceil($row_count['total'] / $limit); // Total de páginas

                            $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
                            $start = ($current_page - 1) * $limit; // Início dos registros

                            $query_books = "SELECT  books.id, books.titule, books.page, books.realese_date, books.author_id as author_id, authors.name as authors_name, publishers.name as publishers_name  FROM books INNER JOIN authors ON authors.id = books.author_id INNER JOIN publishers ON publishers.id = books.publisher_id LIMIT $start, $limit";
                            $result_books = $connection->prepare($query_books);
                            $result_books->execute();

                            while ($row_book = $result_books->fetch(PDO::FETCH_ASSOC)) {
                                $id = $row_book['id'];
                                echo "<div class='col'>
                                <div class='card shadow-sm'>
                                <svg class='bd-placeholder-img card-img-top' width='100%' height='300' xmlns='http://www.w3.org/2000/svg' role='img' aria-label='Placeholder: Thumbnail' preserveAspectRatio='xMidYMid slice' focusable='false'>
                                <title>Placeholder</title>
                                                <rect width='100%' height='100%' fill='#55595c'></rect><text x='50%' y='50%' fill='#eceeef' dy='.3em'>Thumbnail</text>
                                                </svg>
                                                
                                                <div class='card-body p-4'>
                                                
                                                <p class='card-text'>Titulo: " . $row_book['titule'] . "</p>
                                                <p class='card-text'>Páginas: " . $row_book['page'] . "</p>
                                                <p class='card-text'>Lançamento: " . $row_book['realese_date'] . "</p>
                                                <p class='card-text'>Autor(a): " . $row_book["authors_name"] . "</p>
                                                <p class='card-text'>Editora: " . $row_book["publishers_name"] . "</p>
                                                <div class='d-flex justify-content-between align-items-center'>
                                                <div class='btn-group m-1'>
                                                <a class='m-2' href='../edit/editBook.php?id=$id'><svg xmlns='http://www.w3.org/2000/svg' width='22' height='22' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16'>
                                                <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
                                                <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z'/>
                                                                                       </svg>
                                                        </a>
                                                        <a class='m-2' href='../../../controllerDB/delete/deleteBook.php?id=$id'><svg xmlns='http://www.w3.org/2000/svg' width='22' height='22' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'>
                                                        <path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z' />
                                                                                            <path d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z' /></svg>
                                                                                            </a>
                                                                                            </div>
                                                         </div>
                                                         </div>
                                                         </div>
                                                         </div>";
                            }

                            // Links de paginação
                            echo '<li class="page-item' . ($current_page == 1 ? ' disabled' : '') . '">';
                            echo '<a class="page-link" href="?page=' . ($current_page - 1) . '" tabindex="-1">Previous</a>';
                            echo '</li>';

                            for ($i = 1; $i <= $total_pages; $i++) {
                                echo '<li class="page-item' . ($current_page == $i ? ' active' : '') . '">';
                                echo '<a class="page-link" href="?page=' . $i . '">' . $i . '</a>';
                                echo '</li>';
                            }

                            echo '<li class="page-item' . ($current_page == $total_pages ? ' disabled' : '') . '">';
                            echo '<a class="page-link" href="?page=' . ($current_page + 1) . '">Next</a>';
                            echo '</li>';
                            ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

        <footer class="text-muted text-center py-5">
            <div class="container">
                <p class="float-end mb-1">
                    <a href="../list/listBooks"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-arrow-up-square-fill" viewBox="0 0 16 16">
                            <path d="M2 16a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2zm6.5-4.5V5.707l2.146 2.147a.5.5 0 0 0 .708-.708l-3-3a.5.5 0 0 0-.708 0l-3 3a.5.5 0 1 0 .708.708L7.5 5.707V11.5a.5.5 0 0 0 1 0z" />
                        </svg></a>
                </p>
                <p class="mb-1">© 2023 Biblioteca Pedbot</p>
            </div>
        </footer>
    </main>
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