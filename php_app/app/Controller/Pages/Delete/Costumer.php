<?php

namespace App\Controller\Pages\Delete;

use \App\Utils\View;
use \App\Model\Entity\Costumer as EntityCostumer;
use \App\Controller\Pages\Client\Alert;
use \App\Controller\Pages\Read\Page;

class Costumer extends Page
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
                return Alert::getSuccess('Livro criado com sucesso!');
                break;
            case 'updated':
                return Alert::getSuccess('Livro atualizado com sucesso!');
                break;
            case 'deleted':
                return Alert::getSuccess('Livro deletado com sucesso!');
                break;
        }
    }

    /** metodo para realizar exclusão dos dados da pagina de consumidores
     * @return string
     * @param integer $id
     * @param Request $request
     * 
     *  */
    public static function getDeleteCostumer($request, $id)
    {
        //obtem os dados de consumidores no banco de dados
        $obCostumer = EntityCostumer::getCostumerById($id);

        //valida a instancia
        if (!$obCostumer instanceof EntityCostumer) {
            $request->getRouter()->redirect('/costumer');
        }

        $content = View::render('pages/delete/deleteCostumer', [
            //view book
            'tipo' => 'consumidor',
            'titule' => 'Confirmar exclusão',
            'name' => $obCostumer->name,
            'cpf' => $obCostumer->cpf,
            'email' => $obCostumer->email,
            'phone_number' => $obCostumer->phone_number,
            'address' => $obCostumer->address,
            'status' => self::getStatus($request)
        ]);

        //retorna a view da pagina
        return parent::getPageHome('Confirmação de exclusão consumidor', $content);
    }

    /** metodo para realizar exclusão dos dados da pagina de consumidores
     * @return string
     * @param integer $id
     * @param Request $request
     * 
     *  */
    public static function setDeleteCostumer($request, $id)
    {
        //obtem os dados de consumidores no banco de dados
        $obCostumer = EntityCostumer::getCostumerById($id);

        //valida a instancia
        if (!$obCostumer instanceof EntityCostumer) {
            $request->getRouter()->redirect('/costumer');
        }

        //excluir um consumidor
        $obCostumer->excluir($id);

        //redireciona para editagem
        $request->getRouter()->redirect('/costumer?status=deleted');
    }
}
