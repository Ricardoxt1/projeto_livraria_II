<?php

namespace App\Controller\Pages\Read;

use \App\Utils\View;
use \App\Model\Entity\Book as EntityBook;
use \WilliamCosta\DatabaseManager\Pagination;


class Book extends Page
{
    /**
     * método responsavel por obter a renderização dos itens de liros para página
     * @param request $request
     * @param pagination $obPagination
     * @return string
     */
    private function getBookItems($request,&$obPagination)
    {
        // dados do livro
        $itens = '';
        
        //Quantidade total de registro
        $quantidadeTotal = EntityBook::getBook(null,null,null,'COUNT(*) as qtd')->fetchObject()->qtd;

        //Página Atual
        $queryParams = $request->getQueryParams();
        $paginaAtual = $queryParams['page'] ?? 1;
        
        $obPagination = new Pagination($quantidadeTotal, $paginaAtual, 4);
        
        // resultados da pagina
        $results = EntityBook::getBookJoin(null,'id DESC', $obPagination->getLimit());

        // renderiza o item
        while ($obBook = $results->fetchObject(EntityBook::class)) {
            $itens .= View::render('pages/list/book/item', [
                'titule' => $obBook->titule,
                'page' => $obBook->page,
                'realese_date' => $obBook->realese_date,
                'authors_name' => $obBook->authors_name,
                'publishers_name' => $obBook->publishers_name,

            ]);
        }

        //retorna os dados
        return $itens;
    }

    /** metodo para resgatar os dados da pagina de livros (view)
     * @param request $request
     * @return string
     *  */
    public static function getBook($request)
    {

        $content = View::render('pages/list/listBooks', [
            //view book
            'item' => self::getBookItems($request,$obPagination),
            'pagination' => parent::getPagination($request, $obPagination),

        ]);

        //retorna a view da pagina
        return parent::getPage('Listagem de Livros', $content);
    }

    /** metodo para realizar update dos dados da pagina de livro (view)
     * @return string
     *  */
    public static function getUpdateBook()
    {


        $content = View::render('pages/update/updateBook', []);

        //retorna a view da pagina
        return parent::getPage('Editagem de Livro', $content);
    }
}
