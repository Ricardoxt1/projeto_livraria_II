<?php 
    
    require __DIR__.'/vendor/autoload.php';

    use \App\Http\Router;
    use \App\Utils\View;
    use \WilliamCosta\DotEnv\Environment;

    // carrega variaveis de ambientes
    Environment::load(__DIR__);

    //dfine a constante url do projeto
    define('URL', getenv('URL'));

    //define o valor padrão das variavéis
    View::init([
        'URL' => URL
    ]);

    //inicia o router
    $obRouter = new Router(URL);

    //inclui as rotas de paginas
    include __DIR__.'/routes/pages.php';

    //IMPRIME O RESPONSE DA ROTA
    $obRouter->run()
             ->sendResponse();
             
