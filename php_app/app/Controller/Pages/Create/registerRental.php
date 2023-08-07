<?php

namespace App\Controller\Pages\Create;

use \App\Utils\View;
use \App\Model\Entity\Rental;
use \Exception;

class registerRental extends registerPage
{

    /** metodo para envio de dados da pagina registro aluguel (view)
     * @return string
     *  */
    public static function getRegisterRental()
    {

        $content = View::render('pages/register/registerRental', [
            //view aluguel
            'id' => '1',
            'name' => 'editora ld',
        ]);


        //retorna a view da pagina
        return parent::getPage('Registro de Aluguéis',$content);
    }

    /**
     * método responsavel por cadastrar um aluguel
     * @return boolean
     * @param Request $request
     */
    public static function insertRental($request) {
        try {
            // Dados do post
            $postVars = $request->getPostVars();
            
            if(empty($postVars['rental']) || !is_array($postVars['delivery']) || empty($postVars['costumer_id']) || empty($postVars['book_id']) | empty($postVars['employee_id']) ) {
                throw new Exception("Por favor, preencha todos os campos.");
            };

            // Nova instância de aluguel
            $obRental = new Rental();
            $obRental->rental = $postVars['rental'];
            $obRental->delivery = $postVars['delivery'];
            $obRental->costumer_id = $postVars['costumer_id'];
            $obRental->book_id = $postVars['book_id'];
            $obRental->employee_id = $postVars['employee_id'];
            
            // Tente cadastrar o aluguel
            $obRental->cadastrar();
    
            return self::getRegisterRental();
        } catch (Exception $e) {
            
            return "Erro ao inserir o aluguel: " . $e->getMessage();
        }
    }
    
}
