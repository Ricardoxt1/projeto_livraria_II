<?php

namespace App\Model\Entity;

use \WilliamCosta\DatabaseManager\Database;

class Costumer
{

    /**
     * id do costumer
     * @var integer
     */
    public int $id;

    /**
     * nome do usuario
     * @var string
     */
    public string $name;

    /**
     * cpf do usuario
     * @var string
     */
    public string $cpf;

    /**
     * telefone do usuario
     * @var string
     */
    public string $phone_number;

    /** 
     * endereço do usuario
     * @var string
     */
    public string $address;

    /**
     * email do usuario
     * @var string
     */
    public string $email;

    /**
     * método responsável por cadastrar usuario com a instancia atual
     * @return boolean
     */
    public function register(): bool
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
     * método responsável por atualizar um usuario com a instancia atual
     * @return boolean
     */
    public function update(): bool
    {

        //atualiza um consumidor no banco de dados
        return (new Database('costumers'))->update('id = ' . $this->id, [
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
     * método responsável por deletar um consumidor no banco de dados
     * @return boolean
     */
    public function delete(): bool
    {
        //deletar um consumidor no banco de dados
        return (new Database('costumers'))->delete('id = ' . $this->id);
    }

    /**
     * metodo responsável por retornar um autor com base no seu id
     * @param integer $id
     * @return Costumer
     */
    public static function getCostumerById(int $id): Costumer
    {
        return self::getCostumer('id =' . $id)->fetchObject(self::class);
    }

    /**
     * @param string $where
     * @param string $order
     * @param string $limit
     * @param string $field
     * @return PDOStatement
     */
    public static function getCostumer(string $where = null, string $order = null, string $limit = null, string $fields = '*')
    {
        return (new Database('costumers'))->select($where, $order, $limit, $fields);
    }
}
