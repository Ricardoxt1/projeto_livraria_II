<?php

namespace App\Controller\Pages\Delete;

use \App\Http\Request;
use \App\Utils\View;
use \App\Model\Entity\Employee as EntityEmployee;
use \App\Controller\Pages\Client\Alert;
use \App\Controller\Pages\Read\Page;
use PDOException;

class Employee extends Page
{

    /**
     * método responsável por retornar a mensagem de status
     * @param Request $request
     * @return string $queryParamns
     */
    private static function getStatus(Request $request): string
    {
        //query params
        $queryParamns = $request->getQueryParams();

        //status
        if (!isset($queryParamns['status'])) return '';

        //Mensagem de Status
        switch ($queryParamns['status']) {
            case 'deleted':
                return Alert::getSuccess('Funcionário(a) deletado com sucesso!');
                break;
            case 'error':
                return Alert::getError('Não foi possível deletar esse funcionário!');
                break;
        }
    }

    /** metodo para realizar exclusão dos dados da pagina de funcionários
     * @return string parent::getPageHome
     * @param integer $id
     * @param Request $request
     * 
     *  */
    public static function getDeleteEmployee(Request $request, int $id): string
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
     * @return string employee
     * @param integer $id
     * @param Request $request
     * 
     *  */
    public static function setDeleteEmployee(Request $request, int $id): string
    {
        //obtem os dados de funcionário no banco de dados
        $obEmployee = EntityEmployee::getEmployeeById($id);

        //valida a instancia
        if (!$obEmployee instanceof EntityEmployee) {
            $request->getRouter()->redirect('/employee');
        }

        try {
            //excluir um funcionário
            $obEmployee->delete($id);
        } catch (PDOException $e) {
            // Captura o erro e exibe uma mensagem personalizada
            if (strpos($e->getMessage(), 'ERROR: SQLSTATE[23000]:') || (!$obEmployee->delete($id))) {
                // Tratar o erro de chave estrangeira
                $request->getRouter()->redirect('/employee?status=error');
            }
        }

        //redireciona para editagem
        $request->getRouter()->redirect('/employee?status=deleted');
    }
}
