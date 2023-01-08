<?php

class Dbh
{
    protected function connect()
    {
        try {
            $dbUserName = "root";
            $dbPassword = "1423";
            $dbh = new PDO('mysql:host=localhost;dbname=epiz_32912275_osoblive', $dbUserName, $dbPassword);
            return $dbh;
        } catch (PDOException $e) {
            header("location: ../error.php?code=DatabaseNotConnected");
            die();
        }
    }
}
