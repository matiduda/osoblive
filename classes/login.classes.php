<?php

class Login extends Dbh
{

    protected function getUser($username, $pwd)
    {

        $stmt = $this->connect()->prepare('SELECT * FROM users WHERE nick_name = ? OR email = ?;');

        if (!$stmt->execute(array($username, $username))) {
            $stmt = null;
            header("location: ../login.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() == 0) {
            $stmt = null;
            header("location: ../login.php?error=usernotfound");
            exit();
        }

        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt = null;

        $pwdHash = $data[0]["password_hash"];

        $checkPwd = password_verify($pwd, $pwdHash);

        if ($checkPwd == false) {
            header("location: ../login.php?error=wrongpassword");
            exit();
        } else if ($checkPwd == true) {

            session_start();
            $_SESSION["userid"] = $data[0]["id"];
            $_SESSION["useruid"] = $data[0]["nick_name"];
            header("location: ../index.php");
            exit();
        }
    }
}
