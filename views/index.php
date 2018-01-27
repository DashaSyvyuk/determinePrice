<?php header("Content-type: text/html; charset=utf-8"); ?>
<html>
    <?php require 'views/head.php';?>
    <body>
        <div id="content">
            <?php require 'views/header.php';?>
            <?php require 'views/' . $name . '.php';?>
        </div>
    </body>
</html>
