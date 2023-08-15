<?php

use \App\Http\Response;
use \App\Controller\Pages\Read;
use \App\Controller\Pages\Create;
use \App\Controller\Pages\Delete;

//ROTA PUBLISHER
//LISTAGEM
$obRouter->get('/publisher', [
    'middlewares' => [
        'required-admin-login'
    ],
    function ($request) {
        return new Response(200, Read\Publisher::getPublisher($request));
    }
]);

//REGISTRO 
$obRouter->get('/registerPublisher', [
    'middlewares' => [
        'required-admin-login'
    ],
    function () {
        return new Response(200, Create\registerPublisher::getRegisterPublisher());
    }
]);

$obRouter->post('/registerPublisher', [
    function ($request) {
        return new Response(200, Create\registerPublisher::setRegisterPublisher($request));
    }
]);

//UPDATE
$obRouter->get('/updatePublisher/{id}/edit', [
    'middlewares' => [
        'required-admin-login'
    ],
    function ($request,$id) {
        return new Response(200, Read\Publisher::getUpdatePublisher($request,$id));
    }
]);

$obRouter->post('/updatePublisher/{id}/edit', [
    function ($request,$id) {
        return new Response(200, Read\Publisher::setUpdatePublisher($request,$id));
    }
]);

//DELETE
$obRouter->get('/deletePublisher/{id}/delete', [
    'middlewares' => [
        'required-admin-login'
    ],
    function ($request, $id) {
        return new Response(200, Delete\Publisher::getDeletePublisher($request,$id));
    }
]);
$obRouter->post('/deletePublisher/{id}/delete', [
    'middlewares' => [
        'required-admin-login'
    ],
    function ($request, $id) {
        return new Response(200, Delete\Publisher::setDeletePublisher($request,$id));
    }
]);
