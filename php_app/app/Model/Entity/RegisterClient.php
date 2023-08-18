<?php

namespace App\Model\Entity;

use \WilliamCosta\DatabaseManager\Database;

class RegisterClient
{

    /**
     * id do registro
     * @var integer
     */
    public int $id;

    /**
     * nome do registro
     * @var string
     */
    public string $username;

    /**
     * email do registro
     * @var string
     */
    public string $email;

    /**
     * password do registro
     * @var string
     */
    public string $password;

    /**
     * método responsável por retornar um usuário com base em seu email
     * @param string $email
     * @return 
     */
    public static function getRegisterByEmail(string $email)
    {
        return (new Database('register'))->select('email = "' . $email . '"')->fetchObject(self::class);
    }


    /**
     * método responsável por cadastrar com a instancia atual
     * @return boolean
     */
    public function register(): bool
    {
        $hashedPassword = password_hash($this->password, PASSWORD_BCRYPT);
        //inseri um registrar no banco de dados
        $this->id = (new Database('register'))->insert([
            'username' => $this->username,
            'email' => $this->email,
            'password' => $hashedPassword,
        ]);

        //sucesso
        return true;
    }


    /**
     * @param string $where
     * @param string $order
     * @param string $limit
     * @param string $field
     * @return PDOStatement
     */
    public static function getRegister(string $where = null, string $order = null, string $limit = null, string $fields = '*')
    {
        return (new Database('register'))->select($where, $order, $limit, $fields);
    }
}
