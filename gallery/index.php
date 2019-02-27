<?php session_start(); ?>
<!DOCTYPE html>
<html lang="hu">
    <head>
        <title>Galéria</title>
        <meta charset="utf-8"/>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
        <script src="js/jquery-3.3.1.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <link rel="icon" href="./img/gallery.png" type="image/x-icon"/>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-4">
                    <form action="php/user.php" method="post">
                        <input class="form-control" type="email" placeholder="E-mail" name="email" required/>
                        <input class="form-control" type="password" placeholder="Jelszó" name="pwd" required/>
                        <input class="btn btn-primary" type="submit" name="enter" value="Belépés"/>
                    </form>
                </div>
            </div>
            <?php
            if (isset($_SESSION['jogosulatlan']) && $_SESSION['jogosulatlan']) {
                $error = file_get_contents('html/error.html');
                echo $error;
                unset($_SESSION['jogosulatlan']);
            }
            ?>
        </div>
    </body>
</html>
