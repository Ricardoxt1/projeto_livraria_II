<?php

namespace App\Model\Entity;

use \WilliamCosta\DatabaseManager\Database;

class Publisher
{

    /**
     * id do editora
     * @var integer
     */
    public $id;

    /**
     * nome do editora
     * @var string
     */
    public $name;

    
    /**
     * método responsável por cadastrar editora com a instancia atual
     * @return boolean
     */
    public function cadastrar()
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
    public function atualizar()
    {

        //atualiza um consumidor no banco de dados
        return (new Database('publishers'))->update('id = ' . $this->id, [
            'name' => $this->name,
        ]);

        //sucesso
        return true;
    }

    /**
     * metodo responsável por retornar uma editora com base no seu id
     * @param integer $id
     * @return Publisher
     */
    public static function getPublisherById($id){
        return self::getPublisher('id ='. $id)->fetchObject(self::class);
    }

    /**
     * @param string $where
     * @param string $order
     * @param string $limit
     * @param integer $field
     * @return PDOStatement
     */
    public static function getPublisher($where = null, $order = null, $limit = null, $fields = '*'){
        return (new Database('publishers'))->select($where, $order, $limit, $fields);
    }
}
