<?php
// Sign in
function emptyInput($name, $uid, $email, $pwd, $repeatpwd)
{
    $result = false;
    if (empty($name) && empty($uid) && empty($email) && empty($pwd) && empty($repeatpwd)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function emptyName($name)
{
    $result = true;
    if (empty($name)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}
function invalidUid($uid)
{
    $result = true;
    if (!preg_match('/^[a-zA-Z0-9]*$/', $uid)) {
        $result = true;
    } else if (empty($uid)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}
function invalidEmail($email)
{
    $result = true;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    } else if (empty($email)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}
function emptyPwd($pwd)
{
    $result = true;
    if (empty($pwd)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}
function pwdMatch($pwd, $repeatpwd)
{
    $result = true;
    if ($pwd !== $repeatpwd) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}
function uidExists($conn, $uid)
{
    $sql = "SELECT * FROM users WHERE usersUid = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header('location: ../signup.php?error=stmtfailed');
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, 's', $uid);
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($resultData)) {
            return $row;
        } else {
            $result = false;
            return $result;
        }
        mysqli_stmt_close($stmt);
    }
}
function emailExists($conn, $email)
{
    $sql = "SELECT * FROM users WHERE usersEmail = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header('location: ../signup.php?error=stmtfailed');
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, 's', $email);
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($resultData)) {
            return $row;
        } else {
            $result = false;
            return $result;
        }
        mysqli_stmt_close($stmt);
    }
}
function createUser($conn, $name, $email, $uid, $pwd)
{
    $sql = "INSERT INTO users(usersName, usersEmail, usersUid, usersPwd)
            VALUES(?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header('location: ../signup.php?error=stmtfailed');
        exit();
    }
    $hashPassword = password_hash($pwd, PASSWORD_DEFAULT);
    mysqli_stmt_bind_param($stmt, 'ssss', $name, $email, $uid, $hashPassword);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);
    header('location: ../signup.php?error=none');
    exit();
}
// Login
function emptyInputLogin($username, $pwd)
{
    $result = true;
    if (empty($username) || empty($pwd)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}
