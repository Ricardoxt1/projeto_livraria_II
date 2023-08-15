<?php

use \App\Http\Response;
use \App\Controller\Pages\Read;
use \App\Controller\Pages\Create;
use \App\Controller\Pages\Delete;
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
        return new Response(200, Read\Author::getUpdateAuthor($request, $id));
    }
]);

$obRouter->post('/updateAuthor/{id}/edit', [
    function ($request, $id) {
        return new Response(200, Read\Author::setUpdateAuthor($request, $id));
    }
]);

//DELETE
$obRouter->get('/deleteAuthor/{id}/delete', [
    'middlewares' => [
        'required-admin-login'
    ],
    function ($request, $id) {
        return new Response(200, Delete\Author::getDeleteAuthor($request, $id));
    }
]);
$obRouter->post('/deleteAuthor/{id}/delete', [
    'middlewares' => [
        'required-admin-login'
    ],
    function ($request, $id) {
        return new Response(200, Delete\Author::setDeleteAuthor($request, $id));
    }
]);
