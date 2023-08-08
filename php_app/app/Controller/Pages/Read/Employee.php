<?php

namespace App\Controller\Pages\Read;

use \App\Utils\View;
use \App\Model\Entity\Employee as EntityEmployee;


class Employee extends Page
{
    private function getEmployeeItems()
    {
        // dados do usuario
        $itens = '';

        // resultados da pagina
        $results = EntityEmployee::getEmployee(null, 'id ASC');

        // renderiza o item
        while ($obEmployee = $results->fetchObject(EntityEmployee::class)){
            $itens .= View::render('pages/list/employee/item',[
                'id' => $obEmployee->id,
                'name' => $obEmployee->name,
                'pis' => $obEmployee->pis,
                'office' => $obEmployee->office,
                'departament' => $obEmployee->departament,
                'library_id' => $obEmployee->library_id,

            ]);
        }

        // retorna os dados
        return $itens;
    }


    /** metodo para resgatar os dados da pagina de funcionario (view)
     * @return string
     *  */
    public static function getEmployee()
    {

        $content = View::render('pages/list/listEmployees', [
            //view employee
            'item' => self::getEmployeeItems(),
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
            
        ]);

        //retorna a view da pagina
        return parent::getPage('Editagem de Funcionario(a)', $content);
    }
}
