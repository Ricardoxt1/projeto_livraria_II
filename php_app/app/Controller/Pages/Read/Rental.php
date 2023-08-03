<?php

namespace App\Controller\Pages\Read;

use \App\Utils\View;


class Rental extends Page
{

    /** metodo para resgatar os dados da pagina de alugueis (view)
     * @return string
     *  */
    public static function getRental()
    {

        $content = View::render('pages/list/listRentals', [
            //view rental
            'id' => '1',
            'rental' => '26/07/2023',
            'delivery' => '02/08/2023',
            'costumer_name' => 'gislaine',
            'book_titule' => 'bela e a fera',
            'employee_name' => 'joãozinho',
            

        ]);


        //retorna a view da pagina
        return parent::getPage('Listagem de Alugueis',$content);
    }

    /** metodo para realizar update dos dados da pagina de alguel (view)
     * @return string
     *  */
    public static function getUpdateRental()
    {


        $content = View::render('pages/update/updateRental', [
            //view rental
            'id' => '1',
            'name' => 'benedito',
        ]);

        //retorna a view da pagina
        return parent::getPage('Editagem de Aluguel', $content);
    }
}
