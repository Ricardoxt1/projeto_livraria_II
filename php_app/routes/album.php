<?php

use \App\Http\Response;
use \App\Controller\Pages\HomePage;

//ROTA ALBUM
//LISTAGEM
$obRouter->get('/albumJK', [
    function () {
        return new Response(200, HomePage\Album::getJK());
    }
]);

$obRouter->get('/albumJRR', [
    function () {
        return new Response(200, HomePage\Album::getJRR());
    }
]);

$obRouter->get('/albumJMAAS', [
    function () {
        return new Response(200, HomePage\Album::getJMaas());
    }
]);

