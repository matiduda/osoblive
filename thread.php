<?php
include_once 'header.php';

include "classes/dbh.classes.php";
include "classes/group.classes.php";
include "classes/group-view.classes.php";
include "classes/posts.classes.php";
include "classes/posts-view.classes.php";
include "classes/comments.classes.php";
include "classes/comments-view.classes.php";
?>

<div class="main-site-content">
    <?php
    if (!isset($_GET["id"])) { // Post ID
        echo "<p>Ten post nie istnieje</p><br>";
        exit();
    }
    $groupName = $_GET["group"];
    $postId = $_GET["id"];
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
            <div class="post-wrapper">
                <?php
                // Display group posts
                $posts = new PostsView();
                $posts->displaySinglePost($userId, $groupName, $postId);
                $posts = new PostsView();
                $comments = new CommentsView();
                $comments->displayAllComments($postId);
                ?>
                <div class="add-comment-wrapper">
                    <?php
                    // Display comment box only if user is logged in

                    if (isset($_SESSION["useruid"]) === true) {
                        echo "<form action=\"includes/thread.inc.php\" method=\"post\"><br>";
                        echo "<textarea name=\"content\" placeholder=\"Dodaj komentarz\" rows=\"4\" cols=\"50\"></textarea><br>";
                        echo "<input type=\"hidden\" name=\"postId\" id=\"hiddenField\" value=\"{$postId}\" />";
                        echo "<input type=\"hidden\" name=\"groupName\" id=\"hiddenField\" value=\"{$groupName}\" />";
                        echo '<button class="comment-button" type="submit" name="submit">Dodaj<i class="fa fa-check"></button>';
                        echo "</form>";
                    } else {
                        echo "<br><p>Aby dodać komentarz, ";
                        echo "<a href=\"login.php\">zaloguj się</a></li>";
                    }

                    if (isset($_GET["error"])) {
                        $error = $_GET["error"];
                        if ($error == "emptyinput") {
                            echo "<p>Formularz wymaga wprowadzenia danych</p>";
                        } else if ($error == "stmtfailed") {
                            echo "<p>Błąd krytyczny, spróbuj jeszcze raz</p>";
                        } else if ($error == "none") {
                            echo "<p>Dodano komentarz</p>";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>


</div>




<?php
include_once 'footer.php'
?>