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
            'id' => '1',
            'name' => 'editora ld',
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

            // Verificar se os campos obrigatórios estão presentes
            if (empty($postVars['titule']) || empty($postVars['page']) || empty($postVars['realese_date']) || empty($postVars['author_id']) || empty($postVars['library_id']) || empty($postVars['publisher_id'])) {
                throw new Exception("Todos os campos obrigatórios devem ser preenchidos.");
            }

            //nova instancia de livro
            $obBook = new Book();
            $obBook->titule = $postVars['titule'];
            $obBook->page = $postVars['page'];
            $obBook->realese_date = $postVars['realese_date'];
            $obBook->author_id = $postVars['author_id'];
            $obBook->library_id = $postVars['library_id'];
            $obBook->publisher_id = $postVars['publisher_id'];
            $obBook->cadastrar();

            return self::getRegisterBook();
        } catch (Exception $e) {
            return "Erro ao inserir o livro: " . $e->getMessage();
        }
    }
}
