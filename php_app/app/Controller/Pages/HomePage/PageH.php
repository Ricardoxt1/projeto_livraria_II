<?php

namespace App\Controller\Pages\HomePage;

use \App\Utils\View;


class PageH
{

    /**
     * método responsável por redenrizar o topo da página com a navbar
     * @return string
     */
    private static function getNavBar()
    {
        return View::render('pages/homePage/navbar');
    }

    /**
     * método responsável por redenrizar o rodapé da página
     * @return string
     */
    private static function getFooter()
    {
        return View::render('pages/list/footer');
    }

    /** metodo para resgatar os dados da pagina genérica (view)
     * @return string
     *  */
    public static function getPageH($titule, $content)
    {

        return View::render('pages/homePage/page', [
            //contéudo do tilulo
            'titule' => $titule,
            //contéudo do navbar
            'navbar' => self::getNavBar(),
            //conteúdo body
            'content' => $content,
            //conteúdo footer
            'footer' => self::getFooter(),

        ]);
    }

}
