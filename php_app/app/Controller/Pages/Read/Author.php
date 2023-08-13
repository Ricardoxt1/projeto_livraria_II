<?php

namespace App\Controller\Pages\Read;

use \App\Utils\View;
use \App\Model\Entity\Author as EntityAuthor;


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

        ]);

        //retorna a view da pagina
        return parent::getPage('Listagem de Autores', $content);
    }


    /** metodo para realizar update dos dados da pagina de autores (view)
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
        ]);

        //retorna a view da pagina
        return parent::getPage('Editagem de autor', $content);
    }
}
