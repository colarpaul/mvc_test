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
