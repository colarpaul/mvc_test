<?php

class Model
{
    public $dbConnection;

    /**
    * __construct
    * Make the DB Connection
    */
    public function __construct() {
        $server = "localhost";
        $user = "root";
        $password = "";
        $dbname = "mvcapp";

        $this->dbConnection = new mysqli($server, $user, $password, $dbname);

        if ($this->dbConnection->connect_error) {
            die("Connection failed: " . $this->dbConnection->connect_error);
        } 
    }

    /**
    * Method getAuthors
    * Get all authors from database and insert them into a new array
    */
    public function getAuthors() {
        $query = "SELECT * FROM authors";

        $result = $this->dbConnection->query($query);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $authors[] = $row['name'];
            }
        }

        return $authors;
    }

    /**
    * Method addAuthor
    * Insert a new author into database by a given name variable
    */
    public function addAuthor($name) {
        $query = "INSERT INTO authors (name) VALUES ('".$name."')";

        if ($this->dbConnection->query($query) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $query . "<br>" . $this->dbConnection->error;
        }
    }
}
