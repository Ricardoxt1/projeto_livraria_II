<?php

namespace App\Controller\Pages;

use \App\Utils\View;


class registerEmployee extends registerPage
{

    /** metodo para envio de dados da pagina registro funcionário (view)
     * @return string
     *  */
    public static function getRegisterEmployee()
    {

        $content = View::render('pages/register/registerEmployee', [
            //view funcionário
            'id' => '1',
            'name' => 'editora ld',
        ]);


        //retorna a view da pagina
        return parent::getPage('Registro de Funcionário(a)',$content);
    }
}
