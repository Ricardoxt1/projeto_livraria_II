<?php

namespace App\Model\Entity;

use \WilliamCosta\DatabaseManager\Database;

class Author
{

    /**
     * id do autor
     * @var integer
     */
    public $id;

    /**
     * nome do autor
     * @var string
     */
    public $name;

    
    /**
     * método responsável por cadastrar autor com a instancia atual
     * @return boolean
     */
    public function cadastrar()
    {

        //inseri um autor no banco de dados
        $this->id = (new Database('authors'))->insert([
            'name' => $this->name,
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
    public static function getAuthor($where = null, $order = null, $limit = null, $fields = '*'){
        return (new Database('authors'))->select($where, $order, $limit, $fields);
    }
}