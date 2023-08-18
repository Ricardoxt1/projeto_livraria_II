<?php

namespace App\Model\Entity;

use \WilliamCosta\DatabaseManager\Database;

class Publisher
{

    /**
     * id do editora
     * @var integer
     */
    public int $id;

    /**
     * nome do editora
     * @var string
     */
    public string $name;


    /**
     * método responsável por cadastrar editora com a instancia atual
     * @return boolean
     */
    public function register(): bool
    {

        //inseri um editora no banco de dados
        $this->id = (new Database('publishers'))->insert([
            'name' => $this->name,
        ]);

        //sucesso
        return true;
    }

    /**
     * método responsável por atualizar uma editora com a instancia atual
     * @return boolean
     */
    public function update(): bool
    {

        //atualiza um consumidor no banco de dados
        return (new Database('publishers'))->update('id = ' . $this->id, [
            'name' => $this->name,
        ]);

        //sucesso
        return true;
    }

    /**
     * método responsável por deletar uma editora no banco de dados
     * @return boolean
     */
    public function delete(): bool
    {
        //deletar uma editora no banco de dados
        return (new Database('publishers'))->delete('id = ' . $this->id);
    }

    /**
     * metodo responsável por retornar uma editora com base no seu id
     * @param integer $id
     * @return Publisher
     */
    public static function getPublisherById(int $id): Publisher
    {
        return self::getPublisher('id =' . $id)->fetchObject(self::class);
    }

    /**
     * @param string $where
     * @param string $order
     * @param string $limit
     * @param string $field
     * @return PDOStatement
     */
    public static function getPublisher(string $where = null, string $order = null, string $limit = null, string $fields = '*')
    {
        return (new Database('publishers'))->select($where, $order, $limit, $fields);
    }
}
