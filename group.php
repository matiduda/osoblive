<?php
include_once 'header.php';

include "classes/dbh.classes.php";
include "classes/group.classes.php";
include "classes/group-view.classes.php";
include "classes/posts.classes.php";
include "classes/posts-view.classes.php";
?>

<div class="main-site-content">
    <?php
    if (!isset($_GET["name"])) {
        echo "<p>Ta grupa nie istnieje</p><br>";
        exit();
    }

    $groupName = $_GET["name"];
    $postId = "";
    $userId = $_SESSION["userid"];
    ?>

    <div class="main-flex-wrapper">
        <div class="main-group-info-wrapper">
            <?php
            // Get group info
            $view = new GroupView($groupName, $userId);
            $view->displayGroupInfo($postId);
            ?>
        </div>

        <div class="main-posts-wrapper">
            <?php
            // Display group posts
            $posts = new PostsView();
            $posts->displayPostsFromGroup($userId, $groupName);
            ?>
        </div>
    </div>
</div>

<?php
include_once 'footer.php'
?>