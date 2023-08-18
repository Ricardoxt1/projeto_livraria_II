<?php

namespace App\Controller\Pages\Client;

use \App\Utils\View;


class Client
{

    /**
     * método responsável por redenrizar o rodapé da página
     * @return string View::render
     */
    private static function getFooter() :string
    {
        return View::render('pages/client/footer');
    }

    /** metodo para resgatar os dados da pagina genérica (view)
     * @return string View::render
     * @param string $titule
     * @param string $content
     *  */
    public static function getClient(string $titule, string $content) : string
    {

        return View::render('pages/client/page', [
            //contéudo do título
            'titule' => $titule,
            //contéudo do rodapé da pagina
            'footer' => self::getFooter(),
            //contéudo do pagina
            'content' => $content,
        ]);
    }

    
}