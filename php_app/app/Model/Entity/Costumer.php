<?php

namespace App\Model\Entity;

use \WilliamCosta\DatabaseManager\Database;

class Costumer
{

    /**
     * id do costumer
     * @var integer
     */
    public $id;

    /**
     * nome do usuario
     * @var string
     */
    public $name;

    /**
     * cpf do usuario
     * @var string
     */
    public $cpf;

    /**
     * telefone do usuario
     * @var string
     */
    public $phone_number;

    /** 
     * endereço do usuario
     * @var string
     */
    public $address;

    /**
     * email do usuario
     * @var string
     */
    public $email;

    /**
     * método responsável por cadastrar usuario com a instancia atual
     * @return boolean
     */
    public function cadastrar()
    {

        //inseri um usuario no banco de dados
        $this->id = (new Database('costumers'))->insert([
            'name' => $this->name,
            'cpf' => $this->cpf,
            'phone_number' => $this->phone_number,
            'address' => $this->address,
            'email' => $this->email,
        ]);

        //sucesso
        return true;
    }

    /**
     * metodo responsável por retornar um autor com base no seu id
     * @param integer $id
     * @return Author
     */
    public static function getCostumerById($id){
        return self::getCostumer('id ='. $id)->fetchObject(self::class);
    }

    /**
     * @param string $where
     * @param string $order
     * @param string $limit
     * @param integer $field
     * @return PDOStatement
     */
    public static function getCostumer($where = null, $order = null, $limit = null, $fields = '*'){
        return (new Database('costumers'))->select($where, $order, $limit, $fields);
    }
}
