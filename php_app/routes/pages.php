<?php

use \App\Http\Response;
use \App\Controller\Pages;

//ROTA COSTUMER
$obRouter->get('/costumer', [
    function () {
        return new Response(200, Pages\Costumer::getCostumer());
    }
]);

//ROTA AUTHOR
$obRouter->get('/author', [
    function () {
        return new Response(200, Pages\Author::getAuthor());
    }
]);

//ROTA BOOK
$obRouter->get('/book', [
    function () {
        return new Response(200, Pages\Book::getBook());
    }
]);

//ROTA EMPLOYEE
$obRouter->get('/employee', [
    function () {
        return new Response(200, Pages\Employee::getEmployee());
    }
]);

//ROTA PUBLISHER
$obRouter->get('/publisher', [
    function () {
        return new Response(200, Pages\Publisher::getPublisher());
    }
]);

//ROTA PUBLISHER
$obRouter->get('/rental', [
    function () {
        return new Response(200, Pages\Rental::getRental());
    }
]);

//ROTA DINÂMICA 
$obRouter->get('/pagina/{idPagina}/{acao}', [
    function($idPagina, $acao){
        return new Response(200, 'Pagina' . $idPagina . ' - ' . $acao);
    }
]); 
