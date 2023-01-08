<?php
    include_once 'header.php'
?>

<div class="main-site-content">
</div>

<div class="materialContainer">
    <div class="box">
        <div class="title">Logowanie</div>

        <form action="includes/login.inc.php" method="post"><br>

            <?php
            if(isset($_GET["error"])) {
                echo '<a class="error-message">';
                $error = $_GET["error"];
                if($error == "emptyinput") {
                    echo "Formularz wymaga wprowadzenia danych";
                } else if($error == "usernotfound") {
                    echo "Taki użytkownik nie istnieje";
                } else if($error == "invalidemail") {
                    echo "Nieprawidłowy adres e-mail";
                } else if($error == "wrongpassword") {
                    echo "Wprowadzone dane są nieprawidłowe";
                }
                echo '</a>';
            }
            ?>

            <div class="input"><input type="text" name="name" id="name" placeholder="Login lub e-mail">
            </div>
            <div class="input"><input type="password" name="pwd" id="name" placeholder="Hasło"></div>


            <div class="button login">
                <button type="submit" name="submit">Logowanie<i class="fa fa-check"></button>
            </div>
        </form>
        <!-- TODO: Implement password reset feature -->
        <a href="" class="pass-forgot">Nie pamiętam hasła</a>
    </div>
</div>

<?php
    include_once 'footer.php'
?>