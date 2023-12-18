<?php
    session_start();
?>

<!DOCTYPE HTML>

<html lang="en">

<html>

<head>
    <title>Home | MyStudyKPI </title>
    <meta charset="utf8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Jost">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="sitejavascript.js"></script>
    <style>
        .block {
            text-align: center;
            background-color: #D9DADB;
            color: black;
            width: 50%;
            transition: background-color 0.1s; color 0.1s;
        }
        .block:hover {
            background-color: #555555;
            color: white;
        }
        .block i {
            text-align: left;
            margin-left: 20px;
            margin-right: 20px;
            padding-top: 10px;
            font-size: 100px;
        }
        .block p {
            margin-left: 20px;
            margin-right: 20px;
            font-size: 18px;
        }
        @media screen and (max-width: 720px) {  /* CSS when pages are resized to smaller or for mobile screen */
            .block {
                width: 75%;
            }
        }
    </style>
</head>

<body>
    <header>
        <img class="header" src="images/indexheader2.png">
    </header>
    <nav class="topnav" id="myTopnav">
        <?php
            include("include/login_session_check.php");
        ?>
        <a href="javascript:void(0);" class="icon" onClick="adjustTopnav()"><i class="fa fa-bars"></i></a>
    </nav>
    <main>
        <div id="center-content" style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
            <?php
                if (isset($_SESSION["UID"])) {
                    echo "
                        <h1 style='text-align: center'>Welcome back</h1>
                    ";
                }
                else {
                    echo "
                        <h1 style='text-align: center'>Welcome to the UMS FKI MyStudyKPI website</h1>
                    ";
                }
            ?>
            <div class="block">
                <i class="fa fa-user-circle-o"></i>
                <p><b>About Me:</b> Get a concise overview of your information in a portfolio webpage.</p>
            </div>
            <br>
            <div class="block">
                <i class="fa fa-line-chart"></i>
                <p><b>MyKPI Indicator Module:</b> A tool to manage your KPIs, including activities, certifications and competitions.</p>
            </div>
            <br>
            <div class="block">
                <i class="fa fa-calendar-check-o"></i>
                <p><b>Activities List:</b> View a compiled list of faculty-recognised activities, and stay informed about past, ongoing and upcoming activities.</p>
            </div>
            <br>
            <div class="block">
                <i class="fa fa-meh-o"></i>
                <p><b>Challenges and Future Plans:</b> Facing challenges in your studies? Put what's on your mind into words to help you plan accordingly.</p>
            </div>
            <br>
        </div>
    </main>
    <footer>
        <h5>© Chiew Cheng Yi | BI21110236 | KK34703 Individual Project</h5>
    </footer>
</body>

</html>