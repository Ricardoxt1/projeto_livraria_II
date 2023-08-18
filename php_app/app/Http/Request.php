<?php

namespace App\Http;
use \App\Http\Router;

class Request
{

    /**
     * instancia router
     * @var string
     */
    private $router;
    /**
     * metodo HTTP da requisição
     * @var string 
     */
    private string $httpMethod;

    /**
     * uri da pagina
     */
    private $uri;

    /** 
     * parametros da url (GET_METHOD)
     * @var array
     */
    private array $queryParams = [];

    /**
     * variaveis recebidas do post da pagina (POST_METHOD)
     * @var array
     */
    private array $postVars = [];

    /**
     * cabeçalho da requisição
     * @var array
     */
    private array $headers = [];

    /**
     * metodo constructor
     * @param Router $route
     */
    public function __construct(Router $router)
    {
        $this->router = $router;
        $this->queryParams =  $_GET ?? [];
        $this->postVars = $_POST ?? [];
        $this->headers = getallheaders();
        $this->httpMethod = $_SERVER['REQUEST_METHOD'] ?? '';
        $this->setURI();
    }

    /**
     * método para definir a URI
     */
    private function setUri(): void
    {
        //URI COMPLETA (COM GETS)
        $this->uri = $_SERVER['REQUEST_URI'] ?? '';

        //REMOVE GETS DA URI
        $xURI = explode('?', $this->uri);
        $this->uri = $xURI[0];
    }

    /**
     * retorna uma instancia de router
     * @return Router
     */
    public function getRouter()
    {
        return $this->router;
    }

    /**
     * metodo responsavel por retornar headers da requisição
     * @return array headers
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * metodo responsavel por retornar os parametos com seus resultados da requisição
     * @return array query parameters
     */
    public function getQueryParams(): array
    {
        return $this->queryParams;
    }

    /**
     * metodo responsavel por retornar post das variaveis  da requisição
     * @return array postVars
     */
    public function getPostVars(): array
    {
        return $this->postVars;
    }

    /**
     * metodo responsavel por retornar metodo do HTTP da requisição
     * @return string httpMethod
     */
    public function getHttpMethod(): string
    {
        return $this->httpMethod;
    }

    /**
     * metodo responsavel por retornar url da requisição
     * @return string uri
     */
    public function getUri(): string
    {
        return $this->uri;
    }
}
