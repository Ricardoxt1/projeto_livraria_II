<?php

use \App\Http\Response;
use \App\Controller\Pages\Read;
use \App\Controller\Pages\Create;
//ROTA RENTAL
//LISTAGEM
$obRouter->get('/rental', [
    'middlewares' => [
        'required-admin-login'
    ],
    function ($request) {
        return new Response(200, Read\Rental::getRental($request));
    }
]);

//REGISTRO 
$obRouter->get('/registerRental', [
    'middlewares' => [
        'required-admin-login'
    ],
    function ($request) {
        return new Response(200, Create\registerRental::getRegisterRental($request));
    }
]);

$obRouter->post('/registerRental', [
    function ($request) {
        return new Response(200, Create\registerRental::setRegisterRental($request));
    }
]);

//UPDATE
$obRouter->get('/updateRental/{id}/edit', [
    'middlewares' => [
        'required-admin-login'
    ],
    function ($request,$id) {
        return new Response(200, Read\Rental::getUpdateRental($request,$id));
    }
]);

$obRouter->post('/updateRental/{id}/edit', [
    function ($request,$id) {
        return new Response(200, Read\Rental::setUpdateRental($request,$id));
    }
]);
