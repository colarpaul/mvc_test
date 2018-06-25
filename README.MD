Autorenliste:


Das Programm listet Autoren auf. Durch einen Link kann man einen Autor zu dieser Liste hinzufügen.



Testaufgabe:


1. Im Quelltext sind Fehler, um die Aufgabe zum laufen zu bringen müssen diese korrigiert werden.


2. Die Autoren werden momentan statisch auf der Seite angezeigt. 
Auch ist die add-Methode im Controller nicht ideal.
    
Dieses soll durch ein Formular und eine SQLite-Datenbank ersetzt werden, so dass die Autoren dynamisch hinzugefügt werden können.
    


3. Die View-Klasse beinhaltet momentan HTML in ihrer output-Methode. 
Dieses soll durch Templating ersetzt werden.
    
Dazu soll ein order "templates" eingeführt werden, in dem sich pro Controller-Action ein Template befindet.
        
- In diesen Dateien im Ordner "template" dürfen sich keine Klassen befinden
        
- Es sind nur die Kurzschreibweisen der Kontrollstrukturen erlaubt:
            
Beispiel:
                
<?php foreach ($authors as $author): ?>
                    
Author: <?php echo $author ?>
                
<?php endforeach ?>


[Controller.PHP]
```
<?php
include_once('Model.php');

class controller
{
	public $model;

	/**
	* __construct
	* Include Model Class
    */
    public function __construct() {
    	$this->model = new Model();
    }

	/**
	* Method addAuthor
	* Call method getAuthors from Model and render View template
    */
    public function getAuthors(){
        // Get authors from database
        $authors = $this->model->getAuthors();
    
        // Render the view template where is the add-form and authors table included
        include_once('View.php');
    }

    /**
	* Method addAuthor
	* Call method addAuthor from Model
    */
    public function addAuthor($name){
    	return $this->model->addAuthor($name);
    }
}
```

[Model.PHP]
```
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
```

[index.PHP]
```
<?php
// Include Controller
include_once('Controller.php');
$controller = new Controller();

// If add-form is called add a new author to DB
if (isset($_GET['name']) && !empty($_GET['name'])) {
    $controller->addAuthor($_GET['name']);
}

// Render View template
$controller->getAuthors(
```

[View.PHP]
```
<html>
<head>
    <title>MVC App</title>
</head>
<body>
    <form action="index.php" method="GET">
        Name: <input type="text" placeholder="Author name" name="name"><button type="submit">Add</button>
    </form>
    <table border="1">
        <?php if(isset($authors) && !empty($authors)) { ?>
            <?php foreach($authors as $author): ?>
                <tr>
                    <td>
                        <?php echo $author; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php } else { ?>
            <tr>
                <td>No records found!</td>
            </tr>
        <?php } ?>
    </table>
</body>
<footer></footer>
</html>);
```


