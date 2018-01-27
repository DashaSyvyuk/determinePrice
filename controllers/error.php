<?php

class Error extends Controller{

    function __construct() {
        parent::__construct();
        require 'models/error_model.php';
        
        $this->model = new Error_Model();
        $this->view->msg = "This page doesn't exists";
    }
    function index(){
        $this->view->render('error/index');
    }
}

