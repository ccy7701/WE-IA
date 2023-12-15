<?php
    // determines the display of the topnav depending on whether or not a session is active
    if (isset($_SESSION["UID"])) {
        echo "
            <a href='index.php' class='logo'><img src='images/mystudykpi-topnavbtn-2-white.png'></a>
            <a href='aboutme.php' class='tabs'>About Me</a>
            <a href='kpimodule.php' class='tabs'>MyKPI Indicator Module</a>
            <a href='activitieslist.php' class='tabs'>Activities List</a>
            <a href='challenges.php' class='tabs'>Challenges and Future Plans</a>
            <a href='logout.php' class='tabs'>Logout</a>
        ";
    }
    else {
        echo "
            <a href='index.php' class='logo'><img src='images/mystudykpi-topnavbtn-2-white.png'></a>
            <a href='login.php' class='tabs'>Login</a>
        ";
    }
?>