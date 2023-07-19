<?php

    require_once ('../../model/Costumer.php');

    class costumerController
    {
        private $model;

        function __construct()
        {
            $this->model = new CostumerModel();
        }

        function getAll()
        {
            $resultData = $this->model->getAll();
            print_r($resultData);
        }
    }
?>
