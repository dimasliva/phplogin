<?php

use PHPMailer\PHPMailer\PHPMailer;

require_once '../models/ResetPassword.php';
require_once '../helpers/session_helper.php';
require_once '../models/User.php';
// Require PHP Mailer
require_once '../PHPMailer/src/PHPMailer.php';
require_once '../PHPMailer/src/Exception.php';
require_once '../PHPMailer/src/SMTP.php';

class ResetPasswords
{
    private $resetModel;
    private $userModel;
    private $mail;

    public function __construct()
    {
        $this->resetModel = new ResetPassword;
        $this->userModel = new User;

        $this->mail = new PHPMailer();
        $this->mail->isSMTP();
        $this->mail->Host = 'smtp.mailtrap.io';
        $this->mail->SMTPAuth = true;
        $this->mail->Port = 2525;
        $this->mail->Username = 'c793348687d382';
        $this->mail->Password = '43d49c9f388a54';
    }

    public function sendMail()
    {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $usersEmail = trim($_POST['usersEmail']);

        if (empty($usersEmail)) {
            flash('reset', 'Please input email');
            redirect("/mvc/public/pages/rest-password.php");
        }

        if (!filter_var($usersEmail, FILTER_VALIDATE_EMAIL)) {
            flash('reset', 'Invalid email');
            redirect("/mvc/public/pages/rest-password.php");
        }

        $selector = bin2hex(random_bytes(8));
        $token = random_bytes(32);
        $url = 'http://localhost/mvc/public/pages/create-new-password.php?selector='
            . $selector . '&validator=' . bin2hex($token);
        $expires = date("U") + 1800;

        if (!$this->resetModel->deleteEmail($usersEmail)) {
            die("There was an error");
        }

        $hashToken = password_hash($token, PASSWORD_DEFAULT);
        if (!$this->resetModel->insetToken($usersEmail, $selector, $token, $expires)) {
            die("There was an error");
        }

        $subject = "Reset password";
        $message = "<p>Here is your password reset link</p>";
        $message .= '<a href="' . $url . '">' . $url . '</a>';

        $this->mail->setFrom("Dmitry@gmail.com");
        $this->mail->isHTML(true);
        $this->mail->Subject = $subject;
        $this->mail->Body = $message;
        $this->mail->addAddress($usersEmail);

        $this->mail->send();

        flash("rest", "Check your email", "alert alert-success");
        redirect("/mvc/public/pages/rest-password.php");
    }
}

$init = new ResetPasswords;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    switch ($_POST['type']) {
        case 'send':
            $init->sendMail();
            break;
    }
} else {
    redirect('/mvc/index.php');
}
