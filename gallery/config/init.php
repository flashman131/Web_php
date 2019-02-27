<?php

session_start();
require_once('../config/connect.php');

if (!isset($_SESSION['userid'])) {
    $_SESSION['jogosulatlan'] = true;
    header('Location: ../index.php');
    die();
}
