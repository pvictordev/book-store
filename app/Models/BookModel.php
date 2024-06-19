<?php

class BookModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getBooks()
    {
        $query = "SELECT * FROM books";
        $usersStatement = $this->db->query($query, []);
        return $usersStatement->fetchAll();
    }

    public function getBook($book_id)
    {
        $query = "SELECT * FROM users WHERE BookID = :book_id";

        $userStatement = $this->db->query($query, [
            'book_id' => $book_id,
        ]);
        return $userStatement->fetch();
    }

    public function addBook($title, $author_id, $price, $stock)
    {
        $table = "users";

        $data = [
            'Title' => $title,
            'Author' => $author_id,
            'Price' => $price,
            'Stock' => $stock
        ];

        return $this->db->store($table, $data);
    }

    public function destroyBook($book_id)
    {
        $table = 'books';
        $condition = 'BookID = :book_id';
        $params =  [
            'BookID' => $book_id
        ];

        return $this->db->destroy($table, $condition, $params);
    }

    public function editBook($user, $formData)
    {

        $data = [
            'Title' => $formData['title'],
            'AuthorID' => $formData['author_id'],
            'Price' => $formData['price'],
            'Stock' => $formData['Stock'],
        ];

        $table = 'users';
        $condition = 'UserID = :UserID';
        $params = ['UserID' => $user['UserID']];

        // Update user data in the database
        return $this->db->edit($table, $data, $condition, $params);
    }
}
