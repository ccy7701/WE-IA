<?php
    session_start();
    include("include/config.php");
?>

<!DOCTYPE HTML>
<html lang="en">

<html>
    <title>Edit Indicator</title>
    <meta charset="utf8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Jost">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="sitejavascript.js"></script>
    <style>
        #editIndicatorRecord-container {
            align: center;
            padding-left: 30%;
            padding-right: 30%;
            min-height: 100vh;
        }
        #editIndicatorRecord {
            width: 100%;
            border-collapse: collapse;
        }
        #btneditindicator {
            width: 30%;
            height: 30px;
            font-family: Jost, monospace;
            font-size: 18px;
            background-color: white;
            border: 1px solid grey;
            transition: background-color 0.1s, color 0.1s;
        }
        #btneditindicator:hover {
            cursor: pointer;
            background-coloR: #333333;
            color: white;
        }
        #editIndicatorRecord textarea {
            height: 100px;
            width: 100%;
            font-family: Jost, monospace;
            resize: none;
            display: block;
            font-size: 18px;
        }
        @media screen and (max-width: 600px) {
            #editIndicatorRecord-container {
                padding-left: 10%;
                padding-right: 10%;
            }
        }
    </style>
<head>

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
        <a href="logout.php" class="tabs">Logout</a>
        <a href="javascript:void(0);" class="icon" onClick="adjustTopnav()"><i class="fa fa-bars"></i></a>
    </nav>
    <main>
        <h3 style="text-align: center">Edit Indicator Record</h3>
        <?php
            if (isset($_GET["id"]) && $_GET["id"] != "") {
                $id = $_GET["id"];
                $fetchRecordQuery = "SELECT * FROM indicator WHERE indicatorID=".$id;
                $result = mysqli_query($conn, $fetchRecordQuery);
                $row = mysqli_fetch_assoc($result);

                // fetch the data to populate the form
                $indicatorID = $row["indicatorID"];
                $indicatorSem = $row["indicatorSem"];
                $indicatorYear = $row["indicatorYear"];
                $indicatorCGPA = $row["indicatorCGPA"];
                $indicatorLeadership = $row["indicatorLeadership"];
                $indicatorGraduateAim = $row["indicatorGraduateAim"];
                $indicatorProfCert = $row["indicatorProfCert"];
                $indicatorEmployability = $row["indicatorEmployability"];
                $indicatorMobProg = $row["indicatorMobProg"];

                mysqli_close($conn);
            }
        ?>
        <div id="editIndicatorRecord-container">
            <form id="editIndicatorRecord" action="action_scripts/kpimodule_edit_action.php" method="POST" enctype="multipart/form-data">
                <input name="indicatorID" type="text" value="<?=$indicatorID;?>" hidden>
                <input name="indicatorSem" type="text" value="<?=$indictorSem;?>" hidden>
                <input name="indicatorYear" type="text" value="<?=$indicatorYear;?>" hidden>
                
                <p>Note: To update your total count for activites and competitions joined, make your modification at the Activities List page.</p>

                <label for="indicatorCGPA">CGPA</label>
                <input id="editfield" name="indicatorCGPA" type="text" value="<?=$indicatorCGPA;?>"></input><br>

                <label for="indicatorLeadership">Leadership</label>
                <select id="select" name="indicatorLeadership">
                    <option value="<?=$indicatorLeadership;?>" selected>Current: <?=$indicatorLeadership;?></option>
                    <option value="0">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select><br>

                <label for="indicatorGraduateAim">Graduate Aim</label>
                <select id="select" name="indicatorGraduateAim">
                    <option value="<?=$indicatorGraduateAim;?>" selected>Current: <?=$indicatorGraduateAim;?></option>
                    <option value="On Time">On Time</option>
                    <option value="Delayed">Delayed</option>
                    <option value="Ahead of Schedule">Ahead of Schedule</option>
                </select><br>

                <label for="indicatorProfCert">Professional Certification</label>
                <select id="select" name="indicatorProfCert">
                    <option value="<?=$indicatorProfCert;?>" selected>Current: <?=$indicatorProfCert;?></option>
                    <option value="0">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select><br>

                <label for="indicatorEmployability">Employability (within how many months after Industrial Training)</label>
                <select id="select" name="indicatorEmployability">
                    <option value="<?=$indicatorEmployability;?>" selected>Current: <?=$indicatorEmployability;?></option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                </select><br>

                <label for="indicatorMobProg">Mobility Program</label>
                <select id="select" name="indicatorMobProg">
                    <option value="<?=$indicatorMobProg;?>" selected>Current: <?=$indicatorMobProg;?></option>
                    <option value="0">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select><br>

                <div id="center-content" style="text-align: center">
                    <input id="btneditindicator" name="btnsubmit" type="submit" value="EDIT">
                    <input id="btneditindicator" name="btnreset" type="reset" value="RESET">
                    <input id="btneditindicator" name="btncancel" type="button" onClick="redirect('kpimodule.php');" value="CANCEL">
                    <br><br>
                </div>
            </form>
        </div>
    </main>
    <footer>
        <h5>© Chiew Cheng Yi | BI21110236 | KK34703 Individual Project</h5>
    </footer>
</body>

</html>

