<?php
include_once 'header.php';

include "classes/dbh.classes.php";
include "classes/posts.classes.php";
include "classes/posts-view.classes.php";
?>

<div class="main-site-content">
    <div class="main-flex-wrapper">
        <div class="one-column-posts">
            <?php
            $view = new PostsView();
            $view->displayAllPosts();
            ?>
        </div>
    </div>

    <?php
    include_once 'footer.php'
    ?>