<?php

namespace App\Controller\Pages\Create;

use \App\Utils\View;
use \App\Model\Entity\Book as EntityBook;
use \App\Model\Entity\Author;
use \App\Model\Entity\Publisher;

use \Exception;

class registerBook extends registerPage
{

    /**
     * renderiza os dados de editora na pagina de livros
     * @return string $optionPublisher
     */
    public static function getBookOpPublisher(){
        
        //dados da editora
        $optionPublisher = '';

        // resultados de editora
        $publisherResult = Publisher::getPublisher(null,null,null);
        // renderiza o item
        while ($obPublisher = $publisherResult->fetchObject(Publisher::class)) {
            $optionPublisher .= View::render('pages/register/book/optionPublisher', [
                'publisher_id' => $obPublisher->id,
                'publisher' => $obPublisher->name,
            ]);
        }
     
        return $optionPublisher;
    }

    /**
     * renderiza os dados de autores na pagina de livros
     * @return string $optionAuthor
     */
    public static function getBookOpAuthor(){

        //dados dos autores
        $optionAuthor = '';
      
        // resultados de autores
        $authorResult = Author::getAuthor(null,null,null);

        // renderiza o item
        while ($obAuthor = $authorResult->fetchObject(Author::class)) {
            $optionAuthor .= View::render('pages/register/book/optionAuthor', [
                'author_id' => $obAuthor->id,
                'author' => $obAuthor->name,
            ]);

        }

        return $optionAuthor;
    }

    /** metodo para envio de dados da pagina registro livros (view)
     * @return string
     *  */
    public static function getRegisterBook($request)
    {

        $content = View::render('pages/register/registerBook', [
            //view livro
            'optionAuthor' => self::getBookOpAuthor($request),
            'optionPublisher' => self::getBookOpPublisher($request),

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
            $obBook = new EntityBook();
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
