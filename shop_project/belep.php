<?php
    session_start();
    require_once('config/connect.php');
    if (isset($_POST['submit'])){
        $userName = $_POST['user'];
        $pwd = $_POST['password'];
        $sql = "SELECT * FROM user WHERE username = '$userName' AND password = '$pwd'";
        $res = $conn -> query($sql);
        if ($res ->num_rows == 1) {
            //Sikeres azonosítás
            $row = $res -> fetch_row();
            $_SESSION['uid'] = $row[0];
            //die('Beléptél');
        
        } else {
            //Sikertelen azonosítás
            $_SESSION['error'] = 'Helytelen felhasználónév vagy jelszó!';
            //die("Nem létél be!");
        }
        header('Location: index.php');
    }

