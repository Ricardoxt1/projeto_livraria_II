<?php

namespace App\Controller\Pages\Read;

use \App\Utils\View;


class Employee extends Page
{

    /** metodo para resgatar os dados da pagina de funcionario (view)
     * @return string
     *  */
    public static function getEmployee()
    {

        $content = View::render('pages/list/listEmployees', [
            //view employee
            'id' => '1',
            'name' => 'joãozinho',
            'pis' => '542.6898.7488',
            'office' => 'vendedor',
            'departament' => 'vendas',

        ]);


        //retorna a view da pagina
        return parent::getPage('Listagem de Funcionários',$content);
    }

    /** metodo para realizar update dos dados da pagina de funcionario (view)
     * @return string
     *  */
    public static function getUpdateEmployee()
    {


        $content = View::render('pages/update/updateEmployee', [
            //view employee
            'id' => '1',
            'name' => 'benedito',
        ]);

        //retorna a view da pagina
        return parent::getPage('Editagem de Funcionario(a)', $content);
    }
}
