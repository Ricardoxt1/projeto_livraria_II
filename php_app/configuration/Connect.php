<?php

    define('HOST', 'mysql');
    define('DATABASENAME', 'library');
    define('USER', 'root');
    define('PASSWORD', 'root');

    class Connect
    {
        protected $connection;

        function __construct()
        {
            $this->connectDatabase();
        }

        function connectDatabase()
        {
            try {
                $this->connection = new PDO('mysql:host='.HOST.';dbname='.DATABASENAME, USER, PASSWORD);
            } catch (PDOException $e) {
                echo $e->getMessage();
                die();
            }
        }

    }
?>
