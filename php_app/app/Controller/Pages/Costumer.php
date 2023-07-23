<?php

namespace App\Controller\Pages;

use \App\Utils\View;


class Costumer
{

    /** metodo para resgatar os dados da pagina de consumidores (view)
     * @return string
     *  */ 
    public static function getCostumer(){

        return View::render('pages/listCostumers' , [
            'id' => '1',
            'cpf' => '12312',
            'name' => 'cardin',
            'phone_number' => '123231',
            'address' => 'manana',
            'email' => 'cardin@example.com',
        ]);

    }
}
