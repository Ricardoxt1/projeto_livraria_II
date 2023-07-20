<?php

namespace App\Utils;

class View
{

    /**
     * metodo responsavel por retornar o conteúdo da view 
     * @param string $view 
     * @return string
     */
    private static function getContentView($view)
    {
        $file = __DIR__ . '/../../resources/view/' . $view . '.php';
        return file_exists($file) ? file_get_contents($file) : '';
    }

    /**
     * metodo responsavel por retornar o conteúdo redenrizado de uma view 
     * @param string $view
     * @param array $vars (string ou $number)
     * @return string
     */
    public static function render($view, $vars = [])
    {
        //conteudo da view
        $contentView = self::getContentView($view);

        //indentificando as chaves na view
        $keys = array_keys($vars);
        $keys = array_map(function ($item){
            return '{{'.$item.'}}';
        }, $keys);
        
        //retorna o conteúdo redenrizado
        return str_replace($keys, array_values($vars), $contentView);
    }
}
