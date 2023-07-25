<?php

namespace App\Controller\Pages;

use \App\Utils\View;


class Book extends Page
{

    /** metodo para resgatar os dados da pagina de livros (view)
     * @return string
     *  */
    public static function getBook()
    {

        $content = View::render('pages/listBooks', [
            //view books
            'main' => '
            <main class="col-md-9 ms-sm col-lg-10 px-md-5">
                <div class="album py-5 bg-light">
                    <div class="container">
                        <div class="row g-1">
                            <nav aria-label="Page navigation example ">
                                <ul class="pagination justify-content-center">
                                    <div class="col">
                                    <div class="card shadow-sm">
                                    <svg class="bd-placeholder-img card-img-top" width="100%" height="300" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">
                                    <title>Placeholder</title>
                                    <rect width="100%" height="100%" fill="#55595c"></rect><text x="40%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text>
                                    </svg>
                                                        
                                    <div class="card-body p-4">
                                                        
                                        <p class="card-text">Titulo: " . {{titule}} . "</p>
                                        <p class="card-text">Páginas: " . {{page}} . "</p>
                                        <p class="card-text">Lançamento: " . {{realese_date}} . "</p>
                                        <p class="card-text">Autor(a): " . {{authors_name}} . "</p>
                                        <p class="card-text">Editora: " . {{publishers_name}} . "</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="btn-group m-1">
                                                <a class="m-2" href="../edit/editBook.php?id=$id"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                                    </svg>
                                                </a>
                                                <a class="m-2" href="../../../controllerDB/delete/deleteBook.php?id=$id"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z" />
                                                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z" /></svg>
                                                </a>
                                            </div>
                                        </div>
                                    </div>  
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </main>',
        ]);

        //retorna a view da pagina
        return parent::getPage('Listagem de Livros', $content);
    }
}
