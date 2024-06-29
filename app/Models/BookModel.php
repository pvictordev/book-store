<?php

use MongoDB\BSON\ObjectId;

class BookModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getBooks()
    {
        $collection = $this->db->query('books');

        $books = $collection->toArray();

        return $books;
    }

    public function getBook($book_id)
    {
        $objectId = new ObjectId($book_id); // Convert string to ObjectId
        $cursor = $this->db->query('books', ['_id' => $objectId]);
        $book = $cursor->toArray();
        return !empty($book) ? $book[0] : null;
    }

    public function addBook($title, $author_id, $price, $stock)
    {
        $collection = "books";

        $data = [
            'title' => $title,
            'authorId' => $author_id,
            'price' => $price,
            'stock' => $stock
        ];

        return $this->db->store($collection, $data);
    }

    public function destroyBook($book_id)
    {
        // this Class has a squigly lines from the intelephense
        $objectId = new ObjectId($book_id); // Convert string to ObjectId
        return $this->db->destroy('books', ['_id' => $objectId]);
    }

    public function editBook($book_id, $title, $author_id, $price, $stock)
    {
        $objectId = new ObjectId($book_id); // Convert string to ObjectId

        $data = [
            'title' => $title,
            'authorId' => $author_id,
            'price' => $price,
            'stock' => $stock
        ];
        return $this->db->edit('books', ['_id' => $objectId], $data);
    }
}
