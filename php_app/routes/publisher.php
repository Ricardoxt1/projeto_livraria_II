<?php

use \App\Http\Response;
use \App\Controller\Pages\Read;
use \App\Controller\Pages\Create;
//ROTA PUBLISHER
//LISTAGEM
$obRouter->get('/publisher', [
    'middlewares' => [
        'required-admin-login'
    ],
    function () {
        return new Response(200, Read\Publisher::getPublisher());
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

$obRouter->put('/updatePublisher/{id}/edit', [
    function ($request,$id) {
        return new Response(200, Read\Publisher::getUpdatePublisher($request,$id));
    }
]);
