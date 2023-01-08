<?php
session_start();

$authorId = $_SESSION["userid"];

if ($authorId === null) {
    header("location: ../login.php");
    exit();
}
$actionType;
$postId = $_POST['postId'];
$groupName = $_POST["groupName"];

foreach ($_POST as $key => $value) {
    if (is_numeric($key)) {
        $actionType = $key;
    }
}

$getBackURL = "../group.php?name={$groupName}";

// echo "Remove post ID: " . $postId;
// echo "Group name: " . $groupName;
// echo "Action type: " . $actionType;
// echo "Author ID: " . $authorId;

include "../classes/dbh.classes.php";
include "../classes/posts.classes.php";
include "../classes/posts-contr.classes.php";

$postContr = new PostsContr($postId, $groupName, $authorId);

$error = "";

if ($actionType == 1) {
    $error = $postContr->removePost();
} else if ($actionType == 2) {
    $error = $postContr->banPostAuthorFromGroup();
}

if (empty($error) === false) {
    header("location: " . $getBackURL . "&error=" . $error);
    exit();
}

header("location: " . $getBackURL);
