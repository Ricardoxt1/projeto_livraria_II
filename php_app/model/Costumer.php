<?php

    require_once ('../configuration/Connect.php');

    class CostumerModel extends Connect
    {
        private $table;

        function __construct()
        {
            parent::__construct();
            $this->table = 'costumers';
        }

        function getAll()
        {
            $sqlSelect = $this->connection->query("SELECT * FROM $this->table");
            $resultQuery = $sqlSelect->fetchAll();
            return $resultQuery;
        }
    }
?>
