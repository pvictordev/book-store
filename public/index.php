<?php

session_start();

// BASE_PATH
const BASE_PATH = __DIR__ . '/../';

// functions
require BASE_PATH . "app/core/functions.php";

// base path function
spl_autoload_register(function ($class) {
    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);

    require base_path("{$class}.php");
});

// database
require base_path("config/Database.php");
$config = require(base_path("config/config.php"));
$db = new Database($config['database']);

// Router
require base_path("routes/Router.php");
$router = new Router();
$routes = require base_path('routes/routes.php');
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];
$router->route($uri, $method, $db);
