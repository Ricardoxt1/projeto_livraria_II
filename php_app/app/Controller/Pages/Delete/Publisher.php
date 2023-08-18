<?php

namespace App\Controller\Pages\Delete;

use \App\Http\Request;
use \App\Utils\View;
use \App\Model\Entity\Publisher as EntityPublisher;
use \App\Controller\Pages\Client\Alert;
use \App\Controller\Pages\Read\Page;
use PDOException;

class Publisher extends Page
{
    /**
     * método responsável por retornar a mensagem de status
     * @param request $request
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
                return Alert::getSuccess('Editora deletada com sucesso!');
                break;
            case 'error':
                return Alert::getError('Não foi possível deletar essa editora!');
                break;
        }
    }

    /** metodo para realizar exclusão dos dados da pagina de editora
     * @return string parent::getPageHome
     * @param integer $id
     * @param Request $request
     * 
     *  */
    public static function getDeletePublisher(Request $request, int $id): string
    {
        //obtem os dados de editora no banco de dados
        $obPublisher = EntityPublisher::getPublisherById($id);


        //valida a instancia
        if (!$obPublisher instanceof EntityPublisher) {
            $request->getRouter()->redirect('/publisher');
        }

        //redenrizar pagina de delete
        $content = View::render('/pages/delete/deletePublisher', [
            //view authors
            'tipo' => 'editora',
            'name' => $obPublisher->name,
            'titule' => 'Confirmar exclusão',
            'status' => self::getStatus($request)
        ]);

        //retorna a view da pagina
        return parent::getPageHome('Confirmar exclusão', $content);
    }

    /** metodo para realizar exclusão dos dados da pagina de editoras (view)
     * @return string publisher
     * @param integer $id
     * @param Request $request
     * 
     *  */
    public static function setDeletePublisher(Request $request, int $id): string
    {
        //obtem os dados de editoras no banco de dados
        $obPublisher = EntityPublisher::getPublisherById($id);

        //valida a instancia
        if (!$obPublisher instanceof EntityPublisher) {
            $request->getRouter()->redirect('/publisher');
        }

        try {
            //excluir uma editora
            $obPublisher->delete();
        } catch (PDOException $e) {
            // Captura o erro e exibe uma mensagem personalizada
            if (strpos($e->getMessage(), 'ERROR: SQLSTATE[23000]:') || (!$obPublisher->delete($id))) {
                // Tratar o erro de chave estrangeira
                $request->getRouter()->redirect('/publisher?status=error');
            }
        }

        //redireciona para editagem
        $request->getRouter()->redirect('/publisher?status=deleted');
    }
}
