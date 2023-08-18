<?php

namespace App\Http\Middleware;

use App\Http\Request;
use App\Http\Response;
use Closure;

class Queue
{

    /**
     * mapeamento de middleware
     * @var array
     */
    private static array $map = [];

    /**
     * mapeamento de middleware que serão carregados em todas as rotas
     * @var array
     */
    private static array $default = [];


    /**
     * fila de middlewares a serem executados
     * @var array 
     */
    private array $middlewares = [];

    /**
     * função de execução do controlador
     * @var Closure
     */
    private Closure $controller;

    /**
     * argumentos da função do controlador
     * @var array 
     */
    private array $controllerArgs = [];

    /**
     * método responsavel por construir a classe de filme middlewares
     * @param Closure $controller
     * @param array $controllerArgs
     * @param array $middlewares
     */
    public function __construct(array $middlewares, Closure $controller, array $controllerArgs)
    {
        $this->middlewares = array_merge(self::$default, $middlewares);
        $this->controller = $controller;
        $this->controllerArgs = $controllerArgs;
    }

    /**
     * método responsável por definir o mapeamento de middlewares
     * @param array $map
     */
    public static function setMap(array $map): void
    {
        self::$map = $map;
    }

    /**
     * método responsável por definir o mapeamento de middlewares padrões
     * @param array $default
     */
    public static function setDefault(array $default): void
    {
        self::$default = $default;
    }

    /**
     * método responsável por executar o próximo nível da fila de middlewares
     * @param Request $request
     * @return Response
     */
    public function next(Request $request): ?Response
    {

        //Valida instancia de controller
        if (!is_callable($this->controller)) {
            throw new \Exception("Tipo esperado 'callable'. Mas veio  '...\Middleware\Closure'");
        }

        //verifica se a fila está vazia
        if (empty($this->middlewares)) return call_user_func_array($this->controller, $this->controllerArgs);

        //middleware
        $middleware = array_shift($this->middlewares);

        //verifica o mapeamento
        if (!isset(self::$map[$middleware])) {
            throw new \Exception("Problemas ao processar o middleware da riquisição", 500);
        }

        //next
        $queue = $this;
        $next = function ($request) use ($queue) {
            return $queue->next($request);
        };

        //executa o middleware
        return (new self::$map[$middleware])->handle($request, $next);
    }
}
