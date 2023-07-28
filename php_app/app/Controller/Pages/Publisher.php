<?php

namespace App\Controller\Pages;

use \App\Utils\View;


class Publisher extends Page
{

    /** metodo para resgatar os dados da pagina de editora (view)
     * @return string
     *  */
    public static function getPublisher()
    {

        $content = View::render('pages/list/listPublishers', [
            //view publishers
            'id' => '1',
            'name' => 'editora ld',
        ]);


        //retorna a view da pagina
        return parent::getPage('Listagem de Editoras',$content);
    }
}