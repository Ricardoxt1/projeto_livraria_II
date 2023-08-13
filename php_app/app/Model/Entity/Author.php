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
     * método responsável por atualizar autor com a instancia atual
     * @return boolean
     */
    public function atualizar()
    {

        //atualiza um autor no banco de dados
        return (new Database('authors'))->update('id = '.$this->id,[
            'name' => $this->name,
        ]);

        //sucesso
        return true;
    }

    /**
     * metodo responsável por retornar um autor com base no seu id
     * @param integer $id
     * @return Author
     */
    public static function getAuthorById($id){
        return self::getAuthor('id ='. $id)->fetchObject(self::class);
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
