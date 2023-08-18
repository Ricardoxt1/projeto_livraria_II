<?php

namespace App\Controller\Pages\Delete;

use \App\Http\Request;
use \App\Utils\View;
use \App\Model\Entity\Rental as EntityRental;
use \App\Controller\Pages\Client\Alert;
use \App\Controller\Pages\Read\Page;
use PDOException;

class Rental extends Page
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
                return Alert::getSuccess('Aluguel deletado com sucesso!');
                break;
            case 'error':
                return Alert::getError('Não foi possível deletar esse aluguel!');
                break;
        }
    }

    /** metodo para realizar exclusão dos dados da pagina de aluguel
     * @return string  parent::getPageHome
     * @param integer $id
     * @param Request $request
     * 
     *  */
    public static function getDeleteRental(Request $request, int $id): string
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
     * @return string rental
     * @param integer $id
     * @param Request $request
     * 
     *  */
    public static function setDeleteRental(Request $request, int $id): string
    {
        //obtem os dados do alguel no banco de dados
        $obRental = EntityRental::getRentalById($id);

        //valida a instancia
        if (!$obRental instanceof EntityRental) {
            $request->getRouter()->redirect('/rental');
        }


        try {
            //excluir um alguel
            $obRental->delete();
        } catch (PDOException $e) {
            // Captura o erro e exibe uma mensagem personalizada
            if (strpos($e->getMessage(), 'ERROR: SQLSTATE[23000]:') || (!$obRental->delete($id))) {
                // Tratar o erro de chave estrangeira
                $request->getRouter()->redirect('/rental?status=error');
            }
        }

        //redireciona para editagem
        $request->getRouter()->redirect('/rental?status=deleted');
    }
}
