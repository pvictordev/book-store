<?php

require_once base_path('app/Controllers/UserController.php');

$controller = new UserController($db);

$controller->addUser();

$credentials = $controller->getVariables();
