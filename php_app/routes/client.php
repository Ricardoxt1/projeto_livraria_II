<?php

use \App\Http\Response;
use \App\Controller\Pages\Client;

//ROTA LOGIN
//LISTAGEM
$obRouter->get('/login', [
    function () {
        return new Response(200, Client\Login::getLogin());
    }
]);

//ROTA REGISTER
//LISTAGEM
$obRouter->get('/register', [
    function () {
        return new Response(200, Client\Register::getRegister());
    }
]);