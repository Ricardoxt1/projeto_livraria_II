<?php

namespace App\Controller\Pages;

use \App\Utils\View;


class Rental
{

    /** metodo para resgatar os dados da pagina de consumidores (view)
     * @return string
     *  */ 
    public static function getRental(){

        return View::render('pages/listRentals' , [
            'id' => '1',
            'rental' => '12/08/23',
            'delivery' => '23/08/23',
            'costumer_id' => '123231',
            'book_id' => 'manana',
            'employee_id' => 'cardin@example.com',
        ]);

    }
}
