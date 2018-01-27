<?php

class Controller {
    
    function __construct() {
        $this->view = new View();
    }
    public static function checkString($string)
    {
        $output1 = trim($string);
	$output2 = strip_tags($output1);
        return htmlspecialchars($output2, ENT_QUOTES, 'windows-1251');
    }
}
