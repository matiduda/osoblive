<?php
session_start();

$authorId = $_SESSION["userid"];

if ($authorId === null) {
    header("location: ../login.php");
    exit();
}
$reactionId;
$postId = $_POST['postId'];
$groupName = $_POST["groupName"];

foreach ($_POST as $key => $value) {
    if (is_numeric($key)) {
        $reactionId = $key;
    }
}

if (empty($groupName)) {
    $getBackURL = "../feed.php";
} else if ($groupName == "user") {
    $getBackURL = "../index.php";
} else {
    $getBackURL = "../thread.php?group={$groupName}&id={$postId}";
}

include "../classes/dbh.classes.php";
include "../classes/posts.classes.php";
include "../classes/posts-contr.classes.php";

$postContr = new PostsContr($postId, $groupName, $authorId, $getBackURL);


$error = $postContr->addReaction($reactionId);
if (empty($error) === false) {
    header("location: " . $getBackURL . "&error=" . $error);
    exit();
}

header("location: " . $getBackURL);
