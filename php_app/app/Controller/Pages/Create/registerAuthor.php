<?php

namespace App\Controller\Pages\Create;

use App\Http\Request;
use \App\Utils\View;
use \App\Model\Entity\Author;
use \Exception;


class registerAuthor extends registerPage
{

    /** metodo para envio de dados da pagina registro autores (view)
     * @return string parent::getPage
     *  */
    public static function getRegisterAuthor(): string
    {

        $content = View::render('pages/register/registerAuthor', [
            //view autor
        ]);


        //retorna a view da pagina
        return parent::getPage('Registro de Autores', $content);
    }

    /**
     * método responsavel por cadastrar um autor
     * @return string
     * @param Request $request
     */
    public static function setRegisterAuthor(Request $request): string
    {
        try {
            //dados do post
            $postVars = $request->getPostVars();

            //nova instancia de autor
            $obAuthor = new Author();
            $obAuthor->name = $postVars['name'];
            $obAuthor->register();

            //redireciona para editagem
            $request->getRouter()->redirect('/' . 'updateAuthor/' . $obAuthor->id . '/edit?status=created');
        } catch (Exception $e) {
            // Capturar e tratar exceções
            $e->$request->getRouter()->redirect('registerAuthor/?status=error');
        }
    }
}
