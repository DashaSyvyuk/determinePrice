<?php 
$root = DB_USER; 
$root_password = DB_PASS; 
$host = DB_HOST;

$user = DB_USER;
$pass = DB_PASS;
$db = DB_NAME; 

try {
    $dbh = new PDO("mysql:host=$host", $root, $root_password);

    $dbh->exec("CREATE DATABASE IF NOT EXISTS `$db` DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci;
            CREATE USER '$user'@'localhost' IDENTIFIED BY '$pass';
            GRANT ALL ON `$db`.* TO '$user'@'localhost';
            FLUSH PRIVILEGES;") 
    or die(print_r($db->errorInfo(), true));
} catch (PDOException $e) {
    die("DB ERROR: ". $e->getMessage());
}
$dbn = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME . ";charset=utf8", DB_USER, DB_PASS);
$dbn->exec("'SET NAMES cp1251");
if(file_exists("db/determinePrice.txt")){
    $text = file_get_contents("db/determinePrice.txt");
    $query = explode(";", $text);
    foreach ($query as $value) {
        if(!empty($value)){
            $dbn->exec($value);
        }
    }
    unlink("db/determinePrice.txt");
}
