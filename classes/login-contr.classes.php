<?php

class LoginContr extends Login
{
    private $name;
    private $pwd;

    public function __construct($name, $pwd)
    {
        $this->name = $name;
        $this->pwd = $pwd;
    }

    public function loginUser()
    {

        if ($this->emptyInputLogin() !== false) {
            header("location: ../login.php?error=emptyinput");
            exit();
        }

        $this->getUser($this->name, $this->pwd);

        header("location: ../signup.php?error=none");
        exit();
    }

    private function emptyInputLogin()
    {
        $result = null;

        if (empty($this->name) || empty($this->pwd)) {
            $result = true;
        } else {
            $result = false;
        }

        return $result;
    }
}
