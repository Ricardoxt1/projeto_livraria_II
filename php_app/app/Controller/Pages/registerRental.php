<?php

namespace App\Controller\Pages;

use \App\Utils\View;
use \App\Model\Entity\Rental;


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
    public static function insertRental($request){
        //dados do post
        $postVars = $request->getPostVars();
       
        //nova instancia de aluguel
        $obRental = new Rental();
        $obRental->rental = $postVars['rental'];
        $obRental->delivery = $postVars['delivery'];
        $obRental->costumer_id = $postVars['costumer_id'];
        $obRental->book_id = $postVars['book_id'];
        $obRental->employee_id = $postVars['employee_id'];
        $obRental->cadastrar();

        return self::getRegisterRental();
    }
}
