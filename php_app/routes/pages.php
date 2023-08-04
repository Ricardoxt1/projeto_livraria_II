<?php

use \App\Http\Response;
use \App\Controller\Pages;
use \App\Controller\Pages\HomePage;

//ROTA HOME
//LISTAGEM
$obRouter->get('/home', [
    function () {
        return new Response(200, HomePage\Home::getHome());
    }
]);

//ROTA MENU
$obRouter->get('/menu', [
    function () {
        return new Response(200, Pages\Menu::getMenu());
    }
]);

// ------------------------------------------------------------------------------------------------

//ROTA DINÂMICA 
$obRouter->get('/pagina/{idPagina}/{acao}', [
    function ($idPagina, $acao) {
        return new Response(200, 'Página/' . $idPagina . '/' . $acao);
    }

]);

