<!DOCTYPE HTML>
<html lang="en">

<html>

<head>
    <title>About Me | MyStudyKPI </title>
    <meta charset="utf8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Jost">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="sitejavascript.js"></script>
</head>

<body>
    <header>
        <img class="header" src="images/placeholder.png">
    </header>
    <nav class="topnav" id="myTopnav">
        <a class="logo" href="index.php"><image src="images/mystudykpi-topnavbtn-2-white.png"></image></a>
        <a href="login.php" class="tabs">Login</a>
        <a href="aboutme.php" class="active">About Me</a>
        <a href="kpimodule.php" class="tabs">MyKPI Indicator Module</a>
        <a href="activitieslist.php" class="tabs">Activities List</a>
        <a href="challenges.php" class="tabs">Challenges and Future Plans</a>
        <a href="javascript:void(0);" class="icon" onClick="adjustTopnav()"><i class="fa fa-bars"></i></a>
    </nav>
    <main>
        <center>
            <h1>ABOUT ME</h1>
            <h4>A portfolio page summarising yourself</h4>
        </center>
        <div class="row">
            <div class="col-left">
                <img src="images/chiew.png" alt="chiew" style="width:65%">
                <table id="tblprofile" width="100%">
                    <caption><h3>PERSONAL INFO</h3></caption>
                    <!-- SOME PHP GOES HERE LATER -->
                    <tr>
                        <td>Name</td>
                        <td>Chiew Cheng Yi</td>
                    </tr>
                    <tr>
                        <td>Matric No.</td>
                        <td>BI21110236</td>
                    </tr>
                    <tr>
                        <td>Program</td>
                        <td>UH6481001 Software Engineering</td>
                    </tr>
                    <tr>
                        <td>E-mail</td>
                        <td>chiew_cheng_bi21@iluv.ums.edu.my</td>
                    </tr>
                    <tr>
                        <td>Intake Batch</td>
                        <td>2021</td>
                    </tr>
                    <tr>
                        <td>Phone Number</td>
                        <td>0142704730</td>
                    </tr>
                    <tr>
                        <td>Mentor</td>
                        <td>Dr. Syamsul</td>
                    </tr>
                    <tr>
                        <td>State of Origin</td>
                        <td>Sabah</td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td>Kolombong, 88450 Kota Kinabalu</td>
                    </tr>
                    <tr>
                        <td>Motto</td>
                        <td>The secret to getting ahead is getting started.</td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <center>
                                <input id="btneditpersonal" type="button" name="btneditpersonal" value="Edit Details">
                            </center>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-right">
                <table id="tblactivities" width="100%">
                    <caption><h3>ACTIVITIES</h3></caption>
                    <tr>
                        <td>Cell 0:0</td>
                        <td>Cell 0:1</td>
                    </tr>
                </table>
                <br>
                <table id="tblcompetitions" width="100%">
                    <caption><h3>COMPETITIONS</h3></caption>
                    <tr>
                        <td>Cell 0:0</td>
                        <td>Cell 0:1</td>
                    </tr>
                </table>
                <br>
                <table id="tblcertifications" width="100%">
                    <caption><h3>CERTIFICATIONS</h3></caption>
                    <tr>
                        <td>Cell 0:0</td>
                        <td>Cell 0:1</td>
                    </tr>
                </table>
            </div>
    </main>
    <footer>
        <h4>Chiew Cheng Yi | BI21110236 | Created on 12 November 2023 for KK34703 Individual Assignment</h4>
    </footer>
</body>

</html>