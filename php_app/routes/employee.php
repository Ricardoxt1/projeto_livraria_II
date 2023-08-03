<?php

use \App\Http\Response;
use \App\Controller\Pages;
use \App\Controller\Pages\Read;
use \App\Controller\Pages\Create;
//ROTA EMPLOYEE
//LISTAGEM
$obRouter->get('/employee', [
    function () {
        return new Response(200, Read\Employee::getEmployee());
    }
]);

//REGISTRO 
$obRouter->get('/registerEmployee', [
    function () {
        return new Response(200, Create\registerEmployee::getRegisterEmployee());
    }
]);

$obRouter->post('/registerEmployee', [
    function ($request) {
        return new Response(200, Create\registerEmployee::insertEmployee($request));
    }
]);

//UPDATE
$obRouter->get('/updateEmployee', [
    function () {
        return new Response(200, Read\Employee::getUpdateEmployee());
    }
]);

$obRouter->put('/updateEmployee', [
    function ($request) {
        return new Response(200, Read\Employee::getUpdateEmployee());
    }
]);
