<?php

namespace App\Controller\Pages;

use \App\Utils\View;
use \App\Model\Entity\Publisher;

class registerPublisher extends registerPage
{

    /** metodo para envio de dados da pagina registro editora (view)
     * @return string
     *  */
    public static function getRegisterPublisher()
    {

        $content = View::render('pages/register/registerPublisher', [
            //view editora
            'id' => '1',
            'name' => 'editora ld',
        ]);


        //retorna a view da pagina
        return parent::getPage('Registro de Editora',$content);
    }

    /**
     * método responsavel por cadastrar um editora
     * @return boolean
     * @param Request $request
     */
    public static function insertPublisher($request){
        //dados do post
        $postVars = $request->getPostVars();
       
        //nova instancia de editora
        $obPublisher = new Publisher();
        $obPublisher->name = $postVars['name'];
        $obPublisher->cadastrar();

        return self::getRegisterPublisher();
    }
}
