<?php

namespace App\Controller\Pages\Create;

use \App\Utils\View;
use \App\Model\Entity\Book;
use \Exception;

class registerBook extends registerPage
{

    /** metodo para envio de dados da pagina registro livros (view)
     * @return string
     *  */
    public static function getRegisterBook()
    {

        $content = View::render('pages/register/registerBook', [
            //view livro
            
           
        ]);


        //retorna a view da pagina
        return parent::getPage('Registro de Livro', $content);
    }

    /**
     * método responsavel por cadastrar um livro
     * @return boolean
     * @param Request $request
     */
    public static function insertBook($request)
    {
        try {
            //dados do post
            $postVars = $request->getPostVars();
            
            //nova instancia de livro
            $obBook = new Book();
            $obBook->titule = $postVars['titule'];
            $obBook->page = $postVars['page'];
            $obBook->realese_date = $postVars['realese_date'];
            $obBook->author_id = $postVars['author_id'];
            $obBook->library_id = $postVars['library_id'];
            $obBook->publisher_id = $postVars['publisher_id'];
            // $obBook->img = $postVars['img'];
            $obBook->cadastrar();

            // retorna a página de listagem de livros
            return self::getRegisterBook($request);
        } catch (Exception $e) {
            return "Erro ao inserir o livro: " . $e->getMessage();
        }
    }
}
