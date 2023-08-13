<?php

use \App\Http\Response;
use \App\Controller\Pages;
use \App\Controller\Pages\Read;
use \App\Controller\Pages\Create;
//ROTA EMPLOYEE
//LISTAGEM
$obRouter->get('/employee', [
    'middlewares' => [
        'required-admin-login'
    ],
    function ($request) {
        return new Response(200, Read\Employee::getEmployee($request));
    }
]);

//REGISTRO 
$obRouter->get('/registerEmployee', [
    'middlewares' => [
        'required-admin-login'
    ],
    function () {
        return new Response(200, Create\registerEmployee::getRegisterEmployee());
    }
]);

$obRouter->post('/registerEmployee', [
    function ($request) {
        return new Response(200, Create\registerEmployee::setRegisterEmployee($request));
    }
]);

//UPDATE
$obRouter->get('/updateEmployee/{id}/edit', [
    'middlewares' => [
        'required-admin-login'
    ],
    function ($request, $id) {
        return new Response(200, Read\Employee::getUpdateEmployee($request, $id));
    }
]);

$obRouter->post('/updateEmployee/{id}/edit', [
    function ($request, $id) {
        return new Response(200, Read\Employee::setUpdateEmployee($request, $id));
    }
]);

//DELETE
$obRouter->get('/employee/{id}/delete', [
    'middlewares' => [
        'required-admin-login', 'mainteance'
    ],
    function ($request, $id) {
        return new Response(200, Read\Employee::getDeleteEmployee($request,$id));
    }
]);
$obRouter->post('/employee/{id}/delete', [
    'middlewares' => [
        'required-admin-login'
    ],
    function ($request, $id) {
        return new Response(200, Read\Employee::setDeleteEmployee($request,$id));
    }
]);
