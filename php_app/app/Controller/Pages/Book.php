<?php

namespace App\Controller\Pages;

use \App\Utils\View;


class Book
{

    /** metodo para resgatar os dados da pagina de consumidores (view)
     * @return string
     *  */ 
    public static function getBook(){

        return View::render('pages/listBooks' , [
            'id' => '1',
            'titule' => '12312',
            'page' => 'cardin',
            'realese_date' => '123231',
            'author_id' => 'manana',
            'library_id' => 'cardin@example.com',
            'publisher_id' => 'cardin@example.com',
        ]);

    }
}
