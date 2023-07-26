<?php

namespace App\Controller\Pages;

use \App\Utils\View;


class Employee extends Page
{

    /** metodo para resgatar os dados da pagina de funcionario (view)
     * @return string
     *  */
    public static function getEmployee()
    {

        $content = View::render('pages/listEmployees', [
            //view employee
            'name' => 'joãozinho',
            'pis' => '542.6898.7488',
            'office' => 'vendedor',
            'departament' => 'vendas',

        ]);


        //retorna a view da pagina
        return parent::getPage('Listagem de Funcionários',$content);
    }
}
