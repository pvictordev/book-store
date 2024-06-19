<?php

require_once base_path('app/Controllers/UserController.php');

$controller = new UserController($db);

$controller->signin();
