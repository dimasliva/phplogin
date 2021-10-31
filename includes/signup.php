<?php
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $uid = $_POST['username'];
    $pwd = $_POST['pwd'];
    $pwdrepeat = $_POST['pwdrepeat'];
    require_once "./db.php";
    require_once "./functions.php";
    if (emptyInput($name, $uid, $email, $pwd, $pwdrepeat) !== false) {
        header('location: ../signup.php?error=emptyinput');
        exit();
    }
    if (emptyName($name) !== false) {
        header('location: ../signup.php?error=emptyname');
        exit();
    }
    if (invalidUid($uid) !== false) {
        header('location: ../signup.php?error=emptyuid');
        exit();
    }
    if (invalidEmail($email) !== false) {
        header('location: ../signup.php?error=emptyemail');
        exit();
    }
    if (emptyPwd($pwd) !== false) {
        header('location: ../signup.php?error=emptypwd');
        exit();
    }
    if (pwdMatch($pwd, $pwdrepeat) !== false) {
        header('location: ../signup.php?error=pwdmatch');
        exit();
    }
    if (uidExists($conn, $uid) !== false) {
        header('location: ../signup.php?error=usernametaken');
        exit();
    }
    if (emailExists($conn, $email) !== false) {
        header('location: ../signup.php?error=emailtaken');
        exit();
    }
    createUser($conn, $name, $email, $uid, $pwd);
} else {
    header('location: ../signup.php');
}
