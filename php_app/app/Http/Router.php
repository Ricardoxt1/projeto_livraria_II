<?php

namespace App\Http;

use \Closure;
use \Exception;

class Router
{
    /**
     * url completa do projeto (raiz)
     * @var string
     */
    private $url = '';

    /**
     * prefixo de todas as rotas
     * @var string
     */
    private $prefix = '';

    /**
     * indice de todas as rotas
     * @var array
     */
    private $routes = [];

    /**
     * instancia de request
     * @var Request
     */
    private $request;

    /** 
     * ( construção de do cosntructor) método responsavel por iniciar a classe 
     * @param string $url
     */
    public function __construct($url)
    {
        $this->request = new Request();
        $this->url = $url;
        $this->setPrefix();
    }

    public function setPrefix()
    {
        //INFORMAÇÕES DA URL ATUAL
        $parseUrl = parse_url($this->url);

        //DEFINE O PREFIXO
        $this->prefix = $parseUrl['path'] ?? '';
    }

    /**
     * método responsável por adicionar uma rota na classe
     * @param string $method
     * @param array $params
     * @param string $route
     */
    private function addRoute($method, $route, $params = [])
    {

        //VALIDAÇÃO DOS PARAMETROS
        foreach ($params as $key => $value) {
            if ($value instanceof Closure) {
                $params['controller'] = $value;
                unset($params[$key]);
                continue;
            }
        }

        //PADRÃO DE VALIDAÇÃO DE URL
        $patternRoute = '/^' . str_replace('/', '\/', $route) . '$/';

        //ADICIONA A ROTA PARA DENTRO DA CLASSE
        $this->routes[$patternRoute][$method] = $params;
    }

    /**
     * método responsável por definir uma rota de GET
     * @param string $route
     * @param array $params
     */
    public function get($route, $params = [])
    {
        return $this->addRoute('GET', $route, $params);
    }

    /**
     * método responsável por executar a rota atual
     * @return Response
     */
    public function run()
    {
        try {
            throw new Exception("Pagina não encontrada", 404);
        } catch (Exception $e) {
            return new Response($e->getCode(), $e->getMessage());
        }
    }
}
