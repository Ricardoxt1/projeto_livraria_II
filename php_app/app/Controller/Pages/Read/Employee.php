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
        while ($obEmployee = $results->fetchObject(EntityEmployee::class)) {
            $itens .= View::render('pages/list/employee/item', [
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
        return parent::getPage('Listagem de Funcionários', $content);
    }

    /** metodo para realizar update dos dados da pagina de funcionario (view)
     * @return string
     *  */
    public static function getUpdateEmployee($request, $id)
    {

        //obtem os dados de funcionarios no banco de dados
        $obEmployee = EntityEmployee::getEmployeeById($id);

        //valida a instancia
        if (!$obEmployee instanceof EntityEmployee) {
            $request->getRouter()->redirect('/employee');
        }

        $content = View::render('pages/update/updateEmployee', [
            //view employee
            'id' => $obEmployee->id,
            'name' => $obEmployee->name,
            'pis' => $obEmployee->pis,
            'office' => $obEmployee->office,
            'departament' => $obEmployee->departament,
            'library_id' => $obEmployee->library_id,
        ]);

        //retorna a view da pagina
        return parent::getPage('Editagem de Funcionario(a)', $content);
    }

         /** metodo para realizar update dos dados da pagina de funcionario (view)
     * @return string
     * @param integer $id
     * @param Request $request
     * 
     *  */
    public static function setUpdateEmployee($request, $id)
    {
        //obtem os dados de livros no banco de dados
        $obEmployee = EntityEmployee::getEmployeeById($id);

        //valida a instancia
        if (!$obEmployee instanceof EntityEmployee) {
            $request->getRouter()->redirect('/employee');
        }

        //post vars
        $postVars = $request->getPostVars();

        //atualiza a instancia
        $obEmployee->name = $postVars['name'] ?? $obEmployee->name;
        $obEmployee->pis = $postVars['pis'] ?? $obEmployee->pis;
        $obEmployee->office = $postVars['office'] ?? $obEmployee->office;
        $obEmployee->departament = $postVars['departament'] ?? $obEmployee->departament;
        $obEmployee->library_id = $postVars['library_id'] ?? $obEmployee->library_id;
        
        $obEmployee->atualizar();


        //redireciona para editagem
        $request->getRouter()->redirect('/'. 'updateEmployee/'.$obEmployee->id.'/edit?status=updated');
    }
}
