<?php

use \App\Http\Response;
use \App\Controller\Pages\Read;
use \App\Controller\Pages\Create;
//ROTA BOOK
//LISTAGEM
$obRouter->get('/book', [
    function () {
        return new Response(200, Read\Book::getBook());
    }
]);

//REGISTRO 
$obRouter->get('/registerBook', [
    function () {
        return new Response(200, Create\registerBook::getRegisterBook());
    }
]);

$obRouter->post('/registerBook', [
    function ($request) {
        return new Response(200, Create\registerBook::insertBook($request));
    }
]);

//UPDATE
$obRouter->get('/updateBook', [
    function () {
        return new Response(200, Read\Book::getUpdateBook());
    }
]);

$obRouter->put('/updateBook', [
    function ($request) {
        return new Response(200, Read\Book::getUpdateBook());
    }
]);