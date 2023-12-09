<?php
    session_start();
    include("include/config.php");
?>

<!DOCTYPE HTML>
<html lang="en">

<html>

<head>
    <title>KPI Module | MyStudyKPI </title>
    <meta charset="utf8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Jost">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="sitejavascript.js"></script>
    <style>
        #btngeneric {
            height: 40px;
            background-color: white;
            border: 1px solid black;
            width: 25%;
            font-size: 16px;
            font-family: Jost, monospace;
            transition: background-color 0.1s, color 0.1s;
        }
        #btngeneric:hover {
            cursor: pointer;
            background-color: #333333;
            color: white;
        }
    </style>
</head>

<body>
    <header>
        <img class="header" src="images/kpimoduleheader.png">
    </header>
    <nav class="topnav" id="myTopnav">
        <a href="index.php" class="logo"><img src="images/mystudykpi-topnavbtn-2-white.png"></a>
        <a href="aboutme.php" class="tabs">About Me</a>
        <a href="kpimodule.php" class="active">MyKPI Indicator Module</a>
        <a href="activitieslist.php" class="tabs">Activities List</a>
        <a href="challenges.php" class="tabs">Challenges and Future Plans</a>
        <?php
            include("include/session_check.php");
        ?>
        <a href="javascript:void(0);" class="icon" onClick="adjustTopnav()"><i class="fa fa-bars"></i></a>
    </nav>
    <main>
        <?php
            if (isset($_SESSION["UID"])) {
                echo "
                    <h1>Hello world! MyKPI Indicator Module</h1>
                <footer>
                    <h5>© Chiew Cheng Yi | BI21110236 | KK34703 Individual Project</h5>
                </footer>
                ";
            }
            else {
                echo "
                    <center>
                        <h3>You must be logged in to use this feature.</h3>
                        <input onclick='redirect(\"login.php\");' id='btngeneric' type='button' value='Login now'>
                        <br><br>
                    </center>
                <footer style='position: fixed; bottom: 0;'>
                    <h5>© Chiew Cheng Yi | BI21110236 | KK34703 Individual Project</h5>
                </footer>
                ";
            }
        ?>
    </main>
</body>

</html>