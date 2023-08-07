<?php

namespace App\Controller\Pages\Create;

use \App\Utils\View;
use \App\Model\Entity\Publisher;
use \Exception;

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
        return parent::getPage('Registro de Editora', $content);
    }

    /**
     * método responsavel por cadastrar um editora
     * @return boolean
     * @param Request $request
     */
    public static function insertPublisher($request)
    {
        try {
            //dados do post
            $postVars = $request->getPostVars();

            // Verificar se o campo 'name' está presente no POST
            if (!isset($postVars['name']) || empty($postVars['name'])) {
                throw new Exception("Por favor, preencha o campo nome.");
            }

            //nova instancia de editora
            $obPublisher = new Publisher();
            $obPublisher->name = $postVars['name'];
            $obPublisher->cadastrar();

            return self::getRegisterPublisher();
        } catch (Exception $e) {
            // Tratar o erro
            return "Erro ao cadastrar uma editora: " . $e->getMessage();
        }
    }
}
