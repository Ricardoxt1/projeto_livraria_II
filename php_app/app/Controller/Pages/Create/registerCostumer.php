<?php

namespace App\Controller\Pages\Create;

use App\Http\Request;
use \App\Utils\View;
use \App\Model\Entity\Costumer;
use \Exception;


class registerCostumer extends registerPage
{

    /** metodo para envio de dados da pagina registro usuario (view)
     * @return string parent:getPage
     *  */
    public static function getRegisterCostumer(): string
    {

        $content = View::render('pages/register/registerCostumer', [
            //view usuario
        ]);


        //retorna a view da pagina
        return parent::getPage('Registro de Usuario', $content);
    }

    /**
     * método responsavel por cadastrar um usuario
     * @return string updateCostumer
     * @param Request $request
     */
    public static function setRegisterCostumer(Request $request): string
    {
        try {
            //dados do post
            $postVars = $request->getPostVars();

            //nova instancia de usuario
            $obCostumer = new Costumer();
            $obCostumer->name = $postVars['name'];
            $obCostumer->cpf = $postVars['cpf'];
            $obCostumer->phone_number = $postVars['phone_number'];
            $obCostumer->address = $postVars['address'];
            $obCostumer->email = $postVars['email'];


            // Cadastrar o cliente
            $obCostumer->register();

            //redireciona para pagina de editagem
            $request->getRouter()->redirect('/' . 'updateCostumer/' . $obCostumer->id . '/edit?status=created');
        } catch (Exception $e) {
            // Tratar o erro
            $e->$request->getRouter()->redirect('registerCostumer/?status=error');
        }
    }
}
