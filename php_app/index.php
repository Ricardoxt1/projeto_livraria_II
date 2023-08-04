<?php 
    
    require __DIR__. '/includes/app.php';
    
    use \App\Http\Router;

    //inicia o router
    $obRouter = new Router(URL);

    //inclui as rotas de paginas
    include __DIR__.'/routes/pages.php';
    include __DIR__.'/routes/author.php';
    include __DIR__.'/routes/book.php';
    include __DIR__.'/routes/costumer.php';
    include __DIR__.'/routes/employee.php';
    include __DIR__.'/routes/publisher.php';
    include __DIR__.'/routes/rental.php';
    include __DIR__.'/routes/client.php';


    //IMPRIME O RESPONSE DA ROTA
    $obRouter->run()
             ->sendResponse();
             
