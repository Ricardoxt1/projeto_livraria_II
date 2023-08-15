<?php

namespace App\Controller\Pages\Delete;

use \App\Utils\View;
use \App\Model\Entity\Publisher as EntityPublisher;
use \App\Controller\Pages\Client\Alert;
use \App\Controller\Pages\Read\Page;

class Publisher extends Page
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
                return Alert::getSuccess('Editora criado com sucesso!');
                break;
            case 'updated':
                return Alert::getSuccess('Editora atualizado com sucesso!');
                break;
            case 'deleted':
                return Alert::getSuccess('Editora deletada com sucesso!');
                break;
        }
    }

    /** metodo para realizar exclusão dos dados da pagina de editora
     * @return string
     * @param integer $id
     * @param Request $request
     * 
     *  */
    public static function getDeletePublisher($request, $id)
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
     * @return string
     * @param integer $id
     * @param Request $request
     * 
     *  */
    public static function setDeletePublisher($request, $id)
    {
        //obtem os dados de editoras no banco de dados
        $obPublisher = EntityPublisher::getPublisherById($id);

        //valida a instancia
        if (!$obPublisher instanceof EntityPublisher) {
            $request->getRouter()->redirect('/publisher');
        }

        //excluir uma editora
        $obPublisher->excluir();
        //redireciona para editagem
        $request->getRouter()->redirect('/publisher?status=deleted');
    }
}