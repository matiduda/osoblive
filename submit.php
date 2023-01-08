<?php
include_once 'header.php';
include "classes/dbh.classes.php";
include "classes/submit.classes.php";
include "classes/submit-view.classes.php";

if (isset($_SESSION["useruid"]) === false) {
    header("location: ../login.php");
    exit();
}
?>

<div class="main-site-content">
</div>


<div class="materialContainer">
    <div class="box">
        <div class="title">Dodaj post</div>
        <form action="includes/submit.inc.php" method="post"><br>

            <?php
            if(isset($_GET["error"])) {
                echo '<a class="error-message">';
                $error = $_GET["error"];
                if($error == "emptyinput") {
                    echo "Formularz wymaga wprowadzenia danych";
                } else if($error == "toolong") {
                    echo "Wprowadzony post jest zbyt długi (max. długość: X znaków)";
                } else if($error == "stmtfailed") {
                    echo "Błąd krytyczny, spróbuj jeszcze raz";
                } else if($error == "none") {
                    echo "Dodano post";
                }
                echo '</a>';
            }
            ?>
            <label for="cars">Wybierz subgrupę</label>
            <select name="groupId">
                <?php
                $view = new SubmitView();
                $view->displayGroupList();
                ?>
            </select>
            lub <a href="addsection.php">stwórz nową</a>
            <div class="input"><input type="text" name="title" id="title" placeholder="Nagłówek posta">
            </div>

            <textarea name="content" placeholder="Treść posta" rows="4" cols="50"></textarea><br>

            <div class="button login">
                <button type="submit" name="submit">Publikuj<i class="fa fa-check"></button>
            </div>
        </form>
    </div>
</div>

<?php
include_once 'footer.php'
?>