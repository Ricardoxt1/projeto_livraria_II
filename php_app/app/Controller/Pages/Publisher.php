<?php

namespace App\Controller\Pages;

use \App\Utils\View;

class Publisher
{

    /** metodo para resgatar os dados da pagina de consumidores (view)
     * @return string
     *  */
    public static function getPublisher()
    {
        return View::render('pages/listPublishers', [
            'id' => '1',
            'name' => 'Rocco',  
        ]);
    }
}
