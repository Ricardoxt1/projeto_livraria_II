<?php

use \App\Http\Response;
use \App\Controller\Pages\Read;
use \App\Controller\Pages\Create;
//ROTA BOOK
//LISTAGEM
$obRouter->get('/book', [
    'middlewares' => [
        'required-admin-login'
    ],
    function ($request) {
        return new Response(200, Read\Book::getBook($request));
    }
]);

//REGISTRO 
$obRouter->get('/registerBook', [
    'middlewares' => [
        'required-admin-login'
    ],
    function ($request) {
        return new Response(200, Create\registerBook::getRegisterBook($request));
    }
]);

$obRouter->post('/registerBook', [
    function ($request) {
        return new Response(200, Create\registerBook::setRegiterBook($request));
    }
]);

//UPDATE
$obRouter->get('/updateBook/{id}/edit', [
    'middlewares' => [
        'required-admin-login'
    ],
    function ($request,$id) {
        return new Response(200, Read\Book::getUpdateBook($request,$id));
    }
]);

$obRouter->put('/updateBook', [
    function ($request,$id) {
        return new Response(200, Read\Book::getUpdateBook($request,$id));
    }
]);