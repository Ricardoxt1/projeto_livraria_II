<?php

namespace App\Model\Entity;

use \WilliamCosta\DatabaseManager\Database;

class Employee
{

    /**
     * id do funcionario(a)
     * @var integer
     */
    public int $id;

    /**
     * nome do funcionario(a)
     * @var string
     */
    public string $name;

    /**
     * pis do funcionario(a)
     * @var string
     */
    public string $pis;

    /**
     * cargo do funcionario(a)
     * @var string
     */
    public string $office;

    /** 
     * departamento do funcionario(a)
     * @var string
     */
    public string $departament;

    /**
     * livraria do funcionario(a)
     * @var string
     */
    public string $library_id;

    /**
     * método responsável por cadastrar funcionario(a) com a instancia atual
     * @return boolean
     */
    public function register(): bool
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
     * método responsável por atualizar um funcionario com a instancia atual
     * @return boolean
     */
    public function update(): bool
    {

        //atualiza um consumidor no banco de dados
        return (new Database('employees'))->update('id = ' . $this->id, [
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
     * método responsável por deletar um funcionário no banco de dados
     * @return boolean
     */
    public function delete(): bool
    {
        //deletar um funcionario no banco de dados
        return (new Database('employees'))->delete('id = ' . $this->id);
    }

    /**
     * metodo responsável por retornar um funcionario com base no seu id
     * @param integer $id
     * @return Employee
     */
    public static function getEmployeeById(int $id): Employee
    {
        return self::getEmployee('id =' . $id)->fetchObject(self::class);
    }

    /**
     * @param string $where
     * @param string $order
     * @param string $limit
     * @param string $field
     * @return PDOStatement
     */
    public static function getEmployee(string $where = null, string $order = null, string $limit = null, string $fields = '*')
    {
        return (new Database('employees'))->select($where, $order, $limit, $fields);
    }
}
