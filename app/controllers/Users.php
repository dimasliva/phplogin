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
        if (!preg_match("/^[a-zA-Z0-9]*$/", $data['usersUid'])) {
            flash("register", "Invalid username");
            redirect("/mvc/public/pages/signup.php");
        }
        if (!filter_var($data['usersEmail'], FILTER_VALIDATE_EMAIL)) {
            flash("register", "Invalid email");
            redirect("/mvc/public/pages/signup.php");
        }
        if (strlen($data['usersPwd'] < 6)) {
            flash("register", "Invalid password");
            redirect("/mvc/public/pages/signup.php");
        } else if ($data['usersPwd'] !== $data['pwdRepeat']) {
            flash("register", "Password don't match");
            redirect("/mvc/public/pages/signup.php");
        }

        if ($this->userModel->findUserByEmailOrUsername($data['usersUid'], $data['usersEmail'])) {
            flash("register", "Username or email already taken");
            redirect("/mvc/public/pages/signup.php");
        }

        $data['usersPwd'] = password_hash($data['usersPwd'], PASSWORD_DEFAULT);

        if ($this->userModel->register($data)) {
            redirect("/mvc/public/pages/signin.php");
        } else {
            die('Something went wrong');
        }
    }

    public function login()
    {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $data = [
            'name/email' => trim($_POST['name/email']),
            'usersPwd' => trim($_POST['usersPwd'])
        ];

        if (empty($data['name/email']) || empty($data['usersPwd'])) {
            flash('login', 'Please fill out all inputs');
            redirect("/mvc/public/pages/signin.php");
            exit();
        }

        if ($this->userModel->findUserByEmailOrUsername($data['name/email'], $data['name/email'])) {
            $loggedInUser = $this->userModel->login($data['name/email'], $data['usersPwd']);
            if ($loggedInUser) {
                $this->createUserSession($loggedInUser);
            } else {
                flash('login', 'Password Incorrect');
                redirect("/mvc/public/pages/signin.php");
            }
        } else {
            flash('login', 'No user found');
            redirect("/mvc/public/pages/signin.php");
        }
    }

    public function createUserSession($user)
    {
        $_SESSION['usersId'] = $user->usersId;
        $_SESSION['usersUid'] = $user->usersUid;
        $_SESSION['usersEmail'] = $user->usersEmail;
        redirect("/mvc/index.php");
    }

    public function logout()
    {
        unset($_SESSION['usersId']);
        unset($_SESSION['usersUid']);
        unset($_SESSION['usersEmail']);
        session_destroy();
        redirect("/mvc/index.php");
    }
}

$init = new Users;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    switch ($_POST['type']) {
        case 'register':
            $init->register();
            break;
        case 'login':
            $init->login();
            break;
        default:
            redirect('/mvc/index.php');
    }
} else {
    switch ($_GET['q']) {
        case 'logout':
            $init->logout();
            break;
        default:
            redirect('/mvc/index.php');
    }
}
