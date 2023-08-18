<?php

namespace App\Http\Middleware;

use App\Http\Request;
use App\Http\Response;
use Closure;

class Maintenance
{
    /**
     * método responsável por executar o middleware
     * @param Request $request
     * @param Closure $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): ?Response
    {

        //verifica o estado de manutenção da pagina
        if (getenv('MAINTENANCE') == 'true') {
            throw new \Exception('<div class="container alight-content-center">
                                        <img src="/resources/img/notification/maintanence1.jpg" alt="em manutenção" height=100%>
                                  </div>", 200');
        }

        //executa o próximo nível do middleware
        return $next($request);
    }
}
