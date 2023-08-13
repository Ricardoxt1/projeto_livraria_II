<?php

namespace App\Controller\Pages\Create;

use \App\Utils\View;
use \App\Model\Entity\Rental as EntityRental;
use \App\Model\Entity\Book as EntityBook;
use \App\Model\Entity\Costumer as EntityCostumer;
use \App\Model\Entity\Employee as EntityEmployee;
use \Exception;


class registerRental extends registerPage
{
    /** 
     * método responsavel por retornar itens alocados no banco de dados redenrizando a pagina
     * @return string $optionBook
     */
    private function getBookOption()
    {
        // dados de aluguel em relação aos livros
        $optionBook = '';

        // resultados da pagina
        $resultsBook = EntityBook::getBook(null, null, null);
        
        // renderiza o item
        while ($obBook = $resultsBook->fetchObject(EntityBook::class)){
            $optionBook .= View::render('pages/register/rental/optionBook', [
                'book_id' => $obBook->id,
                'titule' => $obBook->titule,
            ]);
        }
    
        // retorna os dados
        return $optionBook;
    }

    /** 
     * método responsavel por retornar itens alocados no banco de dados redenrizando a pagina
     * @return string $optionCostumer
     */
    private function getCostumerOption()
    {
        // dados de aluguel em relação aos usuarios
        $optionCostumer = '';

        // resultados da pagina
        $resultsCostumer = EntityCostumer::getCostumer(null, null, null);
        // renderiza o item
        while ($obCostumer = $resultsCostumer->fetchObject(EntityCostumer::class)){
            $optionCostumer .= View::render('pages/register/rental/optionCostumer', [
                'costumer_id' => $obCostumer->id,
                'costumer' => $obCostumer->name,
            ]);
        }
    
        // retorna os dados
        return $optionCostumer;
    }

    /** 
     * método responsavel por retornar itens alocados no banco de dados redenrizando a pagina
     * @return string $optionEmployee
     */
    private function getEmployeeOption()
    {
        // dados de aluguel em relação aos funcionarios
        $optionEmployee = '';

        // resultados da pagina
        $resultsEmployee = EntityEmployee::getEmployee(null, null, null);
        // renderiza o item
        while ($obEmployee = $resultsEmployee->fetchObject(EntityEmployee::class)){
            $optionEmployee .= View::render('pages/register/rental/optionEmployee', [
                'employee_id' => $obEmployee->id,
                'employee' => $obEmployee->name,
            ]);
        }
    
        // retorna os dados
        return $optionEmployee;
    }


    /** metodo para envio de dados da pagina registro aluguel (view)
     * @return string $content
     *  */
    public static function getRegisterRental($request)
    {

        $content = View::render('pages/register/registerRental', [
            //view livro
            'optionBook' => self::getBookOption($request),
            'optionCostumer' => self::getCostumerOption($request),
            'optionEmployee' => self::getEmployeeOption($request),

        ]);

        //retorna a view da pagina
        return parent::getPage('Registro de Aluguéis',$content);
    }

    /**
     * método responsavel por cadastrar um aluguel
     * @return boolean
     * @param Request $request
     */
    public static function setRegisterRental($request) {
        try {
            // Dados do post
            $postVars = $request->getPostVars();
            
            // Nova instância de aluguel
            $obRental = new EntityRental();
            $obRental->rental = $postVars['rental'];
            $obRental->delivery = $postVars['delivery'];
            $obRental->costumer_id = $postVars['costumer_id'];
            $obRental->book_id = $postVars['book_id'];
            $obRental->employee_id = $postVars['employee_id'];
            
            // Tente cadastrar o aluguel
            $obRental->cadastrar();
    
            return self::getRegisterRental($request);
        } catch (Exception $e) {
            
            return "Erro ao inserir o aluguel: " . $e->getMessage();
        }
    }
    
}
