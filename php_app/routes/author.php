<?php

use \App\Http\Response;
use \App\Controller\Pages;

//ROTA AUTHOR
//LISTAGEM
$obRouter->get('/author', [
    function () {
        return new Response(200, Pages\Author::getAuthor());
    }
]);

//REGISTRO 
$obRouter->get('/registerAuthor', [
    function () {
        return new Response(200, Pages\registerAuthor::getRegisterAuthor());
    }
]);

$obRouter->post('/registerAuthor', [
    function ($request) {
        return new Response(200, Pages\registerAuthor::insertAuthor($request));
    }
]);

//UPDATE
$obRouter->get('/updateAuthor', [
    function () {
        return new Response(200, Pages\Author::getUpdateAuthor());
    }
]);

$obRouter->put('/updateAuthor', [
    function ($request) {
        return new Response(200, Pages\Author::getUpdateAuthor());
    }
]);