<?php

namespace App\Http\Middleware;


class Queue
{

    /**
     * mapeamento de middleware
     * @var array
     */
    private static $map = [];

    /**
     * mapeamento de middleware que serão carregados em todas as rotas
     * @var array
     */
    private static $default = [];


    /**
     * fila de middlewares a serem executados
     * @var array 
     */
    private $middlewares = [];

    /**
     * função de execução do controlador
     * @var Closure
     */
    private $controller;

    /**
     * argumentos da função do controlador
     * @var array 
     */
    private $controllerArgs = [];

    /**
     * método responsavel por construir a classe de filme middlewares
     * @param Closure $controller
     * @param array $controllerArgs
     * @param array $middlewares
     */
    public function __construct($middlewares, $controller, $controllerArgs)
    {
        $this->middlewares = array_merge(self::$default, $middlewares);
        $this->controller = $controller;
        $this->controllerArgs = $controllerArgs;
    }

    /**
     * método responsável por definir o mapeamento de middlewares
     * @param array $map
     */
    public static function setMap($map)
    {
        self::$map = $map;
    }

    /**
     * método responsável por definir o mapeamento de middlewares padrões
     * @param array $map
     */
    public static function setDefault($default)
    {
        self::$default = $default;
    }

    /**
     * método responsável por executar o próximo nível da fila de middlewares
     * @param Request $request
     * @return Response
     */
    public function next($request)
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
