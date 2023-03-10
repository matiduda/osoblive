<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>osoblive</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/navbar.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap" rel="stylesheet">
</head>

<script>
    setTimeout(function() {
        document.body.className = "";
    }, 5);
</script>

<body class="preload">
    <nav class="navbar">
        <div class="logo">
            <a href=" index.php">
                <svg class="svg-header-logo" version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 528 113" width="180" height="30">
                    <style>
                        .a {
                            fill: #FFFFFF
                        }
                    </style>
                    <path class="a" d="m31.3 112.3c28 0 40.8-20.8 40.8-44.6-0.1-20-12.5-31.4-31.4-31.4-25.8 0-40.5 21-40.5 44.5 0 20.2 12.5 31.5 31.1 31.5zm1.6-20c-4.8 0-9.9-4-9.9-12.6 0-11.3 6-23.3 15.9-23.3 4 0 10.4 2.3 10.4 12.8 0 12-6.5 23.1-16.4 23.1zm71.6 20c17.8 0 29.1-9.4 29.1-23.8 0-11.5-7.8-16.8-19.2-22.5-6.8-3.3-10.4-5.7-10.4-8.1 0-2.8 2.9-4.5 5.9-4.5 3.4 0.2 8.5 2 12.6 7.5l13.6-12.9c-6.6-8-16.5-11.7-26.4-11.7-15.1 0-27.1 9.7-27.1 24.5 0 10.8 6.7 16.8 17.8 22.3 8.4 4.4 11.4 5.6 11.4 8.2 0 2.6-2.9 4.1-6.7 4.1-5.7 0-12.3-3.4-16.7-8.7l-12.6 13.1c6.5 8 18.2 12.5 28.7 12.5zm69.4 0c28 0 40.8-20.8 40.8-44.6 0-20-12.4-31.4-31.3-31.4-25.8 0-40.5 21-40.5 44.5 0 20.2 12.4 31.5 31 31.5zm1.7-20c-4.8 0-9.9-4-9.9-12.6 0-11.3 6-23.3 15.9-23.3 4 0 10.3 2.3 10.3 12.8 0 12-6.5 23.1-16.3 23.1zm79.9 20.2c28.8 0 43.1-19 43.1-45.8 0-17-8.3-30.4-23.9-30.4-8.6 0-15.8 4.4-21.3 12l-0.3-0.1 5.7-47.6h-22.5l-12.9 104.2c9.3 5 19.2 7.7 32.1 7.7zm-0.4-20.1c-2.3 0-5.2-0.3-8.1-1.1l0.6-4.8c2.5-19.4 11.3-30.1 19.8-30.1 5 0 8.3 4.9 8.3 11.5 0 13.1-7.1 24.5-20.6 24.5zm65.5-91.8l-13.5 110.4h22.5l13.7-110.4zm49.5 27.6c8.2 0 13.9-5.7 13.9-13.3 0-7.4-5.4-12.8-13.5-12.8-8.3 0-13.9 5.5-13.9 13.2 0 7.4 5.5 12.9 13.5 12.9zm-14 9.4l-9 73.4h22.5l9-73.4zm55.5 74.7c19.8 0 38.8-11.2 43.6-44.5 1.5-10.2 1.5-20.7-0.1-30.2h-22.5c1.3 9.6 1.5 17 0.1 25.7-3.1 22.6-12.1 28.9-17.2 28.9-5 0-5.4-6-4.1-16.6l4.7-38h-22.2l-5.4 42.6c-2.3 19.1 4 32.1 23.1 32.1zm116.2-55.8c0.2-13.8-13.1-20.2-25-20.2-24.8 0-40.2 20.4-40.2 45.3-0.2 19 12.1 30.7 30.6 30.7 14.4 0 24.1-5.4 32-16l-16.9-9.9c-4 5.4-8.4 7.3-13.3 7.3-4.4 0-9.2-2.7-10.5-9.3 21.6-2.2 43-9.3 43.3-27.9zm-21.6 3.2c-0.1 7.2-10 10-21 11.2 2.6-10.2 9.2-15.9 15.6-15.9 3.5 0 5.6 1.7 5.4 4.7z" />
                </svg>
            </a>
        </div>

        <ul class="nav-links">
            <!-- USING CHECKBOX HACK -->
            <input type="checkbox" id="checkbox_toggle" />
            <label for="checkbox_toggle" class="hamburger">&#9776;</label>
            <div class="menu">
                <?php
                if (isset($_SESSION["useruid"]) === false) {
                    echo "<li><a href=\"login.php\">Logowanie</a></li>";
                    echo "<li><a href=\"signup.php\">Rejestracja</a></li>";
                } else {
                    echo "<li><a href=\"feed.php\">Posty</a></li>";
                    echo "<li><a href=\"submit.php\">Dodaj</a></li>";
                    echo "<li><a href=\"includes/logout.inc.php\">Wyloguj si??</a></li>";
                }
                ?>
            </div>
        </ul>
    </nav>