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
    private $headers = [];

    public function __construct()
    {
        $this->queryParams =  $_GET ?? [];
        $this->postVars = $_POST ?? [];
        $this->headers = getallheaders();
        $this->httpMethod = $_SERVER['REQUEST_METHOD'] ?? '';
        $this->uri = $_SERVER['REQUEST_URI'] ?? '';
    }
}
