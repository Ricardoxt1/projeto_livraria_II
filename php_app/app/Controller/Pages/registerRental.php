<?php

namespace App\Controller\Pages;

use \App\Utils\View;


class registerRental extends registerPage
{

    /** metodo para envio de dados da pagina registro aluguel (view)
     * @return string
     *  */
    public static function getRegisterRental()
    {

        $content = View::render('pages/register/registerRental', [
            //view aluguel
            'id' => '1',
            'name' => 'editora ld',
        ]);


        //retorna a view da pagina
        return parent::getPage('Registro de Aluguéis',$content);
    }
}
