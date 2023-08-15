<?php

namespace App\Controller\Pages\Delete;

use \App\Utils\View;
use \App\Model\Entity\Author as EntityAuthor;
use \App\Controller\Pages\Client\Alert;
use \App\Controller\Pages\Read\Page;


class Author extends Page
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
                return Alert::getSuccess('Autor criado com sucesso!');
                break;
            case 'updated':
                return Alert::getSuccess('Autor atualizado com sucesso!');
                break;
            case 'deleted':
                return Alert::getSuccess('Autor deletado com sucesso!');
                break;
        }
    }


    /** metodo para realizar exclusão dos dados da pagina de autores
     * @return string
     * @param integer $id
     * @param Request $request
     * 
     *  */
    public static function getDeleteAuthor($request, $id)
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
    public static function setDeleteAuthor($request, $id)
    {
       

        //obtem os dados de autores no banco de dados
        $obAuthor = EntityAuthor::getAuthorById($id);
        
        //valida a instancia
        if (!$obAuthor instanceof EntityAuthor) {
            $request->getRouter()->redirect('/author');
        }

        //excluir autor
        $obAuthor->excluir($id);

        //redireciona para editagem
        $request->getRouter()->redirect('/author?status=deleted');
    }
    
}
