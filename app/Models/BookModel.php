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
        $query = "SELECT * FROM books WHERE BookID = :book_id";

        $userStatement = $this->db->query($query, [
            'book_id' => $book_id,
        ]);
        return $userStatement->fetch();
    }

    public function addBook($title, $author_id, $price, $stock)
    {
        $table = "books";

        $data = [
            'Title' => $title,
            'AuthorID' => $author_id,
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
            'book_id' => $book_id
        ];

        return $this->db->destroy($table, $condition, $params);
    }

    public function editBook($BookID, $title, $author_id, $price, $stock)
    {
        $table = 'books';
        $data = [
            'Title' => $title,
            'AuthorID' => $author_id,
            'Price' => $price,
            'Stock' => $stock,
        ];

        $condition = 'BookID = :BookID';
        $params = [
            'BookID' => $BookID
        ];

        // Update user data in the database
        return $this->db->edit($table, $data, $condition, $params);
    }
}
