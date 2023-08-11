<?php

namespace App\Controller\Pages\Client;

use \App\Utils\View;
use \App\Model\Entity\RegisterClient;
use \Exception;


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
    public static function insertRegister($request)
    {
        try {
            // Dados do post
            $postVars = $request->getPostVars();
            if(empty($postVars['username']) || empty($postVars['password']) || empty($postVars['email'])){
                throw new Exception('Necessário preencher todos os campos!');
                
            }
            
            // Nova instância de registro
            $obRegister = new RegisterClient();
            $obRegister->username = $postVars['username'];
            $obRegister->email = $postVars['email'];
            $obRegister->password = $postVars['password'];

            // $obRegister = RegisterClient::getRegisterByEmail($email);
            // if(!$obRegister instanceof RegisterClient){
            //     return self::getRegister($request);
            // }
            
            // Tentativa de cadastrar o registro
            $obRegister->cadastrar();
            
            return self::getRegister();
        } catch (Exception $e) {
            // Captura a exceção e lida com o erro
            return "Erro ao inserir o registro: " . $e->getMessage();
        }
        echo "<pre>"; print_r($obRegister); echo "<pre>"; exit;
    }
}
