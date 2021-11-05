<?php

require_once "../models/User.php";
require_once "../helpers/session_helper.php";

class Users
{
    private $userModel;
    public function __construct()
    {
        $this->userModel = new User;
    }

    public function register()
    {

        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        // Init data
        $data = [
            'usersName' => trim($_POST['usersName']),
            'usersEmail' => trim($_POST['usersEmail']),
            'usersUid' => trim($_POST['usersUid']),
            'usersPwd' => trim($_POST['usersPwd']),
            'pwdRepeat' => trim($_POST['pwdRepeat'])
        ];

        // Validate input
        if (
            empty($data['usersName']) || empty($data['usersEmail']) || empty($data['usersUid'])
            || empty($data['usersPwd']) || empty($data['pwdRepeat'])
        ) {
            flash("register", "Please fill out all inputs");
            redirect("/mvc/public/pages/signup.php");
        }
    }
}

$init = new Users;
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    switch ($_POST['type']) {
        case 'register':
            $init->register();
            break;
    }
}
