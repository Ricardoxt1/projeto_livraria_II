<?php

namespace App\Controller\Pages\Client;

use App\Http\Request;
use \App\Utils\View;
use \App\Model\Entity\RegisterClient;
use \App\Session\Admin\Login as SessionAdminLogin;


class Login extends Client
{

    /**
     * método responsável por retornar a mensagem de status
     * @param Request $request
     * @return string $queryParams
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
                return Alert::getSuccess('Usuario criado com sucesso!');
                break;
        }
    }
    /** metodo para resgatar os dados da pagina de login (view)
     * @return string $status
     * @param string|null $errorMessage
     * @param Request $request
     *  */
    public static function getLogin(Request $request, string $errorMessage = null): string
    {
        //status
        $status = !is_null($errorMessage) ? Alert::getError($errorMessage) : '';


        $content = View::render('pages/client/login', [
            //view 
            'alert' => $status,
            'status' => self::getStatus($request)
        ]);

        //retorna a view da pagina
        return parent::getClient('Login', $content);
    }

    /**
     * método responsável por definir o login do usuário
     * @return string menu
     * @param Request $request
     */
    public static function setLogin(Request $request): string
    {
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
        }

        //cria a sessão de login
        SessionAdminLogin::login($obRegister);

        //redireciona para home client
        $request->getRouter()->redirect('/menu');
    }

    /**
     * método responsável por deslogar o usuário
     * @return string login
     * @param Request $request
     */
    public static function setLogout(Request $request): string
    {
        //destrói a sessão de login
        SessionAdminLogin::logout();

        //redireciona o usuario para tela de login
        $request->getRouter()->redirect('/login');
    }
}
