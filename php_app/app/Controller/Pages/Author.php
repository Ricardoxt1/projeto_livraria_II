<?php

namespace App\Controller\Pages;

use \App\Utils\View;


class Author extends Page
{

    /** metodo para resgatar os dados da pagina de autores (view)
     * @return string
     *  */
    public static function getAuthor()
    {

        $content = View::render('pages/listAuthors', [
            //view authors
            'name' => 'benedito',
        ]);


        //retorna a view da pagina
        return parent::getPage('Listagem de Autores', $content);
    }
}
