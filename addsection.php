<?php
include_once 'header.php';
include "classes/dbh.classes.php";
include "classes/add-section.classes.php";
include "classes/add-section-contr.classes.php";

if (isset($_SESSION["useruid"]) === false) {
    header("location: ../login.php");
    exit();
}
?>

<div class="main-site-content"></div>

<div class="materialContainer">
    <div class="box">
        <div class="title">Dodaj subgrupę</div>

        <form action="includes/addsection.inc.php" method="post"><br>

            <?php
            if(isset($_GET["error"])) {
                echo '<a class="error-message">';
                $error = $_GET["error"];
                if($error == "emptyinput") {
                    echo "Formularz wymaga wprowadzenia danych";
                } else if($error == "invalidname") {
                    echo "Wprowadzona nazwa jest nieprawidłowa";
                } else if($error == "sectionexists") {
                    echo "Taka grupa już istnieje";
                } else if($error == "stmtfailed") {
                    echo "Błąd krytyczny, spróbuj jeszcze raz";
                } else if($error == "none") {
                    echo "Dodano post";
                }
                echo '</a>';
            }
            ?>
            <div class="input"><input type="text" name="title" id="title" placeholder="Nazwa subgrupy">
            </div>

            <textarea name="description" placeholder="Krótki opis" rows="4" cols="30"></textarea><br>

            <div class="button login">
                <button type="submit" name="submit">Dodaj<i class="fa fa-check"></button>
            </div>
        </form>
    </div>
</div>

<?php
include_once 'footer.php'
?>