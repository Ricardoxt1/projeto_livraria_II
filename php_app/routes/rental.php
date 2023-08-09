<?php

use \App\Http\Response;
use \App\Controller\Pages\Read;
use \App\Controller\Pages\Create;
//ROTA RENTAL
//LISTAGEM
$obRouter->get('/rental', [
    function ($request) {
        return new Response(200, Read\Rental::getRental($request));
    }
]);

//REGISTRO 
$obRouter->get('/registerRental', [
    function ($request) {
        return new Response(200, Create\registerRental::getRegisterRental($request));
    }
]);

$obRouter->post('/registerRental', [
    function ($request) {
        return new Response(200, Create\registerRental::insertRental($request));
    }
]);

//UPDATE
$obRouter->get('/updateRental', [
    function () {
        return new Response(200, Read\Rental::getUpdateRental());
    }
]);

$obRouter->put('/updateRental', [
    function ($request) {
        return new Response(200, Read\Rental::getUpdateRental());
    }
]);
