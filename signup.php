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
        <img class="header" src="images/placeholder.png">
    </header>
    <nav class="topnav" id="myTopnav">
        <a class="logo" href="index.php"><image src="images/mystudykpi-topnavbtn-2-white.png"></image></a>
        <a href="login.php" class="tabs">Login</a>
        <a href="aboutme.php" class="tabs">About Me</a>
        <a href="kpimodule.php" class="tabs">MyKPI Indicator Module</a>
        <a href="activitieslist.php" class="tabs">Activities List</a>
        <a href="challenges.php" class="tabs">Challenges and Future Plans</a>
        <a href="javascript:void(0);" class="icon" onClick="adjustTopnav()"><i class="fa fa-bars"></i></a>
    </nav>
    <main>
        <center>
            <h1><b>REGISTRATION</b></h1>
            <h4>Complete this form before accessing the MyStudyKPI system</h4>
        </center>
        <div id="regformdiv">
            <form id="regform">
                <label for="studentid">Matric Number</label><br>
                <input id="fieldreg" name="studentid" type="text"><br>
                <label for="studentname">Name</label>
                <input id="fieldreg" name="studentname" type="text"><br>
                <label for="student_program">Program</label>
                <select id="selectreg" name="studentprogram">
                    <option value="" disabled selected>Select a program...</option>
                    <option value="hc00">UH6481001 Software Engineering</option>
                    <option value="hc05">UH6481002 Network Engineering</option>
                    <option value="hc12">UH6481003 Multimedia Technology</option>
                    <option value="hc13">UH6481004 Business Computing</option>
                    <option value="hc14">UH6481005 Data Science</option>
                </select><br>
                <label for="studentemail">E-mail</label>
                <input id="fieldreg" name="studentemail" type="email"><br>
                <label for="studentintakebatch">Intake Batch</label>
                <input id="fieldreg" name="studentintakebatch" type="text"><br>
                <label for="studentphone">Phone Number</label>
                <input id="fieldreg" name="studentnumber" type="text"><br>
                <label for="studentstate">State</label>
                <select id="selectreg" name="studentstate">
                    <option value="" disabled selected>Select a state...</option>
                    <optgroup label="States">
                        <option value="jhr">Johor</option>
                        <option value="kdh">Kedah</option>
                        <option value="ktn">Kelantan</option>
                        <option value="mlk">Malacca</option>
                        <option value="nsn">Negeri Sembilan</option>
                        <option value="phg">Pahang</option>
                        <option value="png">Penang</option>
                        <option value="prk">Perak</option>
                        <option value="pls">Perlis</option>
                        <option value="sbh">Sabah</option>
                        <option value="swk">Sarawak</option>
                        <option value="sgr">Selangor</option>
                        <option value="trg">Terengganu</option>
                    </optgroup>
                    <optgroup label="Federal Territories">
                        <option value="kul">Kuala Lumpur</option>
                        <option value="lbn">Labuan</option>
                        <option value="pjy">Putrajaya</option>
                    </optgroup>
                    <optgroup label="Others">
                        <option value="oth">Overseas</option>
                    </optgroup>
                </select><br>
                <label for="studentaddress">Address</label>
                <input id="fieldreg" name="studentaddress" type="text"><br>
                <center>
                    <input id="btnreg" name="signupsubmit" type="submit" value="SUBMIT">
                    <input id="btnreg" name="signupreset" type="reset" value="CLEAR">
                </center>
                <br><br>
            </form>
        </div>
    </main>
    <footer>
        <h4>Chiew Cheng Yi | BI21110236 | Created on 12 November 2023 for KK34703 Individual Assignment</h4>
    </footer>
</body>

</html>