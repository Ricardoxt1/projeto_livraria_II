<?php

namespace App\Utils;

class View
{
    /**
     * variaveis padrões da view
     * @var array
     */
    private static array $vars;

    /**
     * método responsável por definir os dados iniciais da class
     * @param array $vars
     */
    public static function init(array $vars = []): void
    {
        self::$vars = $vars;
    }

    /**
     * metodo responsavel por retornar o conteúdo da view 
     * @param string $view 
     * @return string
     */
    private static function getContentView(string $view): string
    {
        $file = __DIR__ . '/../../resources/view/' . $view . '.html';
        return file_exists($file) ? file_get_contents($file) : '';
    }

    /**
     * metodo responsavel por retornar o conteúdo renderizado de uma view 
     * @param string $view
     * @param array $vars (string ou $number)
     * @return string
     */
    public static function render(string $view, array $vars = []): string
    {
        //conteudo da view
        $contentView = self::getContentView($view);

        //merge de variavéis da view
        $vars = array_merge(self::$vars, $vars);

        //identificando as chaves na view
        $keys = array_keys($vars);
        $keys = array_map(function ($item) {
            return '{{' . $item . '}}';
        }, $keys);

        //retorna o conteúdo redenrizado
        return str_replace($keys, array_values($vars), $contentView);
    }
}
