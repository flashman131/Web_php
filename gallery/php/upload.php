<?php
session_start();
require_once('../config/connect.php');

if (isset($_POST['upload']) && (isset($_SESSION['userid']))) {

    $title = $_POST['title'];
    $description = $_POST['description'];
    $userid = $_SESSION['userid'];
    $img_name = $_FILES['img']['name'];
    $file_type = $_FILES['img']['type'];

    /*
     * Engedélyezett fájltípusok
     */
    if ($file_type == "image/jpeg" || $file_type == "image/png" || $file_type == "image/jpg" && $_FILES['image']['size'] < 500000) {
        if ($_FILES['img']['error'] > 0) {

            /*
             * Hiba a feltöltés során!
             */
            echo('Hibakód: ' . $_FILES['img']['error']);
        } else {

            /*
             * Sikeres a feltöltés
             */
            $i = 1;
            $success = false;
            $new_image_name = $img_name;

            while (!$success) {
                if (file_exists("../uploads/" . $new_image_name)) {
                    $i++;
                    $new_image_name = "$i" . $img_name;
                } else {
                    $success = true;
                }
            }
            move_uploaded_file($_FILES["img"]["tmp_name"], "../uploads/" . $new_image_name);

            $sql = "INSERT INTO gallery(uid, title, description, image) VALUES (?, ?, ?, ?)";

            $stmt = $connection->prepare($sql);
            $stmt->bind_param('isss', $userid, $title, $description, $img_name);
            $stmt->execute();
        }
    } else {
        echo 'Nem engedélyezett fájl!';
    }
    $stmt->close();
    $connection->close();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>Galéria | Képek feltöltése</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css"/>
        <script src="../js/jquery-3.3.1.min.js" type="text/javascript"></script>
        <script src="../js/bootstrap.min.js" type="text/javascript"></script>
        <link rel="icon" href="../img/gallery.png" type="image/x-icon"/>
    </head>
    <body>
        <nav class="navbar navbar-expand">
            <ul class="navbar">
                <p class="nav-item">
                    <a href="upload.php" class="nav-link">Kép feltöltése</a>
                    <?php
                    if (isset($_SESSION['userid'])) {
                        echo '<a href="logout.php" class="nav-link">Kilépés</a>'
                        . '</p>';
                    }
                    ?>
            </ul>
        </nav>
        <form enctype="multipart/form-data" action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="form-group">
                <input class="form-control" type="text" placeholder="Cím" name="title" required />
            </div>
            <div class="form-group">
                <input class="form-control" type="text" placeholder="Leírás" name="description" required />
            </div>
            <div class="form-group">
                <input class="form-control" type="file" name="img" required />
            </div>
            <div>
                <input class="btn btn-primary" type="submit" value="Feltölt" name="upload" />
            </div>
        </form>
    </body>
</html>
