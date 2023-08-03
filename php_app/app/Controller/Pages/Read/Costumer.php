<?php

namespace App\Controller\Pages\Read;

use \App\Utils\View;


class Costumer extends Page
{

    /** metodo para resgatar os dados da pagina de consumidores (view)
     * @return string
     *  */
    public static function getCostumer()
    {

        $content = View::render('pages/list/listCostumers', [
            //view costumers
            
        ]);


        //retorna a view da pagina
        return parent::getPage('Listagem de Usuarios',$content);
    }

    /** metodo para realizar update dos dados da pagina de usuario (view)
     * @return string
     *  */
    public static function getUpdateCostumer()
    {


        $content = View::render('pages/update/updateCostumer', [
            //view costumer
            'id' => '1',
            'name' => 'benedito',
        ]);

        //retorna a view da pagina
        return parent::getPage('Editagem de Usuario', $content);
    }
}
