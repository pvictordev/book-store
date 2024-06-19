<?php

// log in 
$router->get('/', 'app/views/authentication/login.view.php');
$router->post('/login', 'app/Controllers/authentication/login.php');

$router->get('/profile', 'app/Controllers/profile.php');

// register
$router->get('/register', 'app/views/authentication/register.view.php');
$router->post('/register', 'app/Controllers/authentication/RegisterController.php');

$router->get('/books', 'app/views/books.view.php');
$router->get('/authors', 'app/views/authors.view.php');
$router->get('/orders', 'app/views/authors.view.php');
$router->get('/orders/details', 'app/views/details.view.php');
