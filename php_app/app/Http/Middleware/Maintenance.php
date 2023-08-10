<?php

namespace App\Http\Middleware;

class Maintenance
{

    /**
     * método responsável por executar o middleware
     * @param Request $request
     * @param Closure next
     * @return Response
     */
    public function handle($request, $next)
    {

        //verifica o estado de manutenção da pagina
        if (getenv('MAINTENANCE') == 'true') {
            throw new \Exception("Página em manutenção. Tente novamente mais tarde.", 200);
        }

        //executa o próximo nível do middleware
        return $next($request);
    }
}
