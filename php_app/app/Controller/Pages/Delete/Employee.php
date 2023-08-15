<?php

namespace App\Controller\Pages\Delete;

use \App\Utils\View;
use \App\Model\Entity\Employee as EntityEmployee;
use \App\Controller\Pages\Client\Alert;
use \App\Controller\Pages\Read\Page;

class Employee extends Page
{

    /**
     * método responsável por retornar a mensagem de status
     * @param request $request
     * @return string
     */
    private static function getStatus($request)
    {
        //query params
        $queryParamns = $request->getQueryParams();

        //status
        if (!isset($queryParamns['status'])) return '';

        //Mensagem de Status
        switch ($queryParamns['status']) {
            case 'created':
                return Alert::getSuccess('Funcionário(a) criado com sucesso!');
                break;
            case 'updated':
                return Alert::getSuccess('Funcionário(a) atualizado com sucesso!');
                break;
            case 'deleted':
                return Alert::getSuccess('Funcionário(a) deletado com sucesso!');
                break;
        }
    }

    /** metodo para realizar exclusão dos dados da pagina de funcionários
     * @return string
     * @param integer $id
     * @param Request $request
     * 
     *  */
    public static function getDeleteEmployee($request, $id)
    {
        //obtem os dados de funcionario no banco de dados
        $obEmployee = EntityEmployee::getEmployeeById($id);


        //valida a instancia
        if (!$obEmployee instanceof EntityEmployee) {
            $request->getRouter()->redirect('/employee');
        }

        //redenrizar pagina de delete
        $content = View::render('/pages/delete/deleteEmployee', [
            //view authors
            'tipo' => 'funcionário(a)',
            'name' => $obEmployee->name,
            'pis' => $obEmployee->pis,
            'office' => $obEmployee->office,
            'departament' => $obEmployee->departament,
            'titule' => 'Confirmar exclusão',
            'status' => self::getStatus($request)
        ]);

        //retorna a view da pagina
        return parent::getPageHome('Confirmar exclusão', $content);
    }

    /** metodo para realizar exclusão dos dados da pagina de funcionário
     * @return string
     * @param integer $id
     * @param Request $request
     * 
     *  */
    public static function setDeleteEmployee($request, $id)
    {
        //obtem os dados de funcionário no banco de dados
        $obEmployee = EntityEmployee::getEmployeeById($id);

        //valida a instancia
        if (!$obEmployee instanceof EntityEmployee) {
            $request->getRouter()->redirect('/employee');
        }

        //excluir um funcionário
        $obEmployee->excluir($id);
        //redireciona para editagem
        $request->getRouter()->redirect('/employee?status=deleted');
    }

}