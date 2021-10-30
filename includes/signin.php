<?php
if (isset($_POST['submit'])) {
    print_r($_POST);
} else {
    header('location: ../signup.php');
}
