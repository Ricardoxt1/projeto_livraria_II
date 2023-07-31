<?php

use \App\Http\Response;
use \App\Controller\Pages;

//ROTA BOOK
//LISTAGEM
$obRouter->get('/book', [
    function () {
        return new Response(200, Pages\Book::getBook());
    }
]);

//REGISTRO 
$obRouter->get('/registerBook', [
    function () {
        return new Response(200, Pages\registerBook::getRegisterBook());
    }
]);

$obRouter->post('/registerBook', [
    function ($request) {
        return new Response(200, Pages\registerBook::getRegisterBook());
    }
]);

//UPDATE
$obRouter->get('/updateBook', [
    function () {
        return new Response(200, Pages\Book::getUpdateBook());
    }
]);

$obRouter->put('/updateBook', [
    function ($request) {
        return new Response(200, Pages\Book::getUpdateBook());
    }
]);