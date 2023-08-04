<?php

namespace App\Controller\Pages\Client;

use \App\Utils\View;
use \App\Model\Entity\RegisterClient;


class Register extends Client
{

    /** metodo para resgatar os dados da pagina de registro (view)
     * @return string
     *  */
    public static function getRegister()
    {

        $content = View::render('pages/client/register', [
            //view 
        ]);

        //retorna a view da pagina
        return parent::getClient('Registro', $content);
    }

    /**
     * método responsavel por cadastrar um editora
     * @return boolean
     * @param Request $request
     */
    public static function insertRegister($request){
        //dados do post
        $postVars = $request->getPostVars();
       
        //nova instancia de registro
        $obRegister = new RegisterClient();
        $obRegister->username = $postVars['username'];
        $obRegister->email = $postVars['email'];
        $obRegister->password = $postVars['password'];
        $obRegister->cadastrar();

        return self::getRegister();
    }
}