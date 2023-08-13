<?php

use \App\Http\Response;
use \App\Controller\Pages\Read;
use \App\Controller\Pages\Create;
//ROTA AUTHOR
//LISTAGEM
$obRouter->get('/author', [
    'middlewares' => [
        'required-admin-login'
    ],
    function ($request) {
        return new Response(200, Read\Author::getAuthor($request));
    }
]);

//REGISTRO 
$obRouter->get('/registerAuthor', [
    'middlewares' => [
        'required-admin-login'
    ],
    function ($request) {
        return new Response(200, Create\registerAuthor::getRegisterAuthor($request));
    }
]);

$obRouter->post('/registerAuthor', [
    'middlewares' => [
        'required-admin-login'
    ],
    function ($request) {
        return new Response(200, Create\registerAuthor::setRegisterAuthor($request));
    }
]);

//UPDATE
$obRouter->get('/updateAuthor/{id}/edit', [
    'middlewares' => [
        'required-admin-login'
    ],
    function ($request, $id) {
        return new Response(200, Read\Author::getUpdateAuthor($request,$id));
    }
]);

$obRouter->put('/updateAuthor', [
    function ($request,$id) {
        return new Response(200, Read\Author::getUpdateAuthor($request,$id));
    }
]);