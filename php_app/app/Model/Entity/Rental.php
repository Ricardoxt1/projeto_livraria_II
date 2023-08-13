<?php

namespace App\Model\Entity;

use \WilliamCosta\DatabaseManager\Database;


class Rental
{

    /**
     * id do funcionario(a)
     * @var integer
     */
    public $id;

    /**
     * data do aluguel
     * @var date
     */
    public $rental;

    /**
     * data para devolução
     * @var date
     */
    public $delivery;

    /**
     * id do usuario que realizou o aluguel
     * @var integer
     */
    public $costumer_id;

    /**
     * id do livro alugado
     * @var integer
     */
    public $book_id;

    /**
     * id do funcionario que realizou o aluguel
     * @var integer
     */
    public $employee_id;

    /**
     * método responsável por cadastrar funcionario(a) com a instancia atual
     * @return boolean
     */
    public function cadastrar()
    {

        //inseri um aluguel no banco de dados
        $this->id = (new Database('rentals'))->insert([
            'rental' => $this->rental,
            'delivery' => $this->delivery,
            'costumer_id' => $this->costumer_id,
            'book_id' => $this->book_id,
            'employee_id' => $this->employee_id,

        ]);

        //sucesso
        return true;
    }

    /**
     * método responsável por atualizar um aluguel com a instancia atual
     * @return boolean
     */
    public function atualizar()
    {

        //atualiza um consumidor no banco de dados
        return (new Database('rentals'))->update('id = ' . $this->id, [
            'rental' => $this->rental,
            'delivery' => $this->delivery,
            'costumer_id' => $this->costumer_id,
            'book_id' => $this->book_id,
            'employee_id' => $this->employee_id,
        ]);

        //sucesso
        return true;
    }

    /**
     * método responsável por deletar um aluguel no banco de dados
     * @return boolean
     */
    public function excluir()
    {
        //deletar um aluguel no banco de dados
        return (new Database('rentals'))->delete('id = ' . $this->id);
    }

    /**
     * metodo responsável por retornar um aluguel com base no seu id
     * @param integer $id
     * @return Rental
     */
    public static function getRentalById($id)
    {
        return self::getRental('id =' . $id)->fetchObject(self::class);
    }

    /**
     * @param string $where
     * @param string $order
     * @param string $limit
     * @param string $field
     * @return PDOStatement
     */
    public static function getRental($where = null, $order = null, $limit = null, $fields = '*')
    {
        return (new Database('rentals'))->select($where, $order, $limit, $fields);
    }

    /**
     * @param string $where
     * @param string $order
     * @param string $limit
     * @param integer $field
     * @return PDOStatement
     */
    public static function getRentalJoin($where = null, $order = null, $limit = null)
    {
        return (new Database('rentals'))->selectRental($where, $order, $limit);
    }
}
