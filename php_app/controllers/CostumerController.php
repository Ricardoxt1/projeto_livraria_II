<?php

require_once("./models/Costumer.php");

class CostumerController
{
    private $model;

    function __construct()
    {
        $this->model = new Costumer();
    }

    function getAll()
    {
        $resultData = $this->model->getAll();
        require_once("./views/pages/list/listCostumers.php");
    }
}
