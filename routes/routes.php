<?php

// log in 
$router->get('/', 'app/views/authentication/login.view.php');
$router->post('/login', 'app/Controllers/authentication/login.php');
// log out
$router->get('/logout', 'app/Controllers/authentication/logout.php');

// register
$router->get('/register', 'app/views/authentication/register.view.php');
$router->post('/register', 'app/Controllers/authentication/register.php');

$router->get('/profile', 'app/Controllers/profile.php');

// create
$router->get('/books/create', 'app/views/books/create.view.php');
$router->post('/books/create', 'app/Controllers/book.php');
// read
$router->get('/books', 'app/views/books/books.view.php');
// update
$router->get('/books/edit', 'app/views/books/edit.view.php');
$router->post('/books/edit', 'app/Controllers/book.php');
// delete
$router->post('/books/delete', 'app/Controllers/book.php');


$router->get('/authors', 'app/views/authors.view.php');
$router->get('/orders', 'app/views/authors.view.php');
$router->get('/orders/details', 'app/views/details.view.php');
