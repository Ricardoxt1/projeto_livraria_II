<?php

use \App\Http\Response;
use \App\Controller\Pages;
use \App\Controller\Pages\Read;
use \App\Controller\Pages\Create;
use \App\Controller\Pages\Delete;

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
$obRouter->get('/deleteEmployee/{id}/delete', [
    'middlewares' => [
        'required-admin-login'
    ],
    function ($request, $id) {
        return new Response(200, Delete\Employee::getDeleteEmployee($request,$id));
    }
]);
$obRouter->post('/deleteEmployee/{id}/delete', [
    'middlewares' => [
        'required-admin-login'
    ],
    function ($request, $id) {
        return new Response(200, Delete\Employee::setDeleteEmployee($request,$id));
    }
]);
