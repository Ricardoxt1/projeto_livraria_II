<?php

namespace App\Controller\Pages\Read;

use \App\Http\Request;
use \App\Utils\View;
use \App\Model\Entity\Book as EntityBook;
use \App\Model\Entity\Author;
use \App\Model\Entity\Publisher;
use \WilliamCosta\DatabaseManager\Pagination;
use \App\Controller\Pages\Client\Alert;



class Book extends Page
{
    /**
     * método responsavel por obter a renderização dos itens de liros para página
     * @param Request $request
     * @param Pagination $obPagination
     * @return string $itens
     */
    private function getBookItems(Request $request, &$obPagination): string
    {
        // dados do livro
        $itens = '';

        //Quantidade total de registro
        $quantidadeTotal = EntityBook::getBook(null, null, null, 'COUNT(*) as qtd')->fetchObject()->qtd;

        //Página Atual
        $queryParams = $request->getQueryParams();

        $paginaAtual = $queryParams['page'] ?? 1;

        $obPagination = new Pagination($quantidadeTotal, $paginaAtual, 4);

        // resultados da pagina
        $results = EntityBook::getBookJoin(null, 'id DESC', $obPagination->getLimit());

        // renderiza o item
        while ($obBook = $results->fetchObject(EntityBook::class)) {
            $itens .= View::render('pages/list/book/item', [
                'id' => $obBook->id,
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
     * @param Request $request
     * @return string parent::getPage
     *  */
    public static function getBook(Request $request): string
    {

        $content = View::render('pages/list/listBooks', [
            //view book
            'item' => self::getBookItems($request, $obPagination),
            'pagination' => parent::getPagination($request, $obPagination),
            'status' => self::getStatus($request)
        ]);

        //retorna a view da pagina
        return parent::getPage('Listagem de Livros', $content);
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
                return Alert::getSuccess('Livro criado com sucesso!');
                break;
            case 'updated':
                return Alert::getSuccess('Livro atualizado com sucesso!');
                break;
            case 'deleted':
                return Alert::getSuccess('Livro deletado com sucesso!');
                break;
        }
    }

    /**
     * renderiza os dados de autores na pagina de livros
     * @return string $optionAuthor
     */
    public static function getBookOpAuthor(): string
    {

        //dados dos autores
        $optionAuthor = '';

        // resultados de autores
        $authorResult = Author::getAuthor();

        // renderiza o item
        while ($obAuthor = $authorResult->fetchObject(Author::class)) {
            $optionAuthor .= View::render('pages/register/book/optionAuthor', [
                'author_id' => $obAuthor->id,
                'author' => $obAuthor->name,
            ]);
        }

        return $optionAuthor;
    }

    /**
     * renderiza os dados de editora na pagina de livros
     * @return string $optionPublisher
     */
    public static function getBookOpPublisher(): string
    {

        //dados da editora
        $optionPublisher = '';

        // resultados de editora
        $publisherResult = Publisher::getPublisher();
        // renderiza o item
        while ($obPublisher = $publisherResult->fetchObject(Publisher::class)) {
            $optionPublisher .= View::render('pages/register/book/optionPublisher', [
                'publisher_id' => $obPublisher->id,
                'publisher' => $obPublisher->name,
            ]);
        }

        return $optionPublisher;
    }

    /** metodo para realizar update dos dados da pagina de livro (view)
     * @return string parent::getPage
     * @param Request $request
     * @param integer $id
     *  */
    public static function getUpdateBook(Request $request, int $id): string
    {

        $content = '';

        //obtem os dados de livros no banco de dados
        $obBook = EntityBook::getBookById($id);

        //valida a instancia
        if (!$obBook instanceof EntityBook) {
            $request->getRouter()->redirect('/book');
        }

        $content .= View::render('pages/update/updateBook', [
            'id' => $obBook->id,
            'titule' => $obBook->titule,
            'page' => $obBook->page,
            'realese_date' => $obBook->realese_date,
            'optionAuthor' => self::getBookOpAuthor($request),
            'optionPublisher' => self::getBookOpPublisher($request),
            'status' => self::getStatus($request)

        ]);


        //retorna a view da pagina
        return parent::getPage('Editagem de Livro', $content);
    }

    /** metodo para realizar update dos dados da pagina de livros (view)
     * @return string updateBook
     * @param Request $request
     * @param integer $id
     * 
     *  */
    public static function setUpdateBook(Request $request, int $id): string
    {
        //obtem os dados de livros no banco de dados
        $obBook = EntityBook::getBookById($id);

        //valida a instancia
        if (!$obBook instanceof EntityBook) {
            $request->getRouter()->redirect('/author');
        }

        //post vars
        $postVars = $request->getPostVars();

        //atualiza a instancia
        $obBook->titule = $postVars['titule'] ?? $obBook->titule;
        $obBook->page = $postVars['page'] ?? $obBook->page;
        $obBook->realese_date = $postVars['realese_date'] ?? $obBook->realese_date;
        $obBook->author_id = $postVars['author_id'] ?? $obBook->author_id;
        $obBook->library_id = $postVars['library_id'] ?? $obBook->library_id;
        $obBook->publisher_id = $postVars['publisher_id'] ?? $obBook->publisher_id;

        $obBook->update();


        //redireciona para editagem
        $request->getRouter()->redirect('/' . 'updateBook/' . $obBook->id . '/edit?status=updated');
    }
}
