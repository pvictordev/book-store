<?php

$router->get('/', 'app/views/index.view.php');

$router->get('/login', 'app/views/authentication/login.view.php');
$router->get('/register', 'app/views/authentication/register.view.php');

$router->get('/market', 'app/controllers/market.php');

$router->get('/login', 'app/controllers/authentication/login.php');
$router->post('/register', 'app/controllers/authentication/register.php');

$router->get('/signup', 'app/controllers/authentication/signup.php');
$router->post('/signup', 'app/controllers/authentication/signup.php');

$router->get('/logout', 'app/core/session.php');

$router->get('/profile', 'app/controllers/profile/profile.php');
$router->get('/profile/edit', 'app/controllers/profile/user/edit.php');
$router->put('/profile/edit', 'app/controllers/profile/user/edit.php');
$router->get('/profile/destroy', 'app/views/profile/user/destroy.view.php');
$router->delete('/destroy', 'app/controllers/profile/user/destroy.php');
