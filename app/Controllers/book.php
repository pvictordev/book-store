<?php

require_once base_path('app/Controllers/BookController.php');
require_once base_path('app/Models/BookModel.php');

// get the methods in order to perform CRUD operations
$bookModel = new BookModel($db);
$controller = new BookController($db);

$book_id = intval($_POST['_delete']);

$bookID = intval($_POST['_edit']);

// delete
$controller->removeBook($book_id);

// update
$controller->editBook($bookID);
