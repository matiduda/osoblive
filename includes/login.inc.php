<?php

if (isset($_POST["submit"])) {

    // Grabbing the data
    $name = $_POST["name"];
    $pwd = $_POST["pwd"];

    // Instantiate LoginContr class
    include "../classes/dbh.classes.php";
    include "../classes/login.classes.php";
    include "../classes/login-contr.classes.php";

    $login = new loginContr($name, $pwd);

    // Running error handlers and user login
    $login->loginUser();

    // Going back to the front page
    header("location: ../index.php");
} else {
    header("location: ../login.php");
}
