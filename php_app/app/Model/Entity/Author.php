<?php

namespace App\Model\Entity;

use PDOStatement;
use \WilliamCosta\DatabaseManager\Database;

class Author
{

    /**
     * id do autor
     * @var integer
     */
    public int $id;

    /**
     * nome do autor
     * @var string
     */
    public string $name;


    /**
     * método responsável por cadastrar autor com a instancia atual
     * @return boolean
     */
    public function register(): bool
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
    public function update(): bool
    {

        //atualiza um autor no banco de dados
        return (new Database('authors'))->update('id = ' . $this->id, [
            'name' => $this->name,
        ]);

        //sucesso
        return true;
    }

    /**
     * método responsável por deletar um autor no banco de dados
     * @return boolean
     */
    public function delete(): bool
    {
        //deletar um autor no banco de dados
        return (new Database('authors'))->delete('id = ' . $this->id);

        return true;
    }

    /**
     * metodo responsável por retornar um autor com base no seu id
     * @param integer $id
     * @return Author
     */
    public static function getAuthorById(int $id): Author
    {
        return self::getAuthor('id =' . $id)->fetchObject(self::class);
    }

    /**
     * @param string $where
     * @param string $order
     * @param string $limit
     * @param string $field
     * @return PDOStatement
     */
    public static function getAuthor(string $where = null, string $order = null, string $limit = null, string $fields = '*')
    {
        return (new Database('authors'))->select($where, $order, $limit, $fields);
    }
}
