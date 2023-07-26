<?php

namespace App\Controller\Pages;

use \App\Utils\View;


class Menu
{

    /** metodo para resgatar os dados da pagina genérica (view)
     * @return string
     *  */
    public static function getMenu()
    {

        return View::render('pages/menu');
    }

    
}