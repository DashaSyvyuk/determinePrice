<?php
ini_set("display_errors",1);
error_reporting(E_ALL);

require 'config/paths.php';
require 'config/database.php';

if(file_exists('db/load_db.php')){
    require 'db/load_db.php';
}

require 'libs/Bootstrap.php';
require 'libs/Controller.php';
require 'libs/Model.php';
require 'libs/View.php';
require 'libs/gChart.php';

//Library
require 'libs/Database.php';

$app = new Bootstrap();