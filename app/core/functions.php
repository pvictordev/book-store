<?php

// die and dump 
function dd($data)
{
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
    die();
}

// base path
function base_path($path)
{
    return BASE_PATH . $path;
}

// redirect function
function redirect($path)
{
    header("Location: {$path}");
    exit();
}

// render the view
function view($path, $attributes = [])
{
    extract($attributes);

    require base_path('app/views/' . $path);
}

// Check if the user is authenticated
function isAuth()
{
    if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
        redirect('/signin');
    }
}

// if page does not exist, abort
function abort($code = 404)
{
    http_response_code($code);
    require base_path("app/views/errors/{$code}.php");
    die();
}
