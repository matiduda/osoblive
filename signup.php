<?php
    include_once 'header.php'
?>

<div class="main-site-content">
</div>

<div class="materialContainer">
    <div class="box">
        <div class="title">Rejestracja</div>

        <form action="includes/signup.inc.php" method="post"><br>

            <?php
            if(isset($_GET["error"])) {
                echo '<a class="error-message">';
                $error = $_GET["error"];
                if($error == "emptyinput") {
                    echo "Formularz wymaga wprowadzenia danych";
                } else if($error == "invaliduid") {
                    echo "Nieprawidłowa nazwa użytkownika";
                } else if($error == "invalidemail") {
                    echo "Nieprawidłowy adres e-mail";
                } else if($error == "passwordsdontmatch") {
                    echo "Wprowadzone hasła nie pokrywają się";
                } else if($error == "stmtfailed") {
                    echo "Błąd krytyczny, spróbuj jeszcze raz";
                } else if($error == "usernametaken") {
                    echo "Ta nazwa użytkownika jest już zajęta";
                } else if($error == "none") {
                    echo "Rejestracja przebiegła poprawnie";
                }
                echo '</a>';
            }
            ?>

            <div class="input"><input type="text" name="name" id="name" placeholder="Imię i nazwisko"></div>
            <div class="input"><input type="text" name="email" id="name" placeholder="Adres e-mail"></div>
            <div class="input"><input type="text" name="uid" id="name" placeholder="Nazwa użytkownika"></div>
            <div class="input"><input type="password" name="pwd" id="name" placeholder="Hasło"></div>
            <div class="input"><input type="password" name="pwdrepeat" id="name" placeholder="Powtórz hasło"></div>

            <div class="button login">
                <button type="submit" name="submit">Rejestracja<i class="fa fa-check"></button>
            </div>
        </form>
    </div>
</div>








<?php
    include_once 'footer.php'
?>