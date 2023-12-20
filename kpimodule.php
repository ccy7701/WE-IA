<?php
    session_start();
    include("include/config.php");
?>

<!DOCTYPE HTML>
<html lang="en">

<html>

<head>
    <title>MyKPI Indicator Module | MyStudyKPI </title>
    <meta charset="utf8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Jost">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="sitejavascript.js"></script>
    <script type="text/javascript">
        function openTab(evt, content) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
                tabcontent[i].style.opacity = 0;    // set opacity to 0 when hiding
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            var selectedTab = document.getElementById(content);
            selectedTab.style.display = "block";
            // Trigger a reflow before changing the opacity to ensure the transition is applied
            selectedTab.offsetHeight;
            selectedTab.style.opacity = 1; // Set opacity to 1 when displaying
            evt.currentTarget.className += " active";
        }
    </script>
    <style>
        * {
            font-family: Jost, monospace;
        }
        main {
            min-height: 100vh;
        }
        .tab-container {
            padding-left: 5%;
            padding-right: 5%;
            box-sizing: border-box;
        }
        .tab {
            overflow: hidden;
            border: 1px solid #888888;
            background-color: #f0f0f0;
        }
        .tab button {
            background-color: inherit;
            float: left;
            border: none;
            border-right: 1px solid #888888;
            outline: none;
            cursor: pointer;
            padding-top: 12px;
            padding-bottom: 12px;
            transition: 0.1s;
            font-size: 16px;
            width: 15%;
        }
        .tab button.active {
            background-color: #333333;
            color: white;
        }
        .tab button:hover {
            background-color: #666666;
            color: white;
        }
        .tabcontent {
            display: none;
            padding: 6px 10px;
            transition: opacity 0.2s ease;
            width: 100%;
            box-sizing: border-box;
        }
        #content-container {
            padding-left: 5%;
            padding-right: 5%;
            width: 100%;
            box-sizing: border-box;
        }
        .indicatorsContainer {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .indicatorBlock {
            background-color: #D9DADB;
            color: black;
            padding-left: 3%;
            padding-right: 3%;
            width: 74%;
        }
        .indicatorTopbar {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
            margin-bottom: 10px;
        }
        .indicatorTable {
            width: 100%;
            padding-bottom: 10px;
            border-collapse: collapse;
            border: 1px solid grey;
            margin-bottom: 10px;
        }
        .indicatorTable td {
            border: 1px solid grey;
            padding-left: 5px;
        }
        .attributeCell {
            width: 20%;
        }
        .dataCell {
            width: 80%;
        }
        .editButton {
            height: 30px;
        }
        @media screen and (max-width: 600px) {
            .tab button {
                width: 25%;
            }
            #content-container {
                padding-left: 2%;
                padding-right: 2%;
                overflow-x: auto;
            }
            .attributeCell {
                width: 40%;
            }
            .dataCell {
                width: 60%;
            }
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
        <a href="logout.php" class="tabs">Logout</a>
        <a href="javascript:void(0);" class="icon" onClick="adjustTopnav()"><i class="fa fa-bars"></i></a>
    </nav>
    <main>
        <br>
        <div class="tab-container">
            <div class="tab">
                <button class="tablinks" onClick="openTab(event, 'Year1')">Year 1</button>
                <button class="tablinks" onClick="openTab(event, 'Year2')">Year 2</button>
                <button class="tablinks" onClick="openTab(event, 'Year3')">Year 3</button>
                <button class="tablinks" onClick="openTab(event, 'Year4')">Year 4</button>
            </div>
        </div>

        <br>

        <div id="Year1" class="tabcontent">
            <div class="indicatorsContainer">
                <div class="indicatorBlock">
                    <?php
                            if (isset($_SESSION["UID"])) {
                                $accountID = $_SESSION["UID"];

                                // first, fetch data for CGPA, leadership, graduate aim, professional cert, employability and mobility program
                                $fetchIndicatorQuery = "SELECT * FROM indicator WHERE accountID='".$accountID."' AND indicatorSem=1 AND indicatorYear=1;";
                                $result = mysqli_query($conn, $fetchIndicatorQuery);
                                $row = mysqli_fetch_assoc($result);
                                $indicatorID = $row["indicatorID"];

                                // then, fetch from the 'activity' table the number of activites where activityType = 1 OR 2 OR 3
                                $fetchActivitiesQuery = "SELECT COUNT(*) FROM activity WHERE accountID='".$accountID."' AND activitySem=1 AND activityYear=1 AND activityType IN (1, 2, 3);";
                                $activitiesResult = mysqli_query($conn, $fetchActivitiesQuery);
                                $activitiesRow = mysqli_fetch_assoc($activitiesResult);
                                $activitiesCount = $activitiesRow["COUNT(*)"];

                                // then, fetch from the 'activity' table the number of competitions where activityType = 4
                                $fetchCompetitionsQuery = "SELECT COUNT(*) FROM activity WHERE accountID='".$accountID."' AND activitySem=1 AND activityYear=1 AND activityType=4;";
                                $competitionsResult = mysqli_query($conn, $fetchCompetitionsQuery);
                                $competitionsRow = mysqli_fetch_assoc($competitionsResult);
                                $competitionsCount = $competitionsRow["COUNT(*)"];
                            }
                            else {
                                "ERROR: ".mysqli_error($conn);
                            }
                    ?>
                    <div class="indicatorTopbar">
                        <h4 style="margin: 0;">Semester 1 Year 1</h4>
                        <input class="editButton" onclick="redirect('kpimodule_edit.php?id=<?=$indicatorID;?>')" type="button" value="EDIT">
                    </div>
                    <table class="indicatorTable">
                        <tr><td class="attributeCell"><b>CGPA<b></td><td class="dataCell"><?=$row["indicatorCGPA"];?></td></tr>
                        <tr><td><b>Total Student Activities</b></td><td><?=$activitiesCount;?></td></tr>
                        <tr><td><b>Total Competitions Joined</b></td><td><?=$competitionsCount;?></td></tr>
                        <tr><td><b>Leadership</b><br>As a higher committee member or normal committee member</td><td><?=$row["indicatorLeadership"];?></td></tr>
                        <tr><td><b>Graduate Aim</b><br>Graduate on Time</td><td><?=$row["indicatorGraduateAim"];?></td></tr>
                        <tr><td><b>Professional Certification</b></td><td><?=$row["indicatorProfCert"];?></td></tr>
                        <tr><td><b>Employability</b><br>Within how many months after industrial training</td><td><?=$row["indicatorEmployability"];?></td></tr>
                        <tr><td><b>Mobility Program</b></td><td><?=$row["indicatorMobProg"];?></td></tr>
                    </table>
                </div>
                <br>
                <div class="indicatorBlock">
                    <?php
                        if (isset($_SESSION["UID"])) {
                            $accountID = $_SESSION["UID"];

                            // first, fetch data for CGPA, leadership, graduate aim, professional cert, employability and mobility program
                            $fetchIndicatorQuery = "SELECT * FROM indicator WHERE accountID='".$accountID."' AND indicatorSem=2 AND indicatorYear=1;";
                            $result = mysqli_query($conn, $fetchIndicatorQuery);
                            $row = mysqli_fetch_assoc($result);
                            $indicatorID = $row["indicatorID"];

                            // then, fetch from the 'activity' table the number of activites where activityType = 1 OR 2 OR 3
                            $fetchActivitiesQuery = "SELECT COUNT(*) FROM activity WHERE accountID='".$accountID."' AND activitySem=2 AND activityYear=1 AND activityType IN (1, 2, 3);";
                            $activitiesResult = mysqli_query($conn, $fetchActivitiesQuery);
                            $activitiesRow = mysqli_fetch_assoc($activitiesResult);
                            $activitiesCount = $activitiesRow["COUNT(*)"];

                            // then, fetch from the 'activity' table the number of competitions where activityType = 4
                            $fetchCompetitionsQuery = "SELECT COUNT(*) FROM activity WHERE accountID='".$accountID."' AND activitySem=2 AND activityYear=1 AND activityType=4;";
                            $competitionsResult = mysqli_query($conn, $fetchCompetitionsQuery);
                            $competitionsRow = mysqli_fetch_assoc($competitionsResult);
                            $competitionsCount = $competitionsRow["COUNT(*)"];
                        }
                        else {
                            "ERROR: ".mysqli_error($conn);
                        }
                    ?>
                    <div class="indicatorTopbar">
                        <h4 style="margin: 0;">Semester 2 Year 1</h4>
                        <input class="editButton" onclick="redirect('kpimodule_edit.php?id=<?=$indicatorID;?>')" type="button" value="EDIT">
                    </div>
                    <table class="indicatorTable">
                        <tr><td class="attributeCell"><b>CGPA<b></td><td class="dataCell"><?=$row["indicatorCGPA"];?></td></tr>
                        <tr><td><b>Total Student Activities</b></td><td><?=$activitiesCount;?></td></tr>
                        <tr><td><b>Total Competitions Joined</b></td><td><?=$competitionsCount;?></td></tr>
                        <tr><td><b>Leadership</b><br>As a higher committee member or normal committee member</td><td><?=$row["indicatorLeadership"];?></td></tr>
                        <tr><td><b>Graduate Aim</b><br>Graduate on Time</td><td><?=$row["indicatorGraduateAim"];?></td></tr>
                        <tr><td><b>Professional Certification</b></td><td><?=$row["indicatorProfCert"];?></td></tr>
                        <tr><td><b>Employability</b><br>Within how many months after industrial training</td><td><?=$row["indicatorEmployability"];?></td></tr>
                        <tr><td><b>Mobility Program</b></td><td><?=$row["indicatorMobProg"];?></td></tr>
                    </table>
                </div>
            </div>
            <br>
        </div>

        <div id="Year2" class="tabcontent">
            <div class="indicatorsContainer">
                <div class="indicatorBlock">
                    <?php
                        if (isset($_SESSION["UID"])) {
                            $accountID = $_SESSION["UID"];

                            // first, fetch data for CGPA, leadership, graduate aim, professional cert, employability and mobility program
                            $fetchIndicatorQuery = "SELECT * FROM indicator WHERE accountID='".$accountID."' AND indicatorSem=1 AND indicatorYear=2;";
                            $result = mysqli_query($conn, $fetchIndicatorQuery);
                            $row = mysqli_fetch_assoc($result);
                            $indicatorID = $row["indicatorID"];

                            // then, fetch from the 'activity' table the number of activites where activityType = 1 OR 2 OR 3
                            $fetchActivitiesQuery = "SELECT COUNT(*) FROM activity WHERE accountID='".$accountID."' AND activitySem=1 AND activityYear=2 AND activityType IN (1, 2, 3);";
                            $activitiesResult = mysqli_query($conn, $fetchActivitiesQuery);
                            $activitiesRow = mysqli_fetch_assoc($activitiesResult);
                            $activitiesCount = $activitiesRow["COUNT(*)"];

                            // then, fetch from the 'activity' table the number of competitions where activityType = 4
                            $fetchCompetitionsQuery = "SELECT COUNT(*) FROM activity WHERE accountID='".$accountID."' AND activitySem=1 AND activityYear=2 AND activityType=4;";
                            $competitionsResult = mysqli_query($conn, $fetchCompetitionsQuery);
                            $competitionsRow = mysqli_fetch_assoc($competitionsResult);
                            $competitionsCount = $competitionsRow["COUNT(*)"];
                        }
                        else {
                            "ERROR: ".mysqli_error($conn);
                        }
                    ?>
                    <div class="indicatorTopbar">
                        <h4 style="margin: 0;">Semester 1 Year 2</h4>
                        <input class="editButton" onclick="redirect('kpimodule_edit.php?id=<?=$indicatorID;?>')" type="button" value="EDIT">
                    </div>
                    <table class="indicatorTable">
                        <tr><td class="attributeCell"><b>CGPA<b></td><td class="dataCell"><?=$row["indicatorCGPA"];?></td></tr>
                        <tr><td><b>Total Student Activities</b></td><td><?=$activitiesCount;?></td></tr>
                        <tr><td><b>Total Competitions Joined</b></td><td><?=$competitionsCount;?></td></tr>
                        <tr><td><b>Leadership</b><br>As a higher committee member or normal committee member</td><td><?=$row["indicatorLeadership"];?></td></tr>
                        <tr><td><b>Graduate Aim</b><br>Graduate on Time</td><td><?=$row["indicatorGraduateAim"];?></td></tr>
                        <tr><td><b>Professional Certification</b></td><td><?=$row["indicatorProfCert"];?></td></tr>
                        <tr><td><b>Employability</b><br>Within how many months after industrial training</td><td><?=$row["indicatorEmployability"];?></td></tr>
                        <tr><td><b>Mobility Program</b></td><td><?=$row["indicatorMobProg"];?></td></tr>
                    </table>
                </div>
                <br>
                <div class="indicatorBlock">
                <?php
                        if (isset($_SESSION["UID"])) {
                            $accountID = $_SESSION["UID"];

                            // first, fetch data for CGPA, leadership, graduate aim, professional cert, employability and mobility program
                            $fetchIndicatorQuery = "SELECT * FROM indicator WHERE accountID='".$accountID."' AND indicatorSem=2 AND indicatorYear=2;";
                            $result = mysqli_query($conn, $fetchIndicatorQuery);
                            $row = mysqli_fetch_assoc($result);
                            $indicatorID = $row["indicatorID"];

                            // then, fetch from the 'activity' table the number of activites where activityType = 1 OR 2 OR 3
                            $fetchActivitiesQuery = "SELECT COUNT(*) FROM activity WHERE accountID='".$accountID."' AND activitySem=2 AND activityYear=2 AND activityType IN (1, 2, 3);";
                            $activitiesResult = mysqli_query($conn, $fetchActivitiesQuery);
                            $activitiesRow = mysqli_fetch_assoc($activitiesResult);
                            $activitiesCount = $activitiesRow["COUNT(*)"];

                            // then, fetch from the 'activity' table the number of competitions where activityType = 4
                            $fetchCompetitionsQuery = "SELECT COUNT(*) FROM activity WHERE accountID='".$accountID."' AND activitySem=2 AND activityYear=2 AND activityType=4;";
                            $competitionsResult = mysqli_query($conn, $fetchCompetitionsQuery);
                            $competitionsRow = mysqli_fetch_assoc($competitionsResult);
                            $competitionsCount = $competitionsRow["COUNT(*)"];
                        }
                        else {
                            "ERROR: ".mysqli_error($conn);
                        }
                    ?>
                    <div class="indicatorTopbar">
                        <h4 style="margin: 0;">Semester 2 Year 2</h4>
                        <input class="editButton" onclick="redirect('kpimodule_edit.php?id=<?=$indicatorID;?>')" type="button" value="EDIT">
                    </div>
                    <table class="indicatorTable">
                        <tr><td class="attributeCell"><b>CGPA<b></td><td class="dataCell"><?=$row["indicatorCGPA"];?></td></tr>
                        <tr><td><b>Total Student Activities</b></td><td><?=$activitiesCount;?></td></tr>
                        <tr><td><b>Total Competitions Joined</b></td><td><?=$competitionsCount;?></td></tr>
                        <tr><td><b>Leadership</b><br>As a higher committee member or normal committee member</td><td><?=$row["indicatorLeadership"];?></td></tr>
                        <tr><td><b>Graduate Aim</b><br>Graduate on Time</td><td><?=$row["indicatorGraduateAim"];?></td></tr>
                        <tr><td><b>Professional Certification</b></td><td><?=$row["indicatorProfCert"];?></td></tr>
                        <tr><td><b>Employability</b><br>Within how many months after industrial training</td><td><?=$row["indicatorEmployability"];?></td></tr>
                        <tr><td><b>Mobility Program</b></td><td><?=$row["indicatorMobProg"];?></td></tr>
                    </table>
                </div>
            </div>
            <br>
        </div>

        <div id="Year3" class="tabcontent">
            <div class="indicatorsContainer">
                <div class="indicatorBlock">
                    <?php
                        if (isset($_SESSION["UID"])) {
                            $accountID = $_SESSION["UID"];

                            // first, fetch data for CGPA, leadership, graduate aim, professional cert, employability and mobility program
                            $fetchIndicatorQuery = "SELECT * FROM indicator WHERE accountID='".$accountID."' AND indicatorSem=1 AND indicatorYear=3;";
                            $result = mysqli_query($conn, $fetchIndicatorQuery);
                            $row = mysqli_fetch_assoc($result);
                            $indicatorID = $row["indicatorID"];

                            // then, fetch from the 'activity' table the number of activites where activityType = 1 OR 2 OR 3
                            $fetchActivitiesQuery = "SELECT COUNT(*) FROM activity WHERE accountID='".$accountID."' AND activitySem=1 AND activityYear=3 AND activityType IN (1, 2, 3);";
                            $activitiesResult = mysqli_query($conn, $fetchActivitiesQuery);
                            $activitiesRow = mysqli_fetch_assoc($activitiesResult);
                            $activitiesCount = $activitiesRow["COUNT(*)"];

                            // then, fetch from the 'activity' table the number of competitions where activityType = 4
                            $fetchCompetitionsQuery = "SELECT COUNT(*) FROM activity WHERE accountID='".$accountID."' AND activitySem=1 AND activityYear=3 AND activityType=4;";
                            $competitionsResult = mysqli_query($conn, $fetchCompetitionsQuery);
                            $competitionsRow = mysqli_fetch_assoc($competitionsResult);
                            $competitionsCount = $competitionsRow["COUNT(*)"];
                        }
                        else {
                            "ERROR: ".mysqli_error($conn);
                        }
                    ?>
                    <div class="indicatorTopbar">
                        <h4 style="margin: 0;">Semester 1 Year 3</h4>
                        <input class="editButton" onclick="redirect('kpimodule_edit.php?id=<?=$indicatorID;?>')" type="button" value="EDIT">
                    </div>
                    <table class="indicatorTable">
                        <tr><td class="attributeCell"><b>CGPA<b></td><td class="dataCell"><?=$row["indicatorCGPA"];?></td></tr>
                        <tr><td><b>Total Student Activities</b></td><td><?=$activitiesCount;?></td></tr>
                        <tr><td><b>Total Competitions Joined</b></td><td><?=$competitionsCount;?></td></tr>
                        <tr><td><b>Leadership</b><br>As a higher committee member or normal committee member</td><td><?=$row["indicatorLeadership"];?></td></tr>
                        <tr><td><b>Graduate Aim</b><br>Graduate on Time</td><td><?=$row["indicatorGraduateAim"];?></td></tr>
                        <tr><td><b>Professional Certification</b></td><td><?=$row["indicatorProfCert"];?></td></tr>
                        <tr><td><b>Employability</b><br>Within how many months after industrial training</td><td><?=$row["indicatorEmployability"];?></td></tr>
                        <tr><td><b>Mobility Program</b></td><td><?=$row["indicatorMobProg"];?></td></tr>
                    </table>
                </div>
                <br>
                <div class="indicatorBlock">
                <?php
                        if (isset($_SESSION["UID"])) {
                            $accountID = $_SESSION["UID"];

                            // first, fetch data for CGPA, leadership, graduate aim, professional cert, employability and mobility program
                            $fetchIndicatorQuery = "SELECT * FROM indicator WHERE accountID='".$accountID."' AND indicatorSem=2 AND indicatorYear=3;";
                            $result = mysqli_query($conn, $fetchIndicatorQuery);
                            $row = mysqli_fetch_assoc($result);
                            $indicatorID = $row["indicatorID"];

                            // then, fetch from the 'activity' table the number of activites where activityType = 1 OR 2 OR 3
                            $fetchActivitiesQuery = "SELECT COUNT(*) FROM activity WHERE accountID='".$accountID."' AND activitySem=2 AND activityYear=3 AND activityType IN (1, 2, 3);";
                            $activitiesResult = mysqli_query($conn, $fetchActivitiesQuery);
                            $activitiesRow = mysqli_fetch_assoc($activitiesResult);
                            $activitiesCount = $activitiesRow["COUNT(*)"];

                            // then, fetch from the 'activity' table the number of competitions where activityType = 4
                            $fetchCompetitionsQuery = "SELECT COUNT(*) FROM activity WHERE accountID='".$accountID."' AND activitySem=2 AND activityYear=3 AND activityType=4;";
                            $competitionsResult = mysqli_query($conn, $fetchCompetitionsQuery);
                            $competitionsRow = mysqli_fetch_assoc($competitionsResult);
                            $competitionsCount = $competitionsRow["COUNT(*)"];
                        }
                        else {
                            "ERROR: ".mysqli_error($conn);
                        }
                    ?>
                    <div class="indicatorTopbar">
                        <h4 style="margin: 0;">Semester 2 Year 3</h4>
                        <input class="editButton" onclick="redirect('kpimodule_edit.php?id=<?=$indicatorID;?>')" type="button" value="EDIT">
                    </div>
                    <table class="indicatorTable">
                        <tr><td class="attributeCell"><b>CGPA<b></td><td class="dataCell"><?=$row["indicatorCGPA"];?></td></tr>
                        <tr><td><b>Total Student Activities</b></td><td><?=$activitiesCount;?></td></tr>
                        <tr><td><b>Total Competitions Joined</b></td><td><?=$competitionsCount;?></td></tr>
                        <tr><td><b>Leadership</b><br>As a higher committee member or normal committee member</td><td><?=$row["indicatorLeadership"];?></td></tr>
                        <tr><td><b>Graduate Aim</b><br>Graduate on Time</td><td><?=$row["indicatorGraduateAim"];?></td></tr>
                        <tr><td><b>Professional Certification</b></td><td><?=$row["indicatorProfCert"];?></td></tr>
                        <tr><td><b>Employability</b><br>Within how many months after industrial training</td><td><?=$row["indicatorEmployability"];?></td></tr>
                        <tr><td><b>Mobility Program</b></td><td><?=$row["indicatorMobProg"];?></td></tr>
                    </table>
                </div>
            </div>
            <br>
        </div>

        <div id="Year4" class="tabcontent">
            <div class="indicatorsContainer">
                <div class="indicatorBlock">
                    <?php
                        if (isset($_SESSION["UID"])) {
                            $accountID = $_SESSION["UID"];

                            // first, fetch data for CGPA, leadership, graduate aim, professional cert, employability and mobility program
                            $fetchIndicatorQuery = "SELECT * FROM indicator WHERE accountID='".$accountID."' AND indicatorSem=1 AND indicatorYear=4;";
                            $result = mysqli_query($conn, $fetchIndicatorQuery);
                            $row = mysqli_fetch_assoc($result);
                            $indicatorID = $row["indicatorID"];

                            // then, fetch from the 'activity' table the number of activites where activityType = 1 OR 2 OR 3
                            $fetchActivitiesQuery = "SELECT COUNT(*) FROM activity WHERE accountID='".$accountID."' AND activitySem=1 AND activityYear=4 AND activityType IN (1, 2, 3);";
                            $activitiesResult = mysqli_query($conn, $fetchActivitiesQuery);
                            $activitiesRow = mysqli_fetch_assoc($activitiesResult);
                            $activitiesCount = $activitiesRow["COUNT(*)"];

                            // then, fetch from the 'activity' table the number of competitions where activityType = 4
                            $fetchCompetitionsQuery = "SELECT COUNT(*) FROM activity WHERE accountID='".$accountID."' AND activitySem=1 AND activityYear=4 AND activityType=4;";
                            $competitionsResult = mysqli_query($conn, $fetchCompetitionsQuery);
                            $competitionsRow = mysqli_fetch_assoc($competitionsResult);
                            $competitionsCount = $competitionsRow["COUNT(*)"];
                        }
                        else {
                            "ERROR: ".mysqli_error($conn);
                        }
                    ?>
                    <div class="indicatorTopbar">
                        <h4 style="margin: 0;">Semester 1 Year 4</h4>
                        <input class="editButton" onclick="redirect('kpimodule_edit.php?id=<?=$indicatorID;?>')" type="button" value="EDIT">
                    </div>
                    <table class="indicatorTable">
                        <tr><td class="attributeCell"><b>CGPA<b></td><td class="dataCell"><?=$row["indicatorCGPA"];?></td></tr>
                        <tr><td><b>Total Student Activities</b></td><td><?=$activitiesCount;?></td></tr>
                        <tr><td><b>Total Competitions Joined</b></td><td><?=$competitionsCount;?></td></tr>
                        <tr><td><b>Leadership</b><br>As a higher committee member or normal committee member</td><td><?=$row["indicatorLeadership"];?></td></tr>
                        <tr><td><b>Graduate Aim</b><br>Graduate on Time</td><td><?=$row["indicatorGraduateAim"];?></td></tr>
                        <tr><td><b>Professional Certification</b></td><td><?=$row["indicatorProfCert"];?></td></tr>
                        <tr><td><b>Employability</b><br>Within how many months after industrial training</td><td><?=$row["indicatorEmployability"];?></td></tr>
                        <tr><td><b>Mobility Program</b></td><td><?=$row["indicatorMobProg"];?></td></tr>
                    </table>
                </div>
                <br>
                <div class="indicatorBlock">
                <?php
                        if (isset($_SESSION["UID"])) {
                            $accountID = $_SESSION["UID"];

                            // first, fetch data for CGPA, leadership, graduate aim, professional cert, employability and mobility program
                            $fetchIndicatorQuery = "SELECT * FROM indicator WHERE accountID='".$accountID."' AND indicatorSem=2 AND indicatorYear=4;";
                            $result = mysqli_query($conn, $fetchIndicatorQuery);
                            $row = mysqli_fetch_assoc($result);
                            $indicatorID = $row["indicatorID"];

                            // then, fetch from the 'activity' table the number of activites where activityType = 1 OR 2 OR 3
                            $fetchActivitiesQuery = "SELECT COUNT(*) FROM activity WHERE accountID='".$accountID."' AND activitySem=2 AND activityYear=4 AND activityType IN (1, 2, 3);";
                            $activitiesResult = mysqli_query($conn, $fetchActivitiesQuery);
                            $activitiesRow = mysqli_fetch_assoc($activitiesResult);
                            $activitiesCount = $activitiesRow["COUNT(*)"];

                            // then, fetch from the 'activity' table the number of competitions where activityType = 4
                            $fetchCompetitionsQuery = "SELECT COUNT(*) FROM activity WHERE accountID='".$accountID."' AND activitySem=2 AND activityYear=4 AND activityType=4;";
                            $competitionsResult = mysqli_query($conn, $fetchCompetitionsQuery);
                            $competitionsRow = mysqli_fetch_assoc($competitionsResult);
                            $competitionsCount = $competitionsRow["COUNT(*)"];
                        }
                        else {
                            "ERROR: ".mysqli_error($conn);
                        }
                    ?>
                    <div class="indicatorTopbar">
                        <h4 style="margin: 0;">Semester 2 Year 4</h4>
                        <input class="editButton" onclick="redirect('kpimodule_edit.php?id=<?=$indicatorID;?>')" type="button" value="EDIT">
                    </div>
                    <table class="indicatorTable">
                        <tr><td class="attributeCell"><b>CGPA<b></td><td class="dataCell"><?=$row["indicatorCGPA"];?></td></tr>
                        <tr><td><b>Total Student Activities</b></td><td><?=$activitiesCount;?></td></tr>
                        <tr><td><b>Total Competitions Joined</b></td><td><?=$competitionsCount;?></td></tr>
                        <tr><td><b>Leadership</b><br>As a higher committee member or normal committee member</td><td><?=$row["indicatorLeadership"];?></td></tr>
                        <tr><td><b>Graduate Aim</b><br>Graduate on Time</td><td><?=$row["indicatorGraduateAim"];?></td></tr>
                        <tr><td><b>Professional Certification</b></td><td><?=$row["indicatorProfCert"];?></td></tr>
                        <tr><td><b>Employability</b><br>Within how many months after industrial training</td><td><?=$row["indicatorEmployability"];?></td></tr>
                        <tr><td><b>Mobility Program</b></td><td><?=$row["indicatorMobProg"];?></td></tr>
                    </table>
                </div>
            </div>
            <br>
        </div>
        <?php
                mysqli_close($conn);
        ?>
    </main>
    <footer>
        <h5>© Chiew Cheng Yi | BI21110236 | KK34703 Individual Project</h5>
    </footer>
<body>

</html>