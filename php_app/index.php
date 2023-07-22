<?php 
    
    require __DIR__.'/vendor/autoload.php';

    use \App\Http\Router;
    use \App\Http\Response;
    use \App\Controller\Pages\Costumer;


    define('URL', 'http://localhost/php_app');

    $obRouter = new Router(URL);

    //ROTA COSTUMER
    $obRouter->get('/', [
        function(){
            return new Response(200, Costumer::getCostumer());
        }
    ]);

    //IMPRIME O RESPONSE DA ROTA
    $obRouter->run()
             ->sendResponse();
             
