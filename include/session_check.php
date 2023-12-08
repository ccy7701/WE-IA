<?php
    // determines the display of the Login/Logout depending on whether or not a session is active
    if (isset($_SESSION["UID"])) {
        echo "
            <a href='logout.php' class='active'>Logout</a>
        ";
    }
    else {
        echo "
            <a href='login.php' class='tabs'>Login</a>
        ";
    }
?>