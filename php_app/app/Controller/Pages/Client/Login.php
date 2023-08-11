<?php

namespace App\Controller\Pages\Client;

use \App\Utils\View;
use \App\Model\Entity\RegisterClient;
use \App\Session\Admin\Login as SessionAdminLogin;


class Login extends Client
{

    /** metodo para resgatar os dados da pagina de login (view)
     * @return string
     * @param string $errorMessage
     * @param Request $request
     *  */
    public static function getLogin($request, $errorMessage = null)
    {   
        //status
        $status = !is_null($errorMessage) ? View::render('pages/client/login/status', [
            //view 
            'mensagem' => $errorMessage
        ]) : '';


        $content = View::render('pages/client/login', [
            //view 
            'status' => $status
        ]);

        //retorna a view da pagina
        return parent::getClient('Login', $content);
    }

    /**
     * método responsável por definir o login do usuário
     * @param Request
     */
    public static function setLogin($request){
        //post vars
        $postVars = $request->getPostVars();
        $email = $postVars['email'] ?? '';
        $password = $postVars['password'] ?? '';

        //busca o usuário pelo email
        $obRegister = RegisterClient::getRegisterByEmail($email);
       
        //verificar emaiil e senha
        if ($obRegister instanceof RegisterClient) {
            if (password_verify($password, $obRegister->password)) {
            } else {
                return self::getLogin($request, 'Email ou senha inválida!');
            }
        } else {
            return self::getLogin($request, 'Email ou senha inválida!');
        }

        //cria a sessão de login
        SessionAdminLogin::login($obRegister);
        
        //redireciona para home client
        $request->getRouter()->redirect('/menu');
       
    }

    /**
     * método responsável por deslogar o usuário
     * @param Request $request
     */
    public static function setLogout($request){
        //destrói a sessão de login
        SessionAdminLogin::logout();

        //redireciona o usuario para tela de login
        $request->getRouter()->redirect('/login');
    }
}