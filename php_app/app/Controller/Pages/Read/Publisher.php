<?php

namespace App\Controller\Pages\Read;

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

    /** metodo para realizar update dos dados da pagina de editora (view)
     * @return string
     *  */
    public static function getUpdatePublisher()
    {


        $content = View::render('pages/update/updatePublisher', [
            //view publisher
            'id' => '1',
            'name' => 'benedito',
        ]);

        //retorna a view da pagina
        return parent::getPage('Editagem de Editora', $content);
    }
}
