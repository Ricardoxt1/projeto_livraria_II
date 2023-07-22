<?php

namespace App\Http;

class Response
{

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
    public function __construct($httpCode, $content, $contentType = 'text/html')
    {
        $this->httpCode = $httpCode;
        $this->content = $content;
        $this->setContentType($contentType);
    }

    public function setContentType($contentType)
    {
        $this->contentType = $contentType;
        // $this->addHeader('Content-Type', $contentType);
    }

    /**
     * metodo responsavel por adicionar um registro no cabeçalho de response
     * @param string $key
     * @param mixed $value
     */
    // public function addHeader($key, $value)
    // {
    //     $this->headers[$key] = $value;
    // }

    /**
     * metodo responsavel por enviar os headers para o navegador
     * 
     */
    // public function sendHeaders(){
    //     //STATUS
    //     http_response_code($this->httpCode);

    //     //ENVIAR HEADERS
    //     foreach($this->headers as $key => $value){
    //         header($key, $value);
    //     }
    // }

    /**
     * método responsável por enviar a resposta para o usuario
     * 
     */
    public function sendResponse()
    {
        // //ENVIA OS HEADERS
        // $this->sendHeaders();
        
        //IMPRIME O CONTEUDO
        switch ($this->contentType) {
            case 'text/html':
                echo $this->content;
                exit;
        }
    }
}
