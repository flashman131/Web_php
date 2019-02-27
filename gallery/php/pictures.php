<?php
require_once('../config/connect.php');
session_start();

if (isset($_SESSION['userid'])) {

    $sql = "SELECT * FROM gallery;";
    $fileContent = file_get_contents($_FILES['upload_file']['tmp_name']);
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>Galéria</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css"/>
        <script src="../js/jquery-3.3.1.min.js" type="text/javascript"></script>
        <script src="../js/bootstrap.min.js" type="text/javascript"></script>
        <link rel="icon" href="../img/gallery.png" type="image/x-icon"/>
    </head>
    <body>
        <nav class="navbar navbar-expand">
            <ul class="navbar">
                <p class="nav-item">
                    <a href="pictures.php" class="nav-link">Képek megtekintése</a>
                    <a href="upload.php" class="nav-link">Kép feltöltése</a>
                    <?php
                    if (isset($_SESSION['userid'])) {
                        echo '<a href="logout.php" class="nav-link">Kilépés</a>';
                    }
                    ?>
                </p>
            </ul>
        </nav>
        <div class="container"></div>
    </body>
</html>
<?php
$stmt->close();
?>
