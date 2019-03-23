<?php
$host = "localhost";
$user = "esti_szoftverf";
$pwd = "esti_szoftverf";
$dbName = "esti_allaskozvetito";

$conn = new mysqli($host, $user, $pwd, $dbName);

if ($conn -> connect_errno){
    die("Hiba kapcsolódás során!");
    
}
$conn -> set_charset("utf8");