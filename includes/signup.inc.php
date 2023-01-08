<?php

if (isset($_POST["submit"])) {
    
    // Grabbing the data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $username = $_POST["uid"];
    $pwd = $_POST["pwd"];
    $pwdRepeat = $_POST["pwdrepeat"];
    
    // Instantiate SignupContr class
    include "../classes/dbh.classes.php";
    include "../classes/signup.classes.php";
    include "../classes/signup-contr.classes.php";

    $signup = new SignupContr($name, $email, $username, $pwd, $pwdRepeat);

    // Running error handlers and user signup
    $signup->signupUser();

    // Going back to the front page
    header("location: ../signup.php?error=none");
} else {
    header("location: ../signup.php");
}