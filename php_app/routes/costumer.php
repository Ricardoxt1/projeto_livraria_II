<?php

use \App\Http\Response;
use \App\Controller\Pages\Read;
use \App\Controller\Pages\Create;

//ROTA COSTUMER
//LISTAGEM
$obRouter->get('/costumer', [
    function () {
        return new Response(200, Read\Costumer::getCostumer());
    }
]);

//REGISTRO
$obRouter->get('/registerCostumer', [
    function () {
        return new Response(200, Create\registerCostumer::getRegisterCostumer());
    }
]);

$obRouter->post('/registerCostumer', [
    function ($request) {

        return new Response(200, Create\registerCostumer::insertCostumer($request));
    }
]);

//UPDATE
$obRouter->get('/updateCostumer', [
    function () {
        return new Response(200, Read\Costumer::getUpdateCostumer());
    }
]);

$obRouter->put('/updateCostumer', [
    function ($request) {
        return new Response(200, Read\Costumer::getUpdateCostumer());
    }
]);
