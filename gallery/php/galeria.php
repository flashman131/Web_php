<?php
require_once('../config/init.php');

$uid = $_SESSION['userid'];
$sql = "SELECT * FROM gallery WHERE uid = ?;";

$stmt = $connection->prepare($sql);
$stmt->bind_param('i', $uid);
$stmt->execute();
$stmt->bind_result($id, $uid, $title, $description, $img);
$kepek = "<div class='row>";
while ($stmt->fetch()) {
    $kepek .= "<div class='col-3'>"
            . "<img class='img-thumbnail' src='../uploads/{$img}'/>"
            . "</div>";
}
$kepek .= '</div>';
$stmt -> close();
$connection->close();
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
                    <a href="galeria.php" class="nav-link">Képek megtekintése</a>
                    <a href="upload.php" class="nav-link">Kép feltöltése</a>
                    <?php
                    if (isset($_SESSION['userid'])) {
                        echo '<a href="logout.php" class="nav-link">Kilépés</a>';
                    }
                    ?>
                </p>
            </ul>
        </nav>
        <div class="container-fluid">
            <?php echo $kepek; ?>
        </div>
    </body>
</html>
