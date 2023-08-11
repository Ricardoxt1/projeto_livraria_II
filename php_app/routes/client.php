<?php

use \App\Http\Response;
use \App\Controller\Pages\Client;


//ROTA LOGIN
//LISTAGEM
$obRouter->get('/login', [
    'middlewares' => [
        'required-admin-logout'
    ],
    function ($request) {
        return new Response(200, Client\Login::getLogin($request));
    }
]);

//REGISTRO (POST)
$obRouter->post('/login', [
    'middlewares' => [
        'required-admin-logout'
    ],
    function ($request) {
        return new Response(200, Client\Login::setLogin($request));
    }
]);

//ROTA DE LOGOUT
$obRouter->get('/logout', [
    'middlewares' => [
        'required-admin-login'
    ],
    function ($request) {
        return new Response(200, Client\Login::setLogout($request));
    }
]);

//ROTA REGISTER
//LISTAGEM
$obRouter->get('/register', [
    function ($request) {
        return new Response(200, Client\Register::getRegister($request));
    }
]);

//REGISTRO
$obRouter->post('/register', [
    function ($request) {
        return new Response(200, Client\Register::insertRegister($request));
    }
]);
