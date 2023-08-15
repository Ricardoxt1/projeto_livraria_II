<?php

namespace App\Controller\Pages\Delete;

use \App\Utils\View;
use \App\Model\Entity\Rental as EntityRental;
use \App\Controller\Pages\Client\Alert;
use \App\Controller\Pages\Read\Page;

class Rental extends Page
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
                return Alert::getSuccess('Aluguel criado com sucesso!');
                break;
            case 'updated':
                return Alert::getSuccess('Aluguel atualizado com sucesso!');
                break;
            case 'deleted':
                return Alert::getSuccess('Aluguel deletado com sucesso!');
                break;
        }
    }

    /** metodo para realizar exclusão dos dados da pagina de aluguel
     * @return string
     * @param integer $id
     * @param Request $request
     * 
     *  */
    public static function getDeleteRental($request, $id)
    {
        //obtem os dados de aluguel no banco de dados
        $obRental = EntityRental::getRentalById($id);

        //valida a instancia
        if (!$obRental instanceof EntityRental) {
            $request->getRouter()->redirect('/rental');
        }

        //redenrizar pagina de delete
        $content = View::render('/pages/delete/deleteRental', [
            //view authors
            'tipo' => 'editora',
            'rental' => $obRental->rental,
            'delivery' => $obRental->delivery,
            'costumer_name' => $obRental->costumer_id,
            'title' => $obRental->book_id,
            'titule' => 'Confirmar exclusão',
            'status' => self::getStatus($request)
        ]);

        //retorna a view da pagina
        return parent::getPageHome('Confirmar exclusão', $content);
    }

    /** metodo para realizar exclusão dos dados da pagina de aluguel 
     * @return string
     * @param integer $id
     * @param Request $request
     * 
     *  */
    public static function setDeleteRental($request, $id)
    {
        //obtem os dados do alguel no banco de dados
        $obRental = EntityRental::getRentalById($id);

        //valida a instancia
        if (!$obRental instanceof EntityRental) {
            $request->getRouter()->redirect('/rental');
        }

        //excluir um alguel
        $obRental->excluir();

        //redireciona para editagem
        $request->getRouter()->redirect('/rental?status=deleted');
    }
}
