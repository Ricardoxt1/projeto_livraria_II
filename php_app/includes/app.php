<?php

require __DIR__ . '/../vendor/autoload.php';


use \App\Utils\View;
use \WilliamCosta\DotEnv\Environment;
use \WilliamCosta\DatabaseManager\Database;
use \App\Http\Middleware\Queue as MiddlewareQueue;

// carrega variaveis de ambientes
Environment::load(__DIR__ . '/../');

//define as configurações de banco de dados
Database::config(
    getenv('DB_HOST'),
    getenv('DB_NAME'),
    getenv('DB_USER'),
    getenv('DB_PASS'),
    getenv('DB_PORT'),
);

//define a constante url do projeto
define('URL', getenv('URL'));

//define o valor padrão das variavéis
View::init([
    'URL' => URL
]);

//define o mapeamento de middlewares
MiddlewareQueue::setMap([
    'maintenance' => \App\Http\Middleware\Maintenance::class
]);

//define o mapeamento de middlewares padrões executados em todas as rotas
MiddlewareQueue::setDefault([
    'maintenance' 
]);
