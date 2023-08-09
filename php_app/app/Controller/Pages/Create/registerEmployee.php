<?php

namespace App\Controller\Pages\Create;

use \App\Utils\View;
use \App\Model\Entity\Employee;
use \Exception;


class registerEmployee extends registerPage
{

    /** metodo para envio de dados da pagina registro funcionário (view)
     * @return string
     *  */
    public static function getRegisterEmployee()
    {

        $content = View::render('pages/register/registerEmployee', [
            //view funcionário
            'id' => '1',
            'name' => 'editora ld',
        ]);


        //retorna a view da pagina
        return parent::getPage('Registro de Funcionário(a)',$content);
    }

     /**
     * método responsavel por cadastrar um funcionario(a)
     * @return boolean
     * @param Request $request
     */
    public static function insertEmployee($request){
        try {
            //dados do post
            $postVars = $request->getPostVars();
            
            //nova instancia de funcionario
            $obEmployee = new Employee();
            $obEmployee->name = $postVars['name'];
            $obEmployee->pis = $postVars['pis'];
            $obEmployee->office = $postVars['office'];
            $obEmployee->departament = $postVars['departament'];
            $obEmployee->library_id = $postVars['library_id'];
            $obEmployee->cadastrar();
    
            return self::getRegisterEmployee();
        } catch (\Exception $e) {
            
            return ("Erro ao inserir funcionário: " . $e->getMessage());
           
        }
    }
    
}
