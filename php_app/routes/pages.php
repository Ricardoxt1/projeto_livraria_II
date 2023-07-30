<?php

use \App\Http\Response;
use \App\Controller\Pages;


//ROTA COSTUMER
//LISTAGEM
$obRouter->get('/costumer', [
    function () {
        return new Response(200, Pages\Costumer::getCostumer());
    }
]);

//REGISTRO
$obRouter->get('/registerCostumer', [
    function () {
        return new Response(200, Pages\registerCostumer::getRegisterCostumer());
    }
]);

$obRouter->post('/registerCostumer', [
    function ($request) {
        return new Response(200, Pages\registerCostumer::getRegisterCostumer());
    }
]);

//UPDATE
$obRouter->get('/updateCostumer', [
    function () {
        return new Response(200, Pages\Costumer::getUpdateCostumer());
    }
]);

$obRouter->put('/updateCostumer', [
    function ($request) {
        return new Response(200, Pages\Costumer::getUpdateCostumer());
    }
]);

// ------------------------------------------------------------------------------------------------

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
        return new Response(200, Pages\registerAuthor::getRegisterAuthor());
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


// ------------------------------------------------------------------------------------------------

//ROTA BOOK
//LISTAGEM
$obRouter->get('/book', [
    function () {
        return new Response(200, Pages\Book::getBook());
    }
]);

//REGISTRO 
$obRouter->get('/registerBook', [
    function () {
        return new Response(200, Pages\registerBook::getRegisterBook());
    }
]);

$obRouter->post('/registerBook', [
    function ($request) {
        return new Response(200, Pages\registerBook::getRegisterBook());
    }
]);

//UPDATE
$obRouter->get('/updateBook', [
    function () {
        return new Response(200, Pages\Book::getUpdateBook());
    }
]);

$obRouter->put('/updateBook', [
    function ($request) {
        return new Response(200, Pages\Book::getUpdateBook());
    }
]);

// ------------------------------------------------------------------------------------------------

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

// ------------------------------------------------------------------------------------------------

//ROTA PUBLISHER
//LISTAGEM
$obRouter->get('/publisher', [
    function () {
        return new Response(200, Pages\Publisher::getPublisher());
    }
]);

//REGISTRO 
$obRouter->get('/registerPublisher', [
    function () {
        return new Response(200, Pages\registerPublisher::getRegisterPublisher());
    }
]);

$obRouter->post('/registerPublisher', [
    function ($request) {
        return new Response(200, Pages\registerPublisher::getRegisterPublisher());
    }
]);

//UPDATE
$obRouter->get('/updatePublisher', [
    function () {
        return new Response(200, Pages\Publisher::getUpdatePublisher());
    }
]);

$obRouter->put('/updatePublisher', [
    function ($request) {
        return new Response(200, Pages\Publisher::getUpdatePublisher());
    }
]);

// ------------------------------------------------------------------------------------------------

//ROTA RENTAL
//LISTAGEM
$obRouter->get('/rental', [
    function () {
        return new Response(200, Pages\Rental::getRental());
    }
]);

//REGISTRO 
$obRouter->get('/registerRental', [
    function () {
        return new Response(200, Pages\registerRental::getRegisterRental());
    }
]);

$obRouter->post('/registerRental', [
    function ($request) {
        return new Response(200, Pages\registerRental::getRegisterRental());
    }
]);

//UPDATE
$obRouter->get('/updateRental', [
    function () {
        return new Response(200, Pages\Rental::getUpdateRental());
    }
]);

$obRouter->put('/updateRental', [
    function ($request) {
        return new Response(200, Pages\Rental::getUpdateRental());
    }
]);

// ------------------------------------------------------------------------------------------------

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