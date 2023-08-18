<?php

namespace App\Controller\Pages\Delete;

use \App\Http\Request;
use \App\Utils\View;
use \App\Model\Entity\Author as EntityAuthor;
use \App\Controller\Pages\Client\Alert;
use \App\Controller\Pages\Read\Page;
use PDOException;

class Author extends Page
{


    /**
     * método responsável por retornar a mensagem de status
     * @param Request $request
     * @return string $queryParams
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
                return Alert::getSuccess('Autor deletado com sucesso!');
                break;
            case 'error':
                return Alert::getError('Não foi possível deletar o autor!');
                break;
        }
    }


    /** metodo para realizar exclusão dos dados da pagina de autores
     * @return string parent::getPageHome
     * @param integer $id
     * @param Request $request
     * 
     *  */
    public static function getDeleteAuthor(Request $request, int $id): string
    {
        //obtem os dados de autores no banco de dados
        $obAuthor = EntityAuthor::getAuthorById($id);

        //valida a instancia
        if (!$obAuthor instanceof EntityAuthor) {
            $request->getRouter()->redirect('/author');
        }

        //redenrizar pagina de delete
        $content = View::render('/pages/delete/deleteAuthor', [
            //view authors
            'name' => $obAuthor->name,
            'titule' => 'Confirmar exclusão',
            'status' => self::getStatus($request)
        ]);

        //retorna a view da pagina
        return parent::getPageHome('Confirmar exclusão', $content);
    }

    /** metodo para realizar exclusão dos dados da pagina de autores (view)
     * @return string
     * @param integer $id
     * @param Request $request
     * 
     *  */
    public static function setDeleteAuthor(Request $request, int $id): string
    {
        //obtem os dados de autores no banco de dados
        $obAuthor = EntityAuthor::getAuthorById($id);

        //valida a instancia
        if (!$obAuthor instanceof EntityAuthor) {
            $request->getRouter()->redirect('/author');
        }

        //condição para exclusão do item
        try {
            //excluir autor
            $obAuthor->delete($id);
        } catch (PDOException $e) {
            // Captura o erro e exibe uma mensagem personalizada
            if (strpos($e->getMessage(), 'ERROR: SQLSTATE[23000]:') || (!$obAuthor->delete($id))) {
                // Tratar o erro de chave estrangeira
                $request->getRouter()->redirect('/author?status=error');
            }
        }

        //redireciona para editagem
        $request->getRouter()->redirect('/author?status=deleted');
    }
}
