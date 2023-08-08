<?php

namespace App\Controller\Pages\Read;

use \App\Utils\View;
use \App\Model\Entity\Book as EntityBook;


class Book extends Page
{

    private function getBookItems()
    {
        // dados do livro
        $itens = '';

        // resultados da pagina
        $results = EntityBook::getBook(null, 'id DESC');

        // renderiza o item
        while ($obBook = $results->fetchObject(EntityBook::class)){
            $itens .= View::render('pages/list/book/item', [
                'titule' => $obBook->titule,
                'page' => $obBook->page,
                'realese_date' => $obBook->realese_date,
                'authors_name' => $obBook->author_id,
                'publishers_name' => $obBook->publisher_id,
                
            ]);
        }

        //retorna os dados
        return $itens;
    }

    /** metodo para resgatar os dados da pagina de livros (view)
     * @return string
     *  */
    public static function getBook()
    {

        $content = View::render('pages/list/listBooks', [
            //view book
            'item' => self::getBookItems(),
            
        ]);

        //retorna a view da pagina
        return parent::getPage('Listagem de Livros', $content);
    }

    /** metodo para realizar update dos dados da pagina de livro (view)
     * @return string
     *  */
    public static function getUpdateBook()
    {


        $content = View::render('pages/update/updateBook', [
            
        ]);

        //retorna a view da pagina
        return parent::getPage('Editagem de Livro', $content);
    }
}
