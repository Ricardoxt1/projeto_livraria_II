<?php

namespace App\Controller\Pages\Read;

use \App\Utils\View;
use \App\Model\Entity\Author as EntityAuthor;
use \App\Controller\Pages\Client\Alert;

class Author extends Page
{

    /**
     * método responsavel por retornar itens alocados no banco de dados, renderizando na pagina.
     * @return string
     * @param Request $request
     * @return string
     */
    private function getAuthorItems($request)
    {
        // dados do autor
        $itens = '';

        // resultados da pagina
        $results = EntityAuthor::getAuthor(null, 'id ASC');

        // renderiza o item
        while ($obAuthor = $results->fetchObject(EntityAuthor::class)) {
            $itens .= View::render('pages/list/author/item', [
                'id' => $obAuthor->id,
                'name' => $obAuthor->name,

            ]);
        }
        // retorna os dados
        return $itens;
    }

    /** metodo para resgatar os dados da pagina de autores (view)
     * @param request $request
     * @return string
     *  */
    public static function getAuthor($request)
    {

        $content = View::render('pages/list/listAuthors', [
            //view authors
            'itens' => self::getAuthorItems($request),
            'status' => self::getStatus($request)

        ]);

        //retorna a view da pagina
        return parent::getPage('Listagem de Autores', $content);
    }

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

    /** metodo para realizar busca de dados para realizar update autores (view)
     * @return string
     * @param integer $id
     * @param Request $request
     * 
     *  */
    public static function getUpdateAuthor($request, $id)
    {
        //obtem os dados de autores no banco de dados
        $obAuthor = EntityAuthor::getAuthorById($id);

        //valida a instancia
        if (!$obAuthor instanceof EntityAuthor) {
            $request->getRouter()->redirect('/author');
        }


        $content = View::render('/pages/update/updateAuthor', [
            //view authors
            'title' => 'Editar Autores',
            'id' => $obAuthor->id,
            'name' => $obAuthor->name,
            'status' => self::getStatus($request)
        ]);

        //retorna a view da pagina
        return parent::getPage('Editagem de autor', $content);
    }

    /** metodo para realizar update dos dados da pagina de autores (view)
     * @return string
     * @param integer $id
     * @param Request $request
     * 
     *  */
    public static function setUpdateAuthor($request, $id)
    {
        //obtem os dados de autores no banco de dados
        $obAuthor = EntityAuthor::getAuthorById($id);

        //valida a instancia
        if (!$obAuthor instanceof EntityAuthor) {
            $request->getRouter()->redirect('/author');
        }

        //post vars
        $postVars = $request->getPostVars();

        //atualiza a instancia
        $obAuthor->name = $postVars['name'] ?? $obAuthor->name;
        $obAuthor->atualizar();

        //redireciona para editagem
        $request->getRouter()->redirect('/' . 'updateAuthor/' . $obAuthor->id . '/edit?status=updated');
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
        $obAuthor->excluir();
        //redireciona para editagem
        $request->getRouter()->redirect('/author?status=deleted');
    }
}
