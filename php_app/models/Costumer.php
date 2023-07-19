<?php
    
    require_once ("./configuration/Connect.php");

    class Costumer extends Connect
    {
        private $table;

        function __construct()
        {
            parent::__construct();
            $this->table = "costumers";
        }

        public function getAll()
        {
            $sqlSelect = $this->connection->query("SELECT * FROM $this->table");
            $resultQuery = $sqlSelect->fetchAll();
            return $resultQuery;
        }
    }
?>
