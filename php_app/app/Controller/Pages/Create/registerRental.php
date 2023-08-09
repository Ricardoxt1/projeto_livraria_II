<?php

namespace App\Controller\Pages\Create;

use \App\Utils\View;
use \App\Model\Entity\Rental as EntityRental;
use \Exception;


class registerRental extends registerPage
{
    
    /** metodo para envio de dados da pagina registro aluguel (view)
     * @return string
     *  */
    public static function getRegisterRental()
    {

        // resultados da pagina
        $results = EntityRental::getRental(null, null, null);
   
        // renderiza o item
        while ($obRental = $results->fetchObject(EntityRental::class)){
            $content = View::render('pages/register/registerRental', [
                'id' => $obRental->rentals_id,
                'rental' => $obRental->rental,
                'delivery' => $obRental->delivery,
                'costumer_name' => $obRental->costumers_name,
                'costumer_id' => $obRental->costumer_id,
                'titule' => $obRental->books_titule,
                'book_id' => $obRental->book_id,
                'employee' => $obRental->employees_name,
                'employee_id' => $obRental->employee_id,
            ]);
        }

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
            
            // Nova instância de aluguel
            $obRental = new EntityRental();
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
