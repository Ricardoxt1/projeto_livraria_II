<?php
namespace App\Controller\Pages\Create;

use \App\Utils\View;
use \App\Model\Entity\Author;
use \Exception;


class registerAuthor extends registerPage
{

    /** metodo para envio de dados da pagina registro autores (view)
     * @return string
     *  */
    public static function getRegisterAuthor()
    {

        $content = View::render('pages/register/registerAuthor', [
            //view autor
        ]);


        //retorna a view da pagina
        return parent::getPage('Registro de Autores', $content);
    }

    /**
     * método responsavel por cadastrar um autor
     * @return boolean
     * @param Request $request
     */
    public static function setRegisterAuthor($request)
    {
        try {
            //dados do post
            $postVars = $request->getPostVars();

            //nova instancia de autor
            $obAuthor = new Author();
            $obAuthor->name = $postVars['name'];
            $obAuthor->cadastrar();

            //redireciona para editagem
            $request->getRouter()->redirect('/'. 'updateAuthor/'.$obAuthor->id.'/edit?status=created');
        } catch (Exception $e) {
            // Capturar e tratar exceções
            return 'Erro ao inserir autor: ' . $e->getMessage();
        }
    }
}
