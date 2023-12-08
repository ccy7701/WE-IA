<?php
    session_start();
    if (isset($_SESSION["UID"])) {
        unset($_SESSION["UID"]);
        unset($_SESSION["studentName"]);
        header("location: index.php");
    }
?>