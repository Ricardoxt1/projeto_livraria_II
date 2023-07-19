<?php

    require_once ("./controllers/CostumerController.php");

    $action = !empty($_GET['a']) ? ($_GET['a']) : 'getAll';

    $controller = new CostumerController();
    $controller->{$action}(); 
