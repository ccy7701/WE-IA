<!DOCTYPE HTML>
<html lang="en">

<html>

<head>
    <title>Challenges and Future Plans | MyStudyKPI </title>
    <meta charset="utf8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Jost">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="sitejavascript.js"></script>
</head>

<body>
    <header>
        <img class="header" src="images/challengesheader.png">
    </header>
    <nav class="topnav" id="myTopnav">
        <a href="index.php" class="logo"><image src="images/mystudykpi-topnavbtn-2-white.png"></image></a>
        <a href="aboutme.php" class="tabs">About Me</a>
        <a href="kpimodule.php" class="tabs">MyKPI Indicator Module</a>
        <a href="activitieslist.php" class="tabs">Activities List</a>
        <a href="challenges.php" class="active">Challenges and Future Plans</a>
        <a href="login.php" class="tabs">Login</a>
        <a href="javascript:void(0);" class="icon" onClick="adjustTopnav()"><i class="fa fa-bars"></i></a>
    </nav>
    <main>
        <br>
        <div id="projecttable-container">
            <table id="projecttable" border="1" width="100%">
                <!-- <caption><h3>Challenges and Future Plans</h3></caption> -->
                <tr>
                    <th>No</th>
                    <th>Year/Sem</th>
                    <th>Challenges</th>
                    <th>Future Plans</th>
                    <th>Remarks</th>
                    <th>Date of Record</th>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
            </table> 
        </div>
        <br>
        <form id="challengetable">
            <p>Facing a new challenge? Fill the form below and record it here. Required fields are marked (*)</p>
            <label for="yearsem">Year/Sem (*): </label><br>
            <select id="yearsem" name="yearsem">
                <option value="y1s1">Year 1 Sem 1</option>
                <option value="y1s2">Year 1 Sem 2</option>
                <option value="y2s1">Year 2 Sem 1</option>
                <option value="y2s2">Year 2 Sem 2</option>
                <option value="y3s1">Year 3 Sem 1</option>
                <option value="y3s2">Year 3 Sem 2</option>
                <option value="y4s1">Year 4 Sem 1</option>
                <option value="y4s2">Year 4 Sem 2</option>
            </select><br>
            <label for="entrydate">Date of record (*): </label><br>
            <input name="entrydate" type="date"><br>
            <label for="challenge">Challenge (*): </label><br>
            <textarea name="challenge" rows="5" cols="50"></textarea><br>
            <label for="futureplan">Future plan (*): </label><br>
            <textarea name="futureplan" rows="5" cols="50"></textarea><br>
            <label for="remarks">Remarks: </label><br>
            <textarea name="Remarks" rows="5" cols="50"></textarea><br><br>
            <input name="btnsubmit" type="submit" value="Submit">
            <input name="btnreset" type="reset" value="Reset"><br><br>
        </form>
    </main>
    <footer>
        <h5>© Chiew Cheng Yi | BI21110236 | KK34703 Individual Project</h5>
    </footer>
</body>

</html>