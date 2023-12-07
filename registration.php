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
        <a href="index.php" class="logo"><image src="images/mystudykpi-topnavbtn-2-white.png"></image></a>
        <a href="aboutme.php" class="tabs">About Me</a>
        <a href="kpimodule.php" class="tabs">MyKPI Indicator Module</a>
        <a href="activitieslist.php" class="tabs">Activities List</a>
        <a href="challenges.php" class="tabs">Challenges and Future Plans</a>
        <a href="login.php" class="active">Login</a>
        <a href="javascript:void(0);" class="icon" onClick="adjustTopnav()"><i class="fa fa-bars"></i></a>
    </nav>
    <main>
        <center>
            <h1><b>REGISTRATION</b></h1>
            <h4>Complete this form before accessing the MyStudyKPI system. Required fields are marked with (*)</h4>
        </center>
        <div id="regformdiv">
            <form id="regform">
                <label for="student_id">Matric Number (*)</label><br>
                <input id="fieldreg" name="student_id" type="text" required><br>
                <label for="student_password">Password (*)</label><br>
                <input id="fieldreg" name="student_password" type="password" required><br>
                <label for="reenter_password">Reenter Password (*)</label><br>
                <input id="fieldreg" name="reenter_password" type="password" required><br> 
                <label for="student_name">Name (*)</label>
                <input id="fieldreg" name="student_name" type="text" required><br>
                <label for="student_program">Program (*)</label>
                <select id="selectreg" name="student_program" required>
                    <option value="" disabled selected>Select a program...</option>
                    <option value="hc00">UH6481001 Software Engineering</option>
                    <option value="hc05">UH6481002 Network Engineering</option>
                    <option value="hc12">UH6481003 Multimedia Technology</option>
                    <option value="hc13">UH6481004 Business Computing</option>
                    <option value="hc14">UH6481005 Data Science</option>
                </select><br>
                <label for="student_email">E-mail (*)</label>
                <input id="fieldreg" name="student_email" type="email" required><br>
                <label for="student_intakebatch">Intake Batch (*)</label>
                <input id="fieldreg" name="student_intakebatch" type="text" required><br>
                <label for="student_phone">Phone Number (*)</label>
                <input id="fieldreg" name="student_phone" type="text" required><br>
                <label for="student_state">State (*)</label>
                <select id="selectreg" name="student_state" required>
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
                <label for="student_address">Address (*)</label>
                <input id="fieldreg" name="student_address" type="text" required><br>
                <label for="student_motto">Your Motto</label>
                <input id="fieldreg" name="student_motto" type="text"><br>
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