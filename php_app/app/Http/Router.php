<?php

namespace App\Http;

use \Closure;
use \Exception;
use \ReflectionFunction;

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

        //variáveis da rota
        $params['variables'] = [];

        //padrão de validação das variavéis das rotas
        $patternVariable = '/{(.*?)}/';

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


    /**
     * método responsável por executar a rota atual
     * @return Response
     */
    public function run()
    {
        try {

            $route = $this->getRoute();

            //VERIFICA O CONTROLADOR
            if (!isset($route['controller'])) {
                throw new Exception("A Url não pode ser processado", 500);
            }

            //ARGUMENTOS DA FUNÇÃO
            $args = [];

            //reflection
            $reflection = new ReflectionFunction($route['controller']);
            foreach ($reflection->getParameters() as $parameter) {
                $name = $parameter->getName();
                $agrs[$name] = $route['variables'][$name] ?? '';
            }
            
          


            //RETORNA A EXECUÇÃO DA FUNÇÃO
            return call_user_func_array($route['controller'], $args);
        } catch (Exception $e) {
            return new Response($e->getCode(), $e->getMessage());
        }
    }
}
