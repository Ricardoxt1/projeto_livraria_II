<?php

namespace App\Controller\Pages;

use \App\Utils\View;


class registerAuthor extends registerPage
{

    /** metodo para envio de dados da pagina registro autores (view)
     * @return string
     *  */
    public static function getRegisterAuthor()
    {

        $content = View::render('pages/register/registerAuthor', [
            //view autor
            'id' => '1',
            'name' => 'editora ld',
        ]);


        //retorna a view da pagina
        return parent::getPage('Registro de Autores',$content);
    }
}