<?php
session_start();

if (isset($_POST["submit"])) {
    $adminId = $_SESSION["userid"];
    $sectionName = $_POST["title"];
    $description = $_POST["description"];

    include "../classes/dbh.classes.php";
    include "../classes/add-section.classes.php";
    include "../classes/add-section-contr.classes.php";

    $addSection = new AddSectionContr($sectionName, $adminId, $description);
    $addSection->add();

    // Going back to the submit page
    header("location: ../submit.php");
} else {
    header("location: ../addsection.php");
}