<?php

use \App\Http\Response;
use \App\Controller\Pages\Read;
use \App\Controller\Pages\Create;
//ROTA BOOK
//LISTAGEM
$obRouter->get('/book', [
    function ($request) {
        return new Response(200, Read\Book::getBook($request));
    }
]);

//REGISTRO 
$obRouter->get('/registerBook', [
    function ($request) {
        return new Response(200, Create\registerBook::getRegisterBook($request));
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