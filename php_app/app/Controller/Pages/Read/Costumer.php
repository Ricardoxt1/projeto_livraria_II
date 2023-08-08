<?php

namespace App\Controller\Pages\Read;

use \App\Utils\View;
use \App\Model\Entity\Costumer as EntityCostumer;


class Costumer extends Page
{

    private function getCostumerItems()
    {
        // dados do usuario
        $itens = '';

        // resultados da pagina
        $results = EntityCostumer::getCostumer(null, 'id DESC');

        // renderiza o item
        while ($obCostumer = $results->fetchObject(EntityCostumer::class)) {
            $itens .= View::render('pages/list/costumer/item', [
                'id' => $obCostumer->id,
                'name' => $obCostumer->name,
                'cpf' => $obCostumer->cpf,
                'phone_number' => $obCostumer->phone_number,
                'address' => $obCostumer->address,
                'email' => $obCostumer->email,
            ]);
        }
        //retorna os dados
        return $itens;

    }

    /** metodo para resgatar os dados da pagina de consumidores (view)
     * @return string
     *  */
    public static function getCostumer()
    {

        $content = View::render('pages/list/listCostumers', [
            //view costumers
            'item' => self::getCostumerItems(),
        ]);


        //retorna a view da pagina
        return parent::getPage('Listagem de Usuarios', $content);
    }

    /** metodo para realizar update dos dados da pagina de usuario (view)
     * @return string
     *  */
    public static function getUpdateCostumer()
    {


        $content = View::render('pages/update/updateCostumer', [
            //view costumer
            'id' => '1',
            'name' => 'benedito',
        ]);

        //retorna a view da pagina
        return parent::getPage('Editagem de Usuario', $content);
    }
}
