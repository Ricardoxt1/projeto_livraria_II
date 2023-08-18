<?php

namespace App\Model\Entity;

use \WilliamCosta\DatabaseManager\Database;

class Book
{
    /**
     * id do livro
     * @var integer
     */
    public int $id;

    /**
     * titulo do livro
     * @var string
     */
    public string $titule;

    /**
     * pagina do livro
     * @var string
     */
    public string $page;

    /**
     * data de lançamento do livro
     * @var string
     */
    public string $realese_date;

    /** 
     * id do autor
     * @var string
     */
    public string $author_id;

    /**
     * id da livraria
     * @var string
     */
    public string $library_id;

    /**
     * id da editora
     * @var string
     */
    public string $publisher_id;

    /**
     * método responsável por cadastrar livro com a instancia atual
     * @return boolean
     */
    public function register(): bool
    {
        //inseri um livro no banco de dados
        $this->id = (new Database('books'))->insert([
            'titule' => $this->titule,
            'page' => $this->page,
            'realese_date' => $this->realese_date,
            'author_id' => $this->author_id,
            'library_id' => $this->library_id,
            'publisher_id' => $this->publisher_id
        ]);

        //sucesso
        return true;
    }


    /**
     * método responsável por atualizar um livro com a instancia atual
     * @return boolean
     */
    public function update(): bool
    {

        //atualiza um livro no banco de dados
        return (new Database('books'))->update('id = ' . $this->id, [
            'titule' => $this->titule,
            'page' => $this->page,
            'realese_date' => $this->realese_date,
            'author_id' => $this->author_id,
            'library_id' => $this->library_id,
            'publisher_id' => $this->publisher_id
        ]);

        //sucesso
        return true;
    }

    /**
     * método responsável por deletar um livro no banco de dados
     * @return boolean
     */
    public function delete(): bool
    {
        //deletar um livro no banco de dados
        return (new Database('books'))->delete('id = ' . $this->id);
    }


    /**
     * metodo responsável por retornar um livro com base no seu id
     * @param integer $id
     * @return Book
     */
    public static function getBookById(int $id): Book
    {
        return self::getBook('id =' . $id)->fetchObject(self::class);
    }

    /**
     * @param string $where
     * @param string $order
     * @param string $limit
     * @param string $field
     * @return PDOStatement
     */
    public static function getBook(string $where = null, string $order = null, string $limit = null, string $fields = '*')
    {
        return (new Database('books'))->select($where, $order, $limit, $fields);
    }

    /**
     * @param string $where
     * @param string $order
     * @param string $limit
     * @return PDOStatement
     */
    public static function getBookJoin(string $where = null, string $order = null, string $limit = null)
    {
        return (new Database('books'))->selectBook($where, $order, $limit);
    }
}
