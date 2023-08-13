<?php

namespace App\Model\Entity;

use \WilliamCosta\DatabaseManager\Database;

class Employee
{

    /**
     * id do funcionario(a)
     * @var integer
     */
    public $id;

    /**
     * nome do funcionario(a)
     * @var string
     */
    public $name;

    /**
     * pis do funcionario(a)
     * @var string
     */
    public $pis;

    /**
     * cargo do funcionario(a)
     * @var string
     */
    public $office;

    /** 
     * departamento do funcionario(a)
     * @var string
     */
    public $departament;

    /**
     * livraria do funcionario(a)
     * @var string
     */
    public $library_id;

    /**
     * método responsável por cadastrar funcionario(a) com a instancia atual
     * @return boolean
     */
    public function cadastrar()
    {

        //inseri um funcionario(a) no banco de dados
        $this->id = (new Database('employees'))->insert([
            'name' => $this->name,
            'pis' => $this->pis,
            'office' => $this->office,
            'departament' => $this->departament,
            'library_id' => $this->library_id,
        ]);

        //sucesso
        return true;
    }

    /**
     * metodo responsável por retornar um funcionario com base no seu id
     * @param integer $id
     * @return Employee
     */
    public static function getEmployeeById($id){
        return self::getEmployee('id ='. $id)->fetchObject(self::class);
    }

    /**
     * @param string $where
     * @param string $order
     * @param string $limit
     * @param integer $field
     * @return PDOStatement
     */
    public static function getEmployee($where = null, $order = null, $limit = null, $fields = '*'){
        return (new Database('employees'))->select($where, $order, $limit, $fields);
    }
}
