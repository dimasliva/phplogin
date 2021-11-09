<?php

require_once '../lib/Database.php';

class ResetPassword
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function deleteEmail($email)
    {
        $this->db->query("DELETE FROM pwdreset WHERE pwdResetEmail = :email");
        $this->db->bind(":email", $email);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function insetToken($email, $selector, $token, $expires)
    {
        $this->db->query("INSERT INTO pwdreset
            (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires)
            VALUES(:email, :selector, :token, :expires)");
        $this->db->bind(':email', $email);
        $this->db->bind(':selector', $selector);
        $this->db->bind(':token', $token);
        $this->db->bind(':expires', $expires);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
