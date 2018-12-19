<?php
    session_start();
    require_once('config/connect.php');
    require_once('config/functions.php');
    if (isset($_SESSION['uid'])){
        $menu = file_get_contents("html/nav_in.html");
    } else {
        $menu = file_get_contents("html/nav_out.html");
    }
    $sql = "SELECT * FROM termekek;";
    $res = $conn -> query($sql);
    $numRows = $res -> num_rows;
    
    if (isset($_GET['termekszam'])){
        //megjelenítendő sorok száma
        $tszam = $_GET['termekszam'];
    } else {
        $tszam = 25;
    }
    
        
    if (isset($_GET['page'])){
        // lapoz a látogató
        $page = ($_GET['page'] - 1) * $tszam;
    } else {
        //alapértelmezett
        $page = 0;
    }
    
    $sql = "SELECT * FROM termekek LIMIT $page,$tszam;";
    
    $res = $conn -> query($sql);
                                                
    if ($res){
        $tabla = "<table id='products'>"
                . "<tr>"
                . "<td>ID</td>"
                . "<td>Megnevezés</td>"
                . "<td>Feszültség</td>"
                . "<td>Teljesítmény</td>"
                . "<td>Foglalat</td>"
                . "<td>Élettartam</td>"
                . "<td>Ár</td>"
                . "</tr>";
        while ($row = $res -> fetch_assoc()){
            $tabla .= "<tr>"
            . "<td>".$row['tazon']."</td>"
            . "<td>{$row['tnev']}</td>"
            . "<td>{$row['fesz']}</td>"
            . "<td>{$row['telj']}</td>"
            . "<td>{$row['foglalat']}</td>"
            . "<td>{$row['elettartam']}</td>"
            . "<td>{$row['ar']}</td>"
            . "</tr>";
        }
        $tabla .= "</table>";
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
                echo $menu; //menü megjelenítése
                
               ?>
            </nav>
            <?php
                $pages = ceil($numRows / $tszam); //oldalak száma
                
                $sql = "SELECT DISTINCT foglalat FROM termekek";
                $res = $conn -> query($sql);
                if ($res){
                    $urlap = "<form method='get' action='termekek.php'>"
                            . "termekszam";   
                    
                    $urlap .="<select name='foglalat'>";
                    while ($row = $res -> fetch_row()){
                        $urlap .="<option>{$row[0]}</option>";
                        
                    }
                    $urlap .= "</select>"
                            . "<input type='submit' value='Szűrés' name='szures'>"
                            . "</form>";
                }
                $oldalak = "";
                for ($i = 1; $i <= $pages; $i++){
                    $oldalak .= "<a href='termekek.php?page={$i}&termekszam={$tszam}'>{$i}</a>";
                }
                echo "<div id='szures' >";
                $termekszam = file_get_contents('html/termekszam.html');
                $urlap = str_replace('termekszam',$termekszam,$urlap);
                echo $urlap;
                echo $oldalak;
                echo "</div>";
                echo $tabla;  
                
            ?>
            
        </div>
        
        
        
    </body>
</html>
