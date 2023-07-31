<?php

use \App\Http\Response;
use \App\Controller\Pages;

//ROTA RENTAL
//LISTAGEM
$obRouter->get('/rental', [
    function () {
        return new Response(200, Pages\Rental::getRental());
    }
]);

//REGISTRO 
$obRouter->get('/registerRental', [
    function () {
        return new Response(200, Pages\registerRental::getRegisterRental());
    }
]);

$obRouter->post('/registerRental', [
    function ($request) {
        return new Response(200, Pages\registerRental::getRegisterRental());
    }
]);

//UPDATE
$obRouter->get('/updateRental', [
    function () {
        return new Response(200, Pages\Rental::getUpdateRental());
    }
]);

$obRouter->put('/updateRental', [
    function ($request) {
        return new Response(200, Pages\Rental::getUpdateRental());
    }
]);
