<?php

use \App\Http\Response;
use \App\Controller\Pages\Read;
use \App\Controller\Pages\Create;
//ROTA AUTHOR
//LISTAGEM
$obRouter->get('/author', [
    function () {
        return new Response(200, Read\Author::getAuthor());
    }
]);

//REGISTRO 
$obRouter->get('/registerAuthor', [
    function () {
        return new Response(200, Create\registerAuthor::getRegisterAuthor());
    }
]);

$obRouter->post('/registerAuthor', [
    function ($request) {
        return new Response(200, Create\registerAuthor::insertAuthor($request));
    }
]);

//UPDATE
$obRouter->get('/updateAuthor', [
    function () {
        return new Response(200, Read\Author::getUpdateAuthor());
    }
]);

$obRouter->put('/updateAuthor', [
    function ($request) {
        return new Response(200, Read\Author::getUpdateAuthor());
    }
]);