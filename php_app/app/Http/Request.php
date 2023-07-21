<?php

namespace App\Http;

class Request
{

    /**
     * metodo HTTP da requisição
     * @var string 
     */
    private $httpMethod;

    /**
     * uri da pagina
     */
    private $uri;

    /** 
     * parametros da url
     * @var array
     */
    private $queryParams = [];

    /**
     * variaveis recebidas do post da pagina
     * @var array
     */
    private $postVars = [];

    /**
     * cabeçalho da requisição
     */
    // private $headers = [];

    public function __construct()
    {
        $this->queryParams =  $_GET ?? [];
        $this->postVars = $_POST ?? [];
        // $this->headers = getallheaders();
        $this->httpMethod = $_SERVER['REQUEST_METHOD'] ?? '';
        $this->uri = $_SERVER['REQUEST_URI'] ?? '';
    }

    /**
     * metodo responsavel por retornar headers da requisição
     * @return string
     */
    // public function getHeaders(){
    //     return $this->headers;
    // }

    /**
     * metodo responsavel por retornar os parametos com seus resultados da requisição
     * @return array
     */    
    public function getQueryParams(){
        return $this->queryParams;
    }

    /**
     * metodo responsavel por retornar post das variaveis  da requisição
     * @return array
     */
    public function getPostVars(){
        return $this->postVars;
    }

    /**
     * metodo responsavel por retornar metodo do HTTP da requisição
     * @return string
     */
    public function getHttpMethod(){
        return $this->httpMethod;
    }

    /**
     * metodo responsavel por retornar url da requisição
     * @return string
     */
    public function getUri(){
        return $this->uri;
    }
}
