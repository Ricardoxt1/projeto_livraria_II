<?php

use \App\Http\Response;
use \App\Controller\Pages;

//ROTA EMPLOYEE
//LISTAGEM
$obRouter->get('/employee', [
    function () {
        return new Response(200, Pages\Employee::getEmployee());
    }
]);

//REGISTRO 
$obRouter->get('/registerEmployee', [
    function () {
        return new Response(200, Pages\registerEmployee::getRegisterEmployee());
    }
]);

$obRouter->post('/registerEmployee', [
    function ($request) {
        return new Response(200, Pages\registerEmployee::getRegisterEmployee());
    }
]);

//UPDATE
$obRouter->get('/updateEmployee', [
    function () {
        return new Response(200, Pages\Employee::getUpdateEmployee());
    }
]);

$obRouter->put('/updateEmployee', [
    function ($request) {
        return new Response(200, Pages\Employee::getUpdateEmployee());
    }
]);
