<?php

namespace App\Controller\Pages;

use \App\Utils\View;


class Employee
{

    /** metodo para resgatar os dados da pagina de consumidores (view)
     * @return string
     *  */ 
    public static function getEmployee(){

        return View::render('pages/listEmployees' , [
            'id' => '1',
            'name' => 'cardin',
            'pis' => '12321431',
            'office' => 'venda',
            'departament' => 'vendas',
            'library_id' => 'biblioteca pedbot',
        ]);

    }
}
