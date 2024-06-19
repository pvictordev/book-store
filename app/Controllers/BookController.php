<?php

require_once base_path('app/models/BookModel.php');

class UserController
{
    private $bookModel;

    public function __construct($db)
    {
        $this->bookModel = new BookModel($db);
    }

    public function addBook()
    {

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if (isset($_POST['add_user'])) {

                $title = '';
                $author_id = '';
                $price = '';
                $stock = '';

                $result = $this->userModel->addUser($title, $author_id, $price, $stock);
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


    public function editBook($book_id)
    {
        // get the particular book
        $book = $this->bookModel->getBook($book_id);

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $title = '';
            $author_id = '';
            $price = '';
            $stock = '';

            $data = [
                'Title' => $title = '',
                'AuthorID' => $author_id = '',
                'Price' => $price,
                'Stock' => $stock,
            ];
            $user = '';

            // edit the a particular book
            $this->bookModel->editBook($data, $user);

            // Redirect to books page
            redirect('/books');
        }
    }

    public function removeBook($book_id)
    {
        if (isset($_POST['_method'])) {

            $result =  $this->bookModel->destroyBook($book_id);

            if ($result) {
                session_unset();
                session_destroy();
                redirect("/books");
            } else {
                dd('book remove failed.');
            }
        }
    }
}
