<?php

use \App\Http\Response;
use \App\Controller\Pages;
// use \App\Controller\Pages\Home;

//ROTA HOME
//LISTAGEM
// $obRouter->get('/home', [
//     function () {
//         return new Response(200, Home\Home::getHome());
//     }
// ]);

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

