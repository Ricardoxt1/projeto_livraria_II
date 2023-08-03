<?php

namespace App\Controller\Pages\Client;

use \App\Utils\View;


class Register extends Client
{

    /** metodo para resgatar os dados da pagina de registro (view)
     * @return string
     *  */
    public static function getRegister()
    {

        $content = View::render('pages/client/register', [
            //view 
        ]);

        //retorna a view da pagina
        return parent::getClient('Registro', $content);
    }
}