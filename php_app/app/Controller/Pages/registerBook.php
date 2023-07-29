<?php

namespace App\Controller\Pages;

use \App\Utils\View;


class registerBook extends registerPage
{

    /** metodo para envio de dados da pagina registro livros (view)
     * @return string
     *  */
    public static function getRegisterBook()
    {

        $content = View::render('pages/register/registerBook', [
            //view livro
            'id' => '1',
            'name' => 'editora ld',
        ]);


        //retorna a view da pagina
        return parent::getPage('Registro de Livro',$content);
    }
}
