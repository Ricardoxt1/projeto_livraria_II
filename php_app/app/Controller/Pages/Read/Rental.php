<?php

namespace App\Controller\Pages\Read;

use \App\Utils\View;
use \App\Model\Entity\Rental as EntityRental;


class Rental extends Page
{
    /** 
     * método responsavel por retornar itens alocados no banco de dados redenrizando a pagina
     * @return string
     */
    private function getRentalItems()
    {
        // dados de aluguel
        $itens = '';

        // resultados da pagina
        $results = EntityRental::getRental(null, null, null);
   
        // renderiza o item
        while ($obRental = $results->fetchObject(EntityRental::class)){
            $itens .= View::render('pages/list/rental/item', [
                'id' => $obRental->id,
                'rental' => $obRental->rental,
                'delivery' => $obRental->delivery,
                'costumer' => $obRental->costumers_name,
                'titule' => $obRental->books_titule,
                'employee' => $obRental->employees_name,
            ]);
        }
    
        // retorna os dados
        return $itens;
    }

    /** metodo para resgatar os dados da pagina de alugueis (view)
     * @return string
     *  */
    public static function getRental()
    {

        $content = View::render('pages/list/listRentals', [
            //view rental
            'item' => self::getRentalItems()
            
        ]);


        //retorna a view da pagina
        return parent::getPage('Listagem de Alugueis',$content);
    }

    /** metodo para realizar update dos dados da pagina de alguel (view)
     * @return string
     *  */
    public static function getUpdateRental()
    {


        $content = View::render('pages/update/updateRental', [
            //view rental
           
        ]);

        //retorna a view da pagina
        return parent::getPage('Editagem de Aluguel', $content);
    }
}
