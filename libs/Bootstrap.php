<?php

class Bootstrap {
    
    function __construct() {
        
        $url = isset($_GET['url']) ? $_GET['url'] : null;
        $url = rtrim($url, "/");
        $url = explode("/", $url);
        if(empty($url[0])){
            require 'controllers/products.php';
            $controller = new Products();
            $controller->edit(1);
            return false;
        }

        $file = 'controllers/' . $url[0] . ".php";
        if(file_exists($file))
        {
            require $file;
        }
        else
        {
            require 'controllers/error.php';
            $controller = new Error();
            $controller->index();
            return false;
        }
        $controller = new $url[0];
         
        //calling methods
        
        if(isset($url[3]))
        {
            if(method_exists($controller, $url[1]))
            {
                $controller->{$url[1]}($url[2],$url[3]);
            }
            else
            {
                require 'controllers/error.php';
                $controller = new Error();
            }
        }
        elseif(isset($url[2]))
        {
            if(method_exists($controller, $url[1]))
            {
                $controller->{$url[1]}($url[2]);
            }
            else
            {
                require 'controllers/error.php';
                $controller = new Error();
            }
        }
        else
        {
            if(isset($url[1]))
            {
                if(method_exists($controller, $url[1]))
                {
                    $controller->{$url[1]}();
                }
                else
                {
                    require 'controllers/error.php';
                    $controller = new Error();
                }
            }
            else
            {
                $controller->edit();
            }
        }
    }
}