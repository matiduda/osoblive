<?php
session_start();

if (isset($_POST["submit"])) {
    $authorId = $_SESSION["userid"];
    $postId = $_POST["postId"];
    $content = $_POST["content"];
    $getBackURL = "../thread.php?group={$_POST["groupName"]}&id={$postId}";

    include "../classes/dbh.classes.php";
    include "../classes/comments.classes.php";
    include "../classes/comments-contr.classes.php";

    $addComment = new CommentsContr($authorId, $postId, $content, $getBackURL);
    $error = $addComment->add();
    if(empty($error) === false) {
        header("location: " . $getBackURL . "&error=" . $error);
        exit();
    }
    
    // Going back to the thread page
    header("location: " . $getBackURL);
} else {
    header("location: ../index.php");
}