<?php

namespace App\Controller\Pages\Delete;

use \App\Http\Request;
use \App\Utils\View;
use \App\Model\Entity\Costumer as EntityCostumer;
use \App\Controller\Pages\Client\Alert;
use \App\Controller\Pages\Read\Page;
use PDOException;

class Costumer extends Page
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
                return Alert::getSuccess('Consumidor deletado com sucesso!');
                break;
            case 'error':
                return Alert::getError('Não foi possível deletar esse consumidor!');
                break;
        }
    }

    /** metodo para realizar exclusão dos dados da pagina de consumidores
     * @return string  parent::getPageHome
     * @param integer $id
     * @param Request $request
     * 
     *  */
    public static function getDeleteCostumer(Request $request, int $id): string
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
     * @return string costumer
     * @param integer $id
     * @param Request $request
     * 
     *  */
    public static function setDeleteCostumer(Request $request, int $id): string
    {
        //obtem os dados de consumidores no banco de dados
        $obCostumer = EntityCostumer::getCostumerById($id);

        //valida a instancia
        if (!$obCostumer instanceof EntityCostumer) {
            $request->getRouter()->redirect('/costumer');
        }

        //condição para exclusão do item
        try {
            //excluir um consumidor
            $obCostumer->delete($id);
        } catch (PDOException $e) {
            // Captura o erro e exibe uma mensagem personalizada
            if (strpos($e->getMessage(), 'ERROR: SQLSTATE[23000]:') || (!$obCostumer->delete($id))) {
                // Tratar o erro de chave estrangeira
                $request->getRouter()->redirect('/costumer?status=error');
            }
        }

        //redireciona para editagem
        $request->getRouter()->redirect('/costumer?status=deleted');
    }
}
