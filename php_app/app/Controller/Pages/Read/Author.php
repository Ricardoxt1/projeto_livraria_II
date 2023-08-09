<?php

namespace App\Controller\Pages\Read;

use \App\Utils\View;
use \App\Model\Entity\Author as EntityAuthor;


class Author extends Page
{

    /**
     * método responsavel por retornar itens alocados no banco de dados, renderizando na pagina.
     * @return string
     */
    private function getAuthorItems()
    {
        // dados do autor
        $itens = '';

        // resultados da pagina
        $results = EntityAuthor::getAuthor(null, 'id ASC');

        // renderiza o item
        while ($obAuthor = $results->fetchObject(EntityAuthor::class)) {
            $itens .= View::render('pages/list/author/item', [
                'name' => $obAuthor->name,
                
            ]);
        }


        // retorna os dados
        return $itens;
    }

    /** metodo para resgatar os dados da pagina de autores (view)
     * @return string
     *  */
    public static function getAuthor()
    {


        $content = View::render('pages/list/listAuthors', [
            //view authors
            'itens' => self::getAuthorItems()
        ]);

        //retorna a view da pagina
        return parent::getPage('Listagem de Autores', $content);
    }


    /** metodo para realizar update dos dados da pagina de autores (view)
     * @return string
     *  */
    public static function getUpdateAuthor()
    {


        $content = View::render('pages/update/updateAuthor', [
            //view authors
            'id' => '1',
            'name' => 'benedito',
        ]);

        //retorna a view da pagina
        return parent::getPage('Editagem de autor', $content);
    }
}
