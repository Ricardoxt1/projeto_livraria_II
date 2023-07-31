<?php

require __DIR__ . '/../vendor/autoload.php';


use \App\Utils\View;
use \WilliamCosta\DotEnv\Environment;
use \WilliamCosta\DatabaseManager\Database;

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
