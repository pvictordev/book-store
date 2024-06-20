<?php

require_once base_path('app/models/BookModel.php');

class BookController
{
    private $bookModel;

    public function __construct($db)
    {
        $this->bookModel = new BookModel($db);
    }

    public function addBook()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if (isset($_POST['_create'])) {

                $title = $_POST['title'];
                $author_id = intval($_POST['author_id']);
                $price = floatval($_POST['price']);
                $stock = intval($_POST['stock']);

                $result = $this->bookModel->addBook($title, $author_id, $price, $stock);
                if ($result) {
                    // book added successfully
                    redirect('/books');
                } else {
                    // book added failed
                    dd('book added failed.');
                }
            }
        }
    }


    public function editBook($BookID)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['_edit'])) {
                $BookID = intval($_POST['_edit']);
                $title = $_POST['title'];
                $author_id = intval($_POST['author_id']);
                $price = floatval($_POST['price']);
                $stock = intval($_POST['stock']);

                // edit the a particular book
                $this->bookModel->editBook($BookID, $title, $author_id, $price, $stock);

                // Redirect to books page
                redirect('/books');
            }
        }
    }

    public function removeBook($book_id)
    {
        if (isset($_POST['_delete'])) {

            $result =  $this->bookModel->destroyBook($book_id);

            if ($result) {
                redirect("/books");
            } else {
                dd('book remove failed.');
            }
        }
    }
}
