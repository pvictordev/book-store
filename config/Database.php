<?php

require 'vendor/autoload.php'; // Load Composer's autoloader for MongoDB PHP Library

class Database
{
    public $client;
    public $db;

    public function __construct($config, $username = '', $password = '')
    {
        $dsn = "mongodb://{$config['host']}:{$config['port']}";

        $options = [];
        if ($username && $password) {
            $options['username'] = $username;
            $options['password'] = $password;
        }

        // Initialize MongoDB client
        $this->client = new MongoDB\Client($dsn, $options);
        $this->db = $this->client->{$config['dbname']}; // Select the database
    }

    // Method to execute a query
    public function query($collection, $filter = [], $options = [])
    {
        return $this->db->{$collection}->find($filter, $options);
    }

    // Method to create records in the database
    public function store($collection, $data)
    {
        $result = $this->db->{$collection}->insertOne($data);
        return $result->getInsertedCount();
    }

    // Method to delete the record from the database
    public function destroy($collection, $filter)
    {
        $result = $this->db->{$collection}->deleteOne($filter);
        return $result->getDeletedCount();
    }

    // Method to edit the record in the database
    public function edit($collection, $filter, $data)
    {
        $update = ['$set' => $data];
        $result = $this->db->{$collection}->updateOne($filter, $update);
        return $result->getModifiedCount();
    }
}
