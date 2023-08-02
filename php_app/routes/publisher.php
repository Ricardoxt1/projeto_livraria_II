<?php

use \App\Http\Response;
use \App\Controller\Pages;

//ROTA PUBLISHER
//LISTAGEM
$obRouter->get('/publisher', [
    function () {
        return new Response(200, Pages\Publisher::getPublisher());
    }
]);

//REGISTRO 
$obRouter->get('/registerPublisher', [
    function () {
        return new Response(200, Pages\registerPublisher::getRegisterPublisher());
    }
]);

$obRouter->post('/registerPublisher', [
    function ($request) {
        return new Response(200, Pages\registerPublisher::insertPublisher($request));
    }
]);

//UPDATE
$obRouter->get('/updatePublisher', [
    function () {
        return new Response(200, Pages\Publisher::getUpdatePublisher());
    }
]);

$obRouter->put('/updatePublisher', [
    function ($request) {
        return new Response(200, Pages\Publisher::getUpdatePublisher());
    }
]);
