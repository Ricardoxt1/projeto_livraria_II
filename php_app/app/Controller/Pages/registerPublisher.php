<?php

namespace App\Controller\Pages;

use \App\Utils\View;


class registerPublisher extends registerPage
{

    /** metodo para envio de dados da pagina registro editora (view)
     * @return string
     *  */
    public static function getRegisterPublisher()
    {

        $content = View::render('pages/register/registerPublisher', [
            //view editora
            'id' => '1',
            'name' => 'editora ld',
        ]);


        //retorna a view da pagina
        return parent::getPage('Registro de Editora',$content);
    }
}
