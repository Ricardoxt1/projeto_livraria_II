<?php

namespace App\Controller\Pages\Read;

use \App\Utils\View;
use \App\Model\Entity\Publisher as EntityPublisher;


class Publisher extends Page
{
    private function getPublisherItems(){

        // dados da editora
        $itens = '';
    
        // resultados da pagina
        $results = EntityPublisher::getPublisher(null, 'id ASC');
    
        // renderiza o item
        while ($obPublisher = $results->fetchObject(EntityPublisher::class)){
            $itens .= View::render('pages/list/publisher/item', [
                'id' => $obPublisher->id,
                'name' => $obPublisher->name,
            ]);
        }
    
        return $itens;
    }


    /** metodo para resgatar os dados da pagina de editora (view)
     * @return string
     *  */
    public static function getPublisher()
    {

        $content = View::render('pages/list/listPublishers', [
            //view publishers
            'item' => self::getPublisherItems(),
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
