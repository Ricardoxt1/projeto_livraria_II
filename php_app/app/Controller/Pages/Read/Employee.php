<?php

namespace App\Controller\Pages\Read;

use \App\Utils\View;
use \App\Model\Entity\Employee as EntityEmployee;
use \App\Controller\Pages\Client\Alert;
use App\Http\Request;

class Employee extends Page
{
    /**
     * resgate de informações sobre os funcionários
     * @return string $itens
     */
    private function getEmployeeItems(): string
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
     * @param Request $request
     * @return string parent::getPage
     *  */
    public static function getEmployee(Request $request): string
    {

        $content = View::render('pages/list/listEmployees', [
            //view employee
            'item' => self::getEmployeeItems(),
            'status' => self::getStatus($request)
        ]);


        //retorna a view da pagina
        return parent::getPage('Listagem de Funcionários', $content);
    }

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

    /** metodo para realizar update dos dados da pagina de funcionario (view)
     * @param Request $request
     * @param integer $id
     * @return string parent::getPage
     *  */
    public static function getUpdateEmployee(Request $request, int $id): string
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
            'status' => self::getStatus($request)
        ]);

        //retorna a view da pagina
        return parent::getPage('Editagem de Funcionario(a)', $content);
    }

    /** metodo para realizar update dos dados da pagina de funcionario (view)
     * @return string updateEmployee
     * @param integer $id
     * @param Request $request
     * 
     *  */
    public static function setUpdateEmployee(Request $request, int $id): string
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

        $obEmployee->update();


        //redireciona para editagem
        $request->getRouter()->redirect('/' . 'updateEmployee/' . $obEmployee->id . '/edit?status=updated');
    }
}
