<?php

use \App\Http\Response;
use \App\Controller\Pages\Read;
use \App\Controller\Pages\Create;
//ROTA PUBLISHER
//LISTAGEM
$obRouter->get('/publisher', [
    function () {
        return new Response(200, Read\Publisher::getPublisher());
    }
]);

//REGISTRO 
$obRouter->get('/registerPublisher', [
    function () {
        return new Response(200, Create\registerPublisher::getRegisterPublisher());
    }
]);

$obRouter->post('/registerPublisher', [
    function ($request) {
        return new Response(200, Create\registerPublisher::insertPublisher($request));
    }
]);

//UPDATE
$obRouter->get('/updatePublisher', [
    function () {
        return new Response(200, Read\Publisher::getUpdatePublisher());
    }
]);

$obRouter->put('/updatePublisher', [
    function ($request) {
        return new Response(200, Read\Publisher::getUpdatePublisher());
    }
]);
