<?php

namespace App\Http\Middleware;

use \App\Session\Admin\Login as SessionAdminLogin;

class RequireAdminLogin{

    /**
     * método responsável por executar o middleware
     * @param Request $request
     * @param Closure next
     * @return Response
     */
    public function handle($request, $next){
        //verifica se o usuario esta logado
        if(!SessionAdminLogin::isLogged()){
            $request->getRouter()->redirect('/login');
        }

        //continua a execução
        return $next($request);
    }
}