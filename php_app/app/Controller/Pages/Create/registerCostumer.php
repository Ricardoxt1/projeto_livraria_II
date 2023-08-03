<?php

namespace App\Controller\Pages\Create;

use \App\Utils\View;
use \App\Model\Entity\Costumer;


class registerCostumer extends registerPage
{

    /** metodo para envio de dados da pagina registro usuario (view)
     * @return string
     *  */
    public static function getRegisterCostumer()
    {

        $content = View::render('pages/register/registerCostumer', [
            //view usuario
        ]);


        //retorna a view da pagina
        return parent::getPage('Registro de Usuario',$content);
    }

    /**
     * método responsavel por cadastrar um usuario
     * @return boolean
     * @param Request $request
     */
    public static function insertCostumer($request){
        //dados do post
        $postVars = $request->getPostVars();
       
        //nova instancia de usuario
        $obCostumer = new Costumer();
        $obCostumer->name = $postVars['name'];
        $obCostumer->cpf = $postVars['cpf'];
        $obCostumer->phone_number = $postVars['phone_number'];
        $obCostumer->address = $postVars['address'];
        $obCostumer->email = $postVars['email'];
        $obCostumer->cadastrar();

        return self::getRegisterCostumer();
    }
}
