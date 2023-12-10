<!DOCTYPE HTML>
<html lang="en">

<html>

<head>
    <title>Login | MyStudyKPI </title>
    <meta charset="utf8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Jost">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="sitejavascript.js"></script>
</head>

<body>
    <header>
        <img class="header" src="images/loginheader.png">
    </header>
    <nav class="topnav" id="myTopnav">
        <a href="index.php" class="logo"><img src="images/mystudykpi-topnavbtn-2-white.png"></a>
        <a href="aboutme.php" class="tabs">About Me</a>
        <a href="kpimodule.php" class="tabs">MyKPI Indicator Module</a>
        <a href="activitieslist.php" class="tabs">Activities List</a>
        <a href="challenges.php" class="tabs">Challenges and Future Plans</a>
        <a href="login.php" class="active">Login</a>
        <a href="javascript:void(0);" class="icon" onClick="adjustTopnav()"><i class="fa fa-bars"></i></a>
    </nav>
    <main>
        <center>
            <h4>Login to view all your information</h4>
            <div id="logindiv">
                <form id="loginform" action="action_scripts/login_action.php" method="post">
                    <input id="fieldlogin" name="loginmatric" type="text" placeholder="Matric Number" required></textarea><br>
                    <input id="fieldlogin" name="loginpassword" type="password" placeholder="Password" required><br>
                    <input id="btnlogin" name="loginsubmit" type="submit" value="LOGIN">
                    <input id="btnlogin" name="loginreset" type="reset" value="CLEAR"><br>
                </form>
            </div>

            <p>Do not have your own account yet?
            <a href="registration.php">Register here.</a>
            </p>
        </center>
    </main>
    <footer style="position: fixed; bottom: 0;">
        <h5>© Chiew Cheng Yi | BI21110236 | KK34703 Individual Project</h5>
    </footer>
</body>

</html>