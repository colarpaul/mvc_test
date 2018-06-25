<?php 

// Include Controller
include_once('Controller.php');
$controller = new Controller();

// If add-form is called add a new author to DB
if (isset($_GET['name']) && !empty($_GET['name'])) {
    $controller->addAuthor($_GET['name']);
}

// Render View template
$controller->getAuthors();

