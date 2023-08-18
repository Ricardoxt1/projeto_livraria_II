<?php

namespace App\Controller\Pages\Create;

use \App\Http\Request;
use \App\Utils\View;
use \App\Model\Entity\Publisher;
use \Exception;

class registerPublisher extends registerPage
{

    /** metodo para envio de dados da pagina registro editora (view)
     * @return string parent::getPage
     *  */
    public static function getRegisterPublisher(): string
    {

        $content = View::render('pages/register/registerPublisher', [
            //view editora
            'id' => '1',
            'name' => 'editora ld',
        ]);


        //retorna a view da pagina
        return parent::getPage('Registro de Editora', $content);
    }

    /**
     * método responsavel por cadastrar um editora
     * @return string updatePublisher
     * @param Request $request
     */
    public static function setRegisterPublisher(Request $request): string
    {
        try {
            //dados do post
            $postVars = $request->getPostVars();

            //nova instancia de editora
            $obPublisher = new Publisher();
            $obPublisher->name = $postVars['name'];
            $obPublisher->register();

            //redireciona para pagina de editagem
            $request->getRouter()->redirect('/' . 'updatePublisher/' . $obPublisher->id . '/edit?status=created');
        } catch (Exception $e) {
            // Tratar o erro
            $e->$request->getRouter()->redirect('registerPublisher/?status=error');
        }
    }
}
