<?php

namespace App\Controller\Pages;

use \App\Utils\View;


class Costumer extends Page
{

    /** metodo para resgatar os dados da pagina de consumidores (view)
     * @return string
     *  */
    public static function getCostumer()
    {

        $content = View::render('pages/listCostumers', [
            //view costumers
            'name' => 'gisleine',
            'cpf' => '526.458.425-65',
            'address' => 'rua street n123',
            'email' => 'gisleine@gmail.com',
        ]);


        //retorna a view da pagina
        return parent::getPage('Listagem de Usuarios',$content);
    }
}
