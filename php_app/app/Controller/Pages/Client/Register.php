<?php

namespace App\Controller\Pages\Client;

use \App\Utils\View;
use \App\Model\Entity\RegisterClient;
use \App\Controller\Pages\Client\Alert;
use \App\Http\Request;
use \Exception;


class Register extends Client
{

    /**
     * método responsável por retornar a mensagem de status
     * @param Request $request
     * @return string $queryParams 
     * @return string Alert::getStatus
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

    /** metodo para resgatar os dados da pagina de registro (view)
     * @return string View:render
     * @return string parent::getClient
     * @param Request $request
     *  */
    public static function getRegister(Request $request): string
    {

        $content = View::render('pages/client/register', [
            //view 
            'status' => self::getStatus($request)

        ]);

        //retorna a view da pagina
        return parent::getClient('Registro', $content);
    }

    /**
     * método responsavel por cadastrar um editora 
     * @param Request $request
     * @return string
     */
    public static function setRegister(Request $request)
    {
        try {
            // Dados do post
            $postVars = $request->getPostVars();
            if (empty($postVars['username']) || empty($postVars['password']) || empty($postVars['email'])) {
                throw new Exception('Necessário preencher todos os campos!');
            }

            // Nova instância de registro
            $obRegister = new RegisterClient();
            $obRegister->username = $postVars['username'];
            $obRegister->email = $postVars['email'];
            $obRegister->password = $postVars['password'];

            // Tentativa de cadastrar o registro
            $obRegister->register();

            // redirecionar para pagina de login
            $request->getRouter()->redirect('/login?status=created');
        } catch (Exception $e) {
            // Captura a exceção e lida com o erro
            $e->$request->getRouter()->redirect('login/?status=error');
        }
    }
}
