<?php

class Signup extends Dbh
{
    protected function checkUser($uid, $email)
    {
        $stmt = $this->connect()->prepare('SELECT * FROM users WHERE nick_name = ? OR email = ?;');

        if (!$stmt->execute(array($uid, $email))) {
            $stmt = null;
            header("location: ../signup.php?error=stmtfailed");
            exit();
        }

        $resultCheck = null;

        if ($stmt->rowCount() > 0) {
            $resultCheck = false;
        } else {
            $resultCheck = true;
        }

        return $resultCheck;
    }

    protected function setUser($name, $email, $username, $pwd)
    {
        $stmt = $this->connect()->prepare('INSERT INTO users (full_name, email, nick_name, password_hash) VALUES (?, ?, ?, ?);');

        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

        // Prepare statement for SQL Injection prevention

        if (!$stmt->execute(array($name, $email, $username, $hashedPwd))) {
            $stmt = null;
            header("location: ../signup.php?error=stmtfailed");
            exit();
        }

        $stmt = null;
    }
}
