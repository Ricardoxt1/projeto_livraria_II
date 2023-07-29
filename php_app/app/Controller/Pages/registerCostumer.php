<?php

namespace App\Controller\Pages;

use \App\Utils\View;


class registerCostumer extends registerPage
{

    /** metodo para envio de dados da pagina registro usuario (view)
     * @return string
     *  */
    public static function getRegisterCostumer()
    {

        $content = View::render('pages/register/registerCostumer', [
            //view autor
            'id' => '1',
            'name' => 'editora ld',
        ]);


        //retorna a view da pagina
        return parent::getPage('Registro de Usuario',$content);
    }
}
