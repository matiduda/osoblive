<?php

class SignupContr extends Signup
{
    private $name;
    private $email;
    private $username;
    private $pwd;
    private $pwdRepeat;

    public function __construct($name, $email, $username, $pwd, $pwdRepeat)
    {
        $this->name = $name;
        $this->email = $email;
        $this->username = $username;
        $this->pwd = $pwd;
        $this->pwdRepeat = $pwdRepeat;
    }

    public function signupUser()
    {
        if ($this->emptyInput() !== false) {
            header("location: ../signup.php?error=emptyinput");
            exit();
        }

        if ($this->invalidUid() !== false) {
            header("location: ../signup.php?error=invaliduid");
            exit();
        }

        if ($this->invalidEmail() !== false) {
            header("location: ../signup.php?error=invalidemail");
            exit();
        }

        if ($this->pwdNotMatch() !== false) {
            header("location: ../signup.php?error=passwordsdontmatch");
            exit();
        }

        if ($this->uidTakenCheck() !== false) {
            header("location: ../signup.php?error=usernametaken");
            exit();
        }

        $this->setUser($this->name, $this->email, $this->username, $this->pwd, $this->pwdRepeat);

        header("location: ../signup.php?error=none");
        exit();
    }
    // Error checking methods

    private function emptyInput()
    {
        $result = null;

        if (empty($this->name) || empty($this->email) || empty($this->username) || empty($this->pwd) || empty($this->pwdRepeat)) {
            $result = true;
        } else {
            $result = false;
        }

        return $result;
    }

    private function invalidUid()
    {
        $result = null;

        if (!preg_match("/^[a-zA-Z0-9]*$/", $this->username)) {
            $result = true;
        } else {
            $result = false;
        }

        return $result;
    }

    private function invalidEmail()
    {
        $result = null;

        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $result = true;
        } else {
            $result = false;
        }

        return $result;
    }

    private function pwdNotMatch()
    {
        $result = null;

        if ($this->pwd !== $this->pwdRepeat) {
            $result = true;
        } else {
            $result = false;
        }

        return $result;
    }

    private function uidTakenCheck()
    {
        $result = null;

        if (!$this->checkUser($this->name, $this->email)) {
            $result = true;
        } else {
            $result = false;
        }

        return $result;
    }
}
