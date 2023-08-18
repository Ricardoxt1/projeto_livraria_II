<?php

namespace App\Controller\Pages\Delete;

use \App\Http\Request;
use \App\Utils\View;
use \App\Model\Entity\Book as EntityBook;
use \App\Controller\Pages\Client\Alert;
use \App\Controller\Pages\Read\Page;
use PDOException;


class Book extends Page
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
                return Alert::getSuccess('Livro deletado com sucesso!');
                break;
            case 'error':
                return Alert::getError('Não foi possível deletar esse livro!');
                break;
        }
    }


    /** metodo para realizar exclusão dos dados da pagina de livros
     * @return string parent::getPageHome
     * @param integer $id
     * @param Request $request
     * 
     *  */
    public static function getDeleteBook(Request $request, int $id): string
    {
        //obtem os dados de livros no banco de dados
        $obBook = EntityBook::getBookById($id);

        //valida a instancia
        if (!$obBook instanceof EntityBook) {
            $request->getRouter()->redirect('/book');
        }

        //redenrizar pagina de delete
        $content = View::render('/pages/delete/deleteBook', [
            //view Books
            'tipo' => 'livro',
            'titule' => 'Confirmar exclusão',
            'id' => $obBook->id,
            'title' => $obBook->titule,
            'page' => $obBook->page,
            'realese_date' => $obBook->realese_date,
            'status' => self::getStatus($request)
        ]);

        //retorna a view da pagina
        return parent::getPageHome('Confirmar de exclusão autor', $content);
    }

    /** metodo para realizar exclusão dos dados da pagina de livros (view)
     * @return string book
     * @param integer $id
     * @param Request $request
     * 
     *  */
    public static function setDeleteBook(Request $request, int $id): string
    {

        //obtem os dados de livros no banco de dados
        $obBook = EntityBook::getBookById($id);

        //valida a instancia
        if (!$obBook instanceof EntityBook) {
            $request->getRouter()->redirect('/book');
        }

        //condição para exclusão do item
        try {
            //excluir livros
            $obBook->delete($id);
        } catch (PDOException $e) {
            // Captura o erro e exibe uma mensagem personalizada
            if (strpos($e->getMessage(), 'ERROR: SQLSTATE[23000]:') || (!$obBook->delete($id))) {
                // Tratar o erro de chave estrangeira
                $request->getRouter()->redirect('/employee?status=error');
            }
        }

        //redireciona para editagem
        $request->getRouter()->redirect('/book?status=deleted');
    }
}
