<?php

namespace App\Controller\Pages\Client;

use \App\Utils\View;


class Client
{

    /**
     * método responsável por redenrizar o rodapé da página
     * @return string
     */
    private static function getFooter()
    {
        return View::render('pages/client/footer');
    }

    /** metodo para resgatar os dados da pagina genérica (view)
     * @return string
     * @param string $titule
     * @param string $content
     *  */
    public static function getClient($titule, $content)
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