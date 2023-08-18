<?php

namespace App\Controller\Pages;

use \App\Utils\View;


class Menu
{

    /** metodo para resgatar os dados da pagina genérica (view)
     * @return string View::render
     *  */
    public static function getMenu(): string
    {

        return View::render('pages/menu');
    }

    
}