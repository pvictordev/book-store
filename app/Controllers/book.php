<?php

require_once base_path('app/Controllers/BookController.php');
require_once base_path('app/Models/BookModel.php');

// get the methods in order to perform CRUD operations
$bookModel = new BookModel($db);
$controller = new BookController($db);

$delete = $_POST['_delete'] ?? '';

$edit = $_POST['_edit'] ?? '';

// create
$controller->addBook();

// delete
$controller->removeBook($delete);

// update
$controller->editBook($edit);
