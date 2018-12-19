<?php
    session_start();
    if (isset($_SESSION['uid'])){
        $menu = file_get_contents("html/nav_in.html");
    } else {
        $menu = file_get_contents("html/nav_out.html");
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" type="text/css" href="css/shop.css" >
    </head>
    <body>
        <div id="content">
            <nav>
               <?php
                echo $menu;
               ?>
            </nav>
            
        </div>
        
        
        <?php
        // put your code here
        ?>
    </body>
</html>
