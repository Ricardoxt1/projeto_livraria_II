<?php

use \App\Http\Response;
use \App\Controller\Pages;


//ROTA COSTUMER
//LISTAGEM
$obRouter->get('/costumer', [
    function () {
        return new Response(200, Pages\Costumer::getCostumer());
    }
]);

//REGISTRO
$obRouter->get('/registerCostumer', [
    function () {
        return new Response(200, Pages\registerCostumer::getRegisterCostumer());
    }
]);

$obRouter->post('/registerCostumer', [
    function ($request) {

        return new Response(200, Pages\registerCostumer::insertCostumer($request));
    }
]);

//UPDATE
$obRouter->get('/updateCostumer', [
    function () {
        return new Response(200, Pages\Costumer::getUpdateCostumer());
    }
]);

$obRouter->put('/updateCostumer', [
    function ($request) {
        return new Response(200, Pages\Costumer::getUpdateCostumer());
    }
]);
