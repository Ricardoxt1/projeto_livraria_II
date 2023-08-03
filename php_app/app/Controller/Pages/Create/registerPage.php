<?php

namespace App\Controller\Pages\Create;

use \App\Utils\View;


class registerPage
{

    /**
     * método responsável por redenrizar o topo da página com a navbar
     * @return string
     */
    private static function getNavBar()
    {
        return View::render('pages/register/navbar');
    }

    /**
     * método responsável por redenrizar a sidebar da página
     * @return string
     */
    private static function getSideBar()
    {
        return View::render('pages/register/sidebar');
    }

    /**
     * método responsável por redenrizar o rodapé da página
     * @return string
     */
    private static function getFooter()
    {
        return View::render('pages/register/footer');
    }

    /** metodo para resgatar os dados da pagina genérica (view)
     * @return string
     *  */
    public static function getPage($titule, $content)
    {

        return View::render('pages/register/page', [
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
