<?php
session_start();

if (isset($_POST["submit"])) {
    $authorId = $_SESSION["userid"];
    $groupId = $_POST["groupId"];
    $content = $_POST["content"];
    $title = $_POST["title"];

    include "../classes/dbh.classes.php";
    include "../classes/submit.classes.php";
    include "../classes/submit-contr.classes.php";

    $submit = new submitContr($groupId, $title, $content, $authorId);
    $submit->submitPost();

    // Going back to the front page
    header("location: ../submit.php?error=none");
} else {
    header("location: ../submit.php");
}
