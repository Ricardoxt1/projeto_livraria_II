<?php

namespace App\Http;

class Response
{

    /**
     * código do status HTTP
     * @var integer
     */
    private int $httpCode = 200;

    /**
     * cabeçalho do response
     * @var array
     */
    private array $headers = [];

    /**
     * tipo de dados a ser retornado
     * @var string
     */
    private string $contentType = 'text/html';

    /**
     * conteúdo do response
     * @var string
     */
    private string $content;

    /**
     * método responsavel por iniciar a classe e definir os valores 
     * @param string $content
     * @param string $contentType
     * @param int $httpCode
     */
    public function __construct(int $httpCode, string $content, string $contentType = 'text/html')
    {
        $this->httpCode = $httpCode;
        $this->content = $content;
        $this->setContentType($contentType);
    }

    /**
     * metodo responsavel por enviar o tipo do conteudo
     * @param string $contentType
     */
    public function setContentType($contentType): void
    {
        $this->contentType = $contentType;
        $this->addHeader('Content-Type', $contentType);
    }

    /**
     * metodo responsavel por adicionar um registro no cabeçalho de response
     * @param string $key
     * @param string $value
     */
    public function addHeader(string $key, string $value): void
    {
        $this->headers[$key] = $value;
    }

    /**
     * metodo responsavel por enviar os headers para o navegador
     */
    public function sendHeaders(): void
    {
        //STATUS
        http_response_code($this->httpCode);

        // ENVIAR HEADERS
        foreach ($this->headers as $key => $value) {
            header($key, $value);
        }
    }

    /**
     * método responsável por enviar a resposta para o usuario
     */
    public function sendResponse(): void
    {
        // //ENVIA OS HEADERS
        $this->sendHeaders();

        //IMPRIME O CONTEUDO
        switch ($this->contentType) {
            case 'text/html':
                echo $this->content;
                exit;
        }
    }
}
