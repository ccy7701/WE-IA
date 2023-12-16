<!DOCTYPE HTML>
<html lang="en">

<html>

<head>
    <title>Registration | MyStudyKPI </title>
    <meta charset="utf8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Jost">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="sitejavascript.js"></script>
</head>

<body>
    <header>
        <img class="header" src="images/registrationheader.png">
    </header>
    <nav class="topnav" id="myTopnav">
        <a href="index.php" class="logo"><img src="images/mystudykpi-topnavbtn-2-white.png"></a>
        <a href="login.php" class="active">Login</a>
        <a href="javascript:void(0);" class="icon" onClick="adjustTopnav()"><i class="fa fa-bars"></i></a>
    </nav>
    <main>
        <center>
            <h4>Complete this form before accessing the MyStudyKPI system. Required fields are marked with (*)</h4>
        </center>
        <div id="regformdiv">
            <form id="regform" action="action_scripts/registration_action.php" method="post">
                <label for="matricNumber">Matric Number(*)</label><br>
                <input id="fieldreg" name="matricNumber" type="text" required><br>

                <label for="accountEmail">E-mail Address(*)</label><br>
                <input id="fieldreg" name="accountEmail" type="email" required><br>

                <label for="accountPassword">Password (*)</label><br>
                <input id="fieldreg" name="accountPassword" type="password" required><br>

                <label for="reenterPassword">Reenter Password (*)</label><br>
                <input id="fieldreg" name="reenterPassword" type="password" required><br> 

                <center>
                    <input id="btnreg" name="signupsubmit" type="submit" value="SUBMIT">
                    <input id="btnreg" name="signupreset" type="reset" value="CLEAR">
                </center>
                <br><br>
            </form>
        </div>
    </main>
    <footer style="position: fixed; bottom: 0;">
        <h5>© Chiew Cheng Yi | BI21110236 | KK34703 Individual Project</h5>
    </footer>
</body>

</html>