<?php

namespace App\Controller\Pages;

use \App\Utils\View;


class Page
{

    /**
     * método responsável por redenrizar o topo da página com a navbar
     * @return string
     */
    private static function getNavBar()
    {
        return View::render('pages/navbar');
    }

    /**
     * método responsável por redenrizar a sidebar da página
     * @return string
     */
    private static function getSideBar()
    {
        return View::render('pages/sidebar');
    }

    /**
     * método responsável por redenrizar o rodapé da página
     * @return string
     */
    private static function getFooter()
    {
        return View::render('pages/footer');
    }

    /** metodo para resgatar os dados da pagina genérica (view)
     * @return string
     *  */
    public static function getPage($titule, $content)
    {

        return View::render('pages/page', [
            //contéudo do tilulo
            'titule' => $titule,
            //contéudo do navbar
            'navbar' => self::getNavBar(),
            //contéudo do sidebar
            'sidebar' => self::getSidebar(),
            //conteúdo body
            'content' => $content,
            //conteúdo footer
            'footer' => self::getFooter(),

        ]);
    }

    
}
