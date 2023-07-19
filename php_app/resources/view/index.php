<?php

    require_once ('../../controller/costumerController.php');

    $action = !empty($_GET['a']) ? $_GET['a'] : 'getAll';

    $controller = new costumerController();
    $controller->{$action}();
?>


