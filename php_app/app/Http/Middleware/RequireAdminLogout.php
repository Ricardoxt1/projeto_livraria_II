<?php

namespace App\Http\Middleware;

use App\Http\Request;
use App\Http\Response;
use \App\Session\Admin\Login as SessionAdminLogin;
use Closure;

class RequireAdminLogout
{

    /**
     * método responsável por executar o middleware
     * @param Request $request
     * @param Closure $next
     * @return Response $next($request)
     */
    public function handle(Request $request, Closure $next): ?Response
    {
        //verifica se o usuario esta logado
        if (SessionAdminLogin::isLogged()) {
            $request->getRouter()->redirect('/menu');
        }

        //continua a execução
        return $next($request);
    }
}
