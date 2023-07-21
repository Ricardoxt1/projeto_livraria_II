<?php

namespace App\Http;

class Response{

    /**
     * código do status HTTP
     * @return integer
     */
    private $httpCode = 200;

    /**
     * cabeçalho do response
     * @var array
     */
    // private $headers = [];

    /**
     * tipo de dados a ser retornado
     * @var string
     */
    private $contentType = 'text/html';

    /**
     * conteúdo do response
     * @var mixed
     */
    private $content;

    /**
     * método responsavel por iniciar a classe e definir os valores 
     * @param string $content
     * @param string $contentType
     * @param array $httpCode
    */ 
    public function __construct($httpCode, $content, $contentType = 'text/php'){
        $this->httpCode = $httpCode;
        $this->content = $content;
        $this->setContentType($contentType);
    }

    public function setContentType($contentType){
        $this->contentType = $contentType;
    }

    /**
     * método responsável por enviar a resposta para o usuario
     * @return string
     */
    public function sendResponse(){
        switch ($this->contentType) {
            case 'text/php':
                echo $this->content;
                exit;
        }
    }


}