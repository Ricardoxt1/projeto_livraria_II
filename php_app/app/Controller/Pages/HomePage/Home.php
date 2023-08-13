<?php

namespace App\Controller\Pages\HomePage;

use \App\Utils\View;

class Home extends PageH
{

    /** metodo para resgatar os dados da pagina de tela inicial (view)
     * @param Request $request
     * @return string
     *  */
    public static function getHome($request)
    {
        //contéudo da home
        $content = View::render('pages/homePage/home', [
            //view home page
        ]);
       

        //retorna a view da pagina
        return parent::getPageH('Tela Inicial', $content);
    }
}

