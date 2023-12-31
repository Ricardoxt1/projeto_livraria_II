<?php

namespace App\Controller\Pages\Read;

use \App\Http\Request;
use \App\Utils\View;
use \App\Model\Entity\Author as EntityAuthor;
use \App\Controller\Pages\Client\Alert;

class Author extends Page
{

    /**
     * método responsavel por retornar itens alocados no banco de dados, renderizando na pagina.
     * @return string $itens
     */
    private function getAuthorItems(): string
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
     * @param Request $request
     * @return string parent::getPage
     *  */
    public static function getAuthor(Request $request): string
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
     * @return string parent::getPage
     * @param integer $id
     * @param Request $request
     * 
     *  */
    public static function getUpdateAuthor(Request $request, int $id): string
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
    public static function setUpdateAuthor(Request $request, int $id): string
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
        $obAuthor->update();

        //redireciona para editagem
        $request->getRouter()->redirect('/' . 'updateAuthor/' . $obAuthor->id . '/edit?status=updated');
    }
}
