<?php

namespace App\Controller\Pages\Client;

use \App\Utils\View;


class Login extends Client
{

    /** metodo para resgatar os dados da pagina de login (view)
     * @return string
     *  */
    public static function getLogin()
    {

        $content = View::render('pages/client/login', [
            //view 
        ]);

        //retorna a view da pagina
        return parent::getClient('Login', $content);
    }
}