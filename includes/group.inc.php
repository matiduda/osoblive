<?php
session_start();

if (isset($_POST["submit"])) {
    $authorId = $_SESSION["userid"];
    $postId = $_POST["postId"];
    $groupName = $_POST["groupName"];
    $getBackURL = null;

    if (!$postId) {
        $getBackURL = "../group.php?name={$groupName}";
    } else {
        $getBackURL = "../thread.php?group={$groupName}&id={$postId}";
    }

    include "../classes/dbh.classes.php";
    include "../classes/group.classes.php";
    include "../classes/group-contr.classes.php";

    $groupContr = new GroupContr($groupName, $authorId, $getBackURL);
    $error = $groupContr->switchSubsctiption();
    if (empty($error) === false) {
        header("location: " . $getBackURL . "&error=" . $error);
        exit();
    }

    // Going back to the thread page
    header("location: " . $getBackURL);
} else {
    header("location: ../index.php");
}
