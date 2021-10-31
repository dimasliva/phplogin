<?php
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $pwd = $_POST['pwd'];
    require_once "./db.php";
    require_once "functions.php";
    if (empty($username) || empty($pwd) !== false) {
    }
} else {
    header('location: ../signup.php');
}
