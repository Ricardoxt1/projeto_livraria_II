<?php

namespace App\Controller\Pages;

use \App\Utils\View;

class Author
{

    /** metodo para resgatar os dados da pagina de consumidores (view)
     * @return string
     *  */
    public static function getAuthor()
    {
        return View::render('pages/listAuthors', [
            'id' => '1',
            'name' => 'J.R.R Tolkien',
        ]);
    }
}
