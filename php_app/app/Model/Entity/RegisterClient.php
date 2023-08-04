<?php

namespace App\Model\Entity;

use \WilliamCosta\DatabaseManager\Database;

class RegisterClient
{

    /**
     * id do registro
     * @var integer
     */
    public $id;

    /**
     * nome do registro
     * @var string
     */
    public $username;

    /**
     * email do registro
     * @var string
     */
    public $email;

    /**
     * password do registro
     * @var string
     */
    public $password;

    
    /**
     * método responsável por cadastrar com a instancia atual
     * @return boolean
     */
    public function cadastrar()
    {

        //inseri um registrar no banco de dados
        $this->id = (new Database('register'))->insert([
            'username' => $this->username,
            'email' => $this->email,
            'password' => $this->password,
        ]);

        //sucesso
        return true;
    }

    /**
     * @param string $where
     * @param string $order
     * @param string $limit
     * @param integer $field
     * @return PDOStatement
     */
    public static function getRegister($where = null, $order = null, $limit = null, $fields = '*'){
        return (new Database('register'))->select($where, $order, $limit, $fields);
    }
}
