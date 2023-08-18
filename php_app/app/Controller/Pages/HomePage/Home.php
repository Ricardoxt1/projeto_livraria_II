<?php

namespace App\Controller\Pages\HomePage;

use \App\Utils\View;

class Home extends PageH
{

    /** metodo para resgatar os dados da pagina de tela inicial (view)
     * @return string parent::getPageH
     *  */
    public static function getHome() : string
    {
        //contéudo da home
        $content = View::render('pages/homePage/home', [
            //view home page
        ]);
       

        //retorna a view da pagina
        return parent::getPageH('Tela Inicial', $content);
    }
}

