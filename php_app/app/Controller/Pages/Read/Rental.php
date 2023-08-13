<?php

namespace App\Controller\Pages\Read;

use \App\Utils\View;
use \App\Model\Entity\Rental as EntityRental;
use \App\Model\Entity\Costumer as EntityCostumer;
use \App\Model\Entity\Book as EntityBook;
use \App\Model\Entity\Employee as EntityEmployee;



class Rental extends Page
{
    /** 
     * método responsavel por retornar itens alocados no banco de dados redenrizando a pagina
     * @return string
     */
    private function getRentalItems($request)
    {
        // dados de aluguel
        $itens = '';

        // resultados da pagina
        $results = EntityRental::getRentalJoin(null, null, null);

        // renderiza o item
        while ($obRental = $results->fetchObject(EntityRental::class)) {
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
    public static function getRental($request)
    {

        $content = View::render('pages/list/listRentals', [
            //view rental
            'item' => self::getRentalItems($request)

        ]);


        //retorna a view da pagina
        return parent::getPage('Listagem de Alugueis', $content);
    }

    /**
     * renderiza os dados de consumidor na pagina de aluguel
     * @return string $optionCostumer
     */
    public static function getRentalOpCostumer()
    {

        //dados dos consumidores
        $optionCostumer = '';

        // resultados de consumidores
        $costumerResult = EntityCostumer::getCostumer(null, null, null);

        // renderiza o item
        while ($obCostumer = $costumerResult->fetchObject(EntityCostumer::class)) {
            $optionCostumer .= View::render('pages/update/rental/optionCostumer', [
                'costumer_id' => $obCostumer->id,
                'costumer' => $obCostumer->name,
            ]);
        }
        return $optionCostumer;
    }

    /**
     * renderiza os dados de livros na pagina de aluguel
     * @return string $optionBook
     */
    public static function getRentalOpBook()
    {

        //dados dos livros
        $optionBook = '';

        // resultados de livros
        $bookResult = EntityBook::getBook(null, null, null);

        // renderiza o item
        while ($obBook = $bookResult->fetchObject(EntityBook::class)) {
            $optionBook .= View::render('pages/update/rental/optionBook', [
                'book_id' => $obBook->id,
                'titule' => $obBook->titule,
            ]);
        }
        return $optionBook;
    }

    /**
     * renderiza os dados de funcionario na pagina de aluguel
     * @return string $optionEmployee
     */
    public static function getRentalOpEmployee()
    {

        //dados dos livros
        $optionEmployee = '';

        // resultados de livros
        $employeeResult = EntityEmployee::getEmployee(null, null, null);

        // renderiza o item
        while ($obEmployee = $employeeResult->fetchObject(EntityEmployee::class)) {
            $optionEmployee .= View::render('pages/update/rental/optionEmployee', [
                'employee_id' => $obEmployee->id,
                'employee' => $obEmployee->name,
            ]);
        }
        return $optionEmployee;
    }



    /** metodo para realizar update dos dados da pagina de alguel (view)
     * @return string
     *  */
    public static function getUpdateRental($request,$id)
    {

        $content = '';

        //obtem os dados de aluguel no banco de dados
        $obRental = EntityRental::getRentalById($id);

        //valida a instancia
        if (!$obRental instanceof EntityRental) {
            $request->getRouter()->redirect('/rental');
        }

        $content = View::render('pages/update/updateRental', [
            //view rental
            'id' => $obRental->id,
            'rental' => $obRental->rental,
            'delivery' => $obRental->delivery,
            'optionCostumer' => self::getRentalOpCostumer($request),
            'optionBook' => self::getRentalOpBook($request),
            'optionEmployee' => self::getRentalOpEmployee($request),
        ]);

        //retorna a view da pagina
        return parent::getPage('Editagem de Aluguel', $content);
    }
}
