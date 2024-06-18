<?php

// connect to the db
class Database
{

    public $connection;

    public function __construct($config, $username = 'root', $password = '')
    {
        $dsn = 'mysql:' . http_build_query($config, '', ';'); // mysql:host=localhost;port=3306;dbname=sa-project;charset=utf8mb4

        // initialize the PDO instance
        $this->connection = new PDO($dsn, $username, $password, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
    }

    // method to execute query
    public function query($query, $params)
    {
        $statement = $this->connection->prepare($query);

        $statement->execute($params);

        return $statement;
    }

    // Method to create records in the database 
    public function store($table, $data)
    {
        $keys = implode(', ', array_keys($data));
        $values = implode(', ', array_fill(0, count($data), '?'));

        $query = "INSERT INTO $table ($keys) VALUES ($values)";

        $statement = $this->connection->prepare($query);
        $statement->execute(array_values($data));

        return $statement->rowCount();
    }

    // method to delete the record from the database
    public function destroy($table, $condition, $params)
    {
        $query = "DELETE FROM $table WHERE $condition";

        $statement = $this->connection->prepare($query);
        $statement->execute($params);

        return $statement->rowCount();
    }

    public function edit($table, $data, $condition, $params)
    {
        $setValues = '';
        foreach ($data as $key => $value) {
            $setValues .= "$key = :$key, ";
        }
        $setValues = rtrim($setValues, ', ');

        $query = "UPDATE $table SET $setValues WHERE $condition";

        $statement = $this->connection->prepare($query);

        // Bind values for SET clause
        foreach ($data as $key => $value) {
            $statement->bindValue(":$key", $value);
        }

        // Bind values for WHERE clause
        foreach ($params as $key => $value) {
            $statement->bindValue(":$key", $value);
        }

        $statement->execute();

        return $statement->rowCount();
    }
}
