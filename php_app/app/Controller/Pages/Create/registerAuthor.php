<?php

namespace App\Controller\Pages\Create;

use \App\Utils\View;
use \App\Model\Entity\Author;



class registerAuthor extends registerPage
{

    /** metodo para envio de dados da pagina registro autores (view)
     * @return string
     *  */
    public static function getRegisterAuthor()
    {

        $content = View::render('pages/register/registerAuthor', [
            //view autor
            'id' => '1',
            'name' => 'editora ld',
        ]);


        //retorna a view da pagina
        return parent::getPage('Registro de Autores',$content);
    }

    /**
     * método responsavel por cadastrar um autor
     * @return boolean
     * @param Request $request
     */
    public static function insertAuthor($request){
        //dados do post
        $postVars = $request->getPostVars();
       
        //nova instancia de autor
        $obAuthor = new Author();
        $obAuthor->name = $postVars['name'];
        $obAuthor->cadastrar();

        return self::getRegisterAuthor();
    }
}
