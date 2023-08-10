<?php

namespace App\Http;

use \Closure;
use \Exception;
use \ReflectionFunction;
use \App\Http\Middleware\Queue as MiddlewareQueue;

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
        $this->request = new Request($this);
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

        // middleware das rotas
        $params['middlewares'] = $params['middlewares'] ?? [];

       

        //variáveis da rota
        $params['variables'] = [];

        //padrão de validação das variavéis das rotas
        $patternVariable = '/{(.*?)}/';

        // Executa a expressão regular e armazena os resultados em $matches
        $matches = [];


        if (preg_match_all($patternVariable, $route, $matches)) {
            $route = preg_replace($patternVariable, '(.*?)', $route);
            $params['variables'] = $matches[1];
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
     * método responsável por definir uma rota de POST
     * @param string $route
     * @param array $params
     */
    public function post($route, $params = [])
    {
        return $this->addRoute('POST', $route, $params);
    }

    /**
     * método responsável por definir uma rota de PUT
     * @param string $route
     * @param array $params
     */
    public function put($route, $params = [])
    {
        return $this->addRoute('PUT', $route, $params);
    }

    /**
     * método responsável por definir uma rota de DELETE
     * @param string $route
     * @param array $params
     */
    public function delete($route, $params = [])
    {
        return $this->addRoute('DELETE', $route, $params);
    }

    /** 
     * método responsável por retornar a URI desconsiderando o prefixo
     * @return string
     */
    private function getUri()
    {
        //URI DA REQUEST
        $uri = $this->request->getUri();

        //FATIA A URI COM O PREFIXO
        $xURi = strlen($this->prefix) ? explode($this->prefix, $uri) : [$uri];


        //remove último prefixo
        return end($xURi);

        exit;
    }

    /**
     * método responsável por retornar os dados da rota atual
     * @return array
     */
    private function getRoute()
    {

        //uri
        $uri = $this->getUri();


        //method
        $httpMethod = $this->request->getHttpMethod();

        //valida as rotas
        foreach ($this->routes as $patternRoute => $methods) {
            //verifica se a uri bate o padrão
            if (preg_match($patternRoute, $uri, $matches)) {

                print_r($methods, true);

                print_r($httpMethod, true);

                //verifica o método
                if (isset($methods[$httpMethod])) {
                    //remove a primeira posição
                    unset($matches[0]);

                    //variadas processadas
                    $keys = $methods[$httpMethod]['variables'];
                    $methods[$httpMethod]['variables'] = array_combine($keys, $matches);

                    $methods[$httpMethod]['variables']['request'] = $this->request;
                    //retorno dos parámetros da rota

                    return $methods[$httpMethod];
                }

                // método não permitido/definido
                throw new Exception("Método não permitido", 405);
            }
        }


        //url não encontrada
        throw new Exception("Url não encontrada", 404);
    }

    public function run()
    {

        try {

            $route = $this->getRoute();

            //VERIFICA O CONTROLADOR
            if (empty($route['controller'])) {
                throw new Exception("A Url não pode ser processada", 500);
            }

            //ARGUMENTOS DA FUNÇÃO
            $agrs = [];

            //reflection
            $reflection = new ReflectionFunction($route['controller']);
            foreach ($reflection->getParameters() as $parameter) {
                $name = $parameter->getName();
                $agrs[$name] = $route['variables'][$name] ?? '';
            }

            //RETORNA A EXECUÇÃO DA FILA DE MIDDLEWARES
            return (new MiddlewareQueue($route['middlewares'],$route['controller'], $agrs))->next($this->request);
            
        } catch (Exception $e) {
            return new Response($e->getCode(), $e->getMessage());
        }
    }

    /** 
     * método responsavel por retornar a url atual
     * @return string
     */
    public function getCurrentUrl()
    {
        return $this->url . $this->getUri();
    }
}
