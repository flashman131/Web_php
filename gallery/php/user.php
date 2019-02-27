<?php
session_start();
require_once('../config/connect.php');

if (isset($_POST['enter'])) {

    $email = $_POST['email'];
    $pwd = $_POST['pwd'];

    $sql = "SELECT * FROM user WHERE email = ? AND password = ?;";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ss", $email, $pwd);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {

        /*
         * Sikeres bejelentkezés
         */
        $stmt->bind_result($id, $email, $pwd, $firstname, $lastname);
        $stmt->fetch();
        $_SESSION['userid'] = $id;
    } else {

        /*
         * Érvénytelen email cím vagy jelszó
         */
        header('Location: ../index.php');
    }
}
?>
<!DOCTYPE html>
<html lang="hu">
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
        <?php echo "<h3>{$lastname} {$firstname} névvel jelentkezett be.</h3>"; ?>
    </body>
</html>
<?php
$stmt->close();
$connection->close();
?>
