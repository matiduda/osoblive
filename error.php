<?php
include_once 'header.php'
?>

<div class="main-site-content">
</div>

<div class="materialContainer">
    <div class="box">
        <div class="title">404</div>
        <div class="error-message">
            <p>Błąd krytyczny</p>
        </div>
        <div class="post-wrapper" style="text-align: center;">
            Spróbuj jeszcze raz lub skontaktuj się z administratorem serwisu.<br><br>
            <p>Kod błędu: <strong><?php
                                    $error = $_GET['code'];
                                    if (empty($error)) {
                                        echo "Nie znaleziono";
                                    } else {
                                        echo $error;
                                    }
                                    ?></strong></p><br>
            <a href="index.php">Powrót do strony głównej</a>
        </div>
    </div>
</div>

<?php
include_once 'footer.php'
?>