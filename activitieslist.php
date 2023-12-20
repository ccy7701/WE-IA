<?php
    session_start();
    include("include/config.php");
?>

<!DOCTYPE HTML>
<html lang="en">

<html>

<head>
    <title>Activities List | MyStudyKPI </title>
    <meta charset="utf8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Jost">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="sitejavascript.js"></script>
    <script type="text/javascript">
        function createPath(target) {
            let scriptPath = "action_scripts/activitieslist_remove_action.php?id=";
            let overallPath = scriptPath.concat(target);
            return overallPath;
        }
        function confirmRemoval(target_id) {
            var promptConfirm = confirm("Are you sure you want to remove this record?");

            if (promptConfirm) {
                // if OK is clicked, redirect to activitieslist_remove_action. with the target id
                var path = createPath(target_id);
                window.location.href = path;
            }
        }
    </script>
        <script type="text/javascript">
        function openTab(evt, activityType) {
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
            var selectedTab = document.getElementById(activityType);
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
        #searchBar {
            text-align: right;
            font-family: Jost, monospace;
        }
        .tabcontent {
            display: none;
            padding: 6px 10px;
            border: 1px solid #888888;
            transition: opacity 0.2s ease;
            width: 100%;
            box-sizing: border-box;
        }
        #activitiesTable-container {
            padding-left: 5%;
            padding-right: 5%;
            width: 100%;
            box-sizing: border-box;
        }
        #activitiesTable {
            border: 1px solid black;
            width: 100%;
            box-sizing: border-box;
        }
        #activitiesTable th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: center;
            background-color: #EAE1A8;
        }
        #activitiesTable tr {
            transition: background-color 0.1s, color 0.1s;
        }
        #activitiesTable tr:nth-child(odd) {
            background-color: #DDDDDD;
        }
        #activitiesTable tr:hover {
            background-color: #C8B4BA;
            font-weight: bold;
        }
        #activitiesTable #edit, #remove, #image {
            text-decoration: none;
            color: black;
            transition: color 0.1s;
        }
        #activitiesTable #edit:hover {
            cursor: pointer;
            color: #3BB143;
        }
        #activitiesTable #remove:hover {
            cursor: pointer;
            color: #FF0000;
        }
        #activitiesTable #image:hover {
            cursor: pointer;
            color: #1E90FF;
        }
        #activitiesForm-container {
            padding-top: 10px;
            padding-left: 20%;
            padding-right: 20%;
            background-color: #D3D3D3;
        }
        #activitiesForm select {
            height: 30px;
            width: 40%;
            display: block;
        }
        #activitiesForm textarea {
            height: 100px;
            width: 100%;
            resize: none;
            display: block;
        }
        #btnactivity {
            width: 30%;
            height: 30px;
            font-size: 18px;
            background-color: white;
            border: 1px solid grey;
            transition: background-color 0.1s, color 0.1s;
        }
        #btnactivity:hover {
            cursor: pointer;
            background-color: #333333;
            color: white;
        }
        @media screen and (max-width: 600px) {
            .tab button {
                width: 25%;
            }
            #activitiesTable-container {
                padding-left: 2%;
                padding-right: 2%;
                overflow-x: auto;
            }
            #activitiesForm-container {
                padding-left: 10%;
                padding-right: 10%;
            }
            #activitiesForm select {
                width: 50%;
            }
        }
    </style>
</head>

<body>
    <header>
        <img class="header" src="images/activitieslistheader.png">
    </header>
    <nav class="topnav" id="myTopnav">
        <a href="index.php" class="logo"><img src="images/mystudykpi-topnavbtn-2-white.png"></a>
        <a href="aboutme.php" class="tabs">About Me</a>
        <a href="kpimodule.php" class="tabs">MyKPI Indicator Module</a>
        <a href="activitieslist.php" class="active">Activities List</a>
        <a href="challenges.php" class="tabs">Challenges and Future Plans</a>
        <a href="logout.php" class="tabs">Logout</a>
        <a href="javascript:void(0);" class="icon" onClick="adjustTopnav()"><i class="fa fa-bars"></i></a>
    </nav>
    <main>
        <?php
            if (isset($_SESSION["UID"])) {
                $accountID = $_SESSION["UID"];
            }
        ?>
        <br>
        <div class="tab-container">
            <div class="tab">
                <button class="tablinks" onClick="openTab(event, 'Activities')">Activities</button>
                <button class="tablinks" onClick="openTab(event, 'Clubs')">Clubs</button>
                <button class="tablinks" onClick="openTab(event, 'Associations')">Associations</button>
                <button class="tablinks" onClick="openTab(event, 'Competitions')">Competitions</button>
            </div>
            <br>
            <form id="searchBar" action="activitieslist_search.php" method="POST">
                <input type="text" placeholder="Search..." name="search" style="width: 30%;">
                <input type="submit" value="Search">
            </form>
            <br>
            <div id="Activities" class="tabcontent">
                <br>
                <div id="activitiesTable-container">
                    <table id="activitiesTable">
                        <?php
                            $fetchActivitiesQuery = "SELECT * FROM activity WHERE accountID='".$accountID."' AND activityType='1'";
                            $activitiesResult = mysqli_query($conn, $fetchActivitiesQuery);
                            if (mysqli_num_rows($activitiesResult) > 0) {
                                echo "
                                    <tr>
                                        <th>No.</th>
                                        <th>Session</th>
                                        <th>Level</th>
                                        <th>Details</th>
                                        <th>Remarks</th>
                                        <th>Image</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                ";

                                $rowIndex = 1;

                                while ($row = mysqli_fetch_assoc($activitiesResult)) {
                                    $editID = $removeID = $imageID = $row["activityID"];

                                    // this block is to determine the output for activityLevel
                                    $levelOutput = '';
                                    switch($row["activityLevel"]) {
                                        case "1": $levelOutput = "Faculty"; break;
                                        case "2": $levelOutput = "University"; break;
                                        case "3": $levelOutput = "National"; break;
                                        case "4": $levelOutput = "International"; break;
                                        default: $levelOutput = "";
                                    }

                                    echo "
                                        <tr>
                                            <td>".$rowIndex."</td>
                                            <td>Sem ".$row["activitySem"]." Year ".$row["activityYear"]."</td>
                                            <td>".$levelOutput."</td>
                                            <td>".$row["activityDetails"]."</td>
                                            <td>".$row["activityRemarks"]."</td>
                                    ";

                                    if ($row["activityImagePath"] != '') {
                                        echo "
                                            <td style='text-align: center'>
                                                <a id='image' title='Open image' href='show_activity_image.php?id=".$imageID."' target='blank'><i class='fa fa-image'></i></a>
                                            </td>
                                        ";
                                    }
                                    else {
                                        echo "<td>&nbsp;</td>";
                                    }

                                    echo "
                                        <td style='text-align: center'>
                                            <a id='edit' title='Edit' href='activitieslist_edit.php?id=".$editID."'><i class='fa fa-pencil-square-o'></i></a>
                                            <a id='remove' title='Remove' onclick='confirmRemoval($removeID)'><i class='fa fa-trash-o'></i></a>
                                        </td>
                                    ";

                                    $rowIndex++;
                                }
                            }
                            else {  // if the query returns no rows
                                echo "
                                    <tr>
                                        <th>No.</th>
                                        <th>Session</th>
                                        <th>Level</th>
                                        <th>Details</th>
                                        <th>Remarks</th>
                                        <th>Image</th>
                                    </tr>
                                    <tr>
                                        <td colspan='6'>No activities have been added yet.</td>
                                    </tr>
                                ";
                            }
                        ?>
                    </table>
                </div>
                <br>
            </div>
            <div id="Clubs" class="tabcontent">
                <br>
                <div id="activitiesTable-container">
                    <table id="activitiesTable">
                        <?php
                            $fetchClubsQuery = "SELECT * FROM activity WHERE accountID='".$accountID."' AND activityType='2'";
                            $clubsResult = mysqli_query($conn, $fetchClubsQuery);
                            if (mysqli_num_rows($clubsResult) > 0) {
                                echo "
                                    <tr>
                                        <th>No.</th>
                                        <th>Session</th>
                                        <th>Level</th>
                                        <th>Details</th>
                                        <th>Remarks</th>
                                        <th>Image</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                ";

                                $rowIndex = 1;

                                while ($row = mysqli_fetch_assoc($clubsResult)) {
                                    $editID = $removeID = $imageID = $row["activityID"];

                                    // this block is to determine the output for activityLevel
                                    $levelOutput = '';
                                    switch($row["activityLevel"]) {
                                        case "1": $levelOutput = "Faculty"; break;
                                        case "2": $levelOutput = "University"; break;
                                        case "3": $levelOutput = "National"; break;
                                        case "4": $levelOutput = "International"; break;
                                        default: $levelOutput = "";
                                    }

                                    echo "
                                        <tr>
                                            <td>".$rowIndex."</td>
                                            <td>Sem ".$row["activitySem"]." Year ".$row["activityYear"]."</td>
                                            <td>".$levelOutput."</td>
                                            <td>".$row["activityDetails"]."</td>
                                            <td>".$row["activityRemarks"]."</td>
                                    ";

                                    if ($row["activityImagePath"] != '') {
                                        echo "
                                            <td style='text-align: center'>
                                                <a id='image' title='Open image' href='show_activity_image.php?id=".$imageID."' target='blank'><i class='fa fa-image'></i></a>
                                            </td>
                                        ";
                                    }
                                    else {
                                        echo "<td>&nbsp;</td>";
                                    }

                                    echo "
                                        <td style='text-align: center'>
                                            <a id='edit' title='Edit' href='activitieslist_edit.php?id=".$editID."'><i class='fa fa-pencil-square-o'></i></a>
                                            <a id='remove' title='Remove' onclick='confirmRemoval($removeID)'><i class='fa fa-trash-o'></i></a>
                                        </td>
                                    ";
                                }
                            }
                            else {  // if the query returns no rows
                                echo "
                                    <tr>
                                        <th>No.</th>
                                        <th>Session</th>
                                        <th>Level</th>
                                        <th>Details</th>
                                        <th>Remarks</th>
                                        <th>Image</th>
                                    </tr>
                                    <tr>
                                        <td colspan='6'>No clubs-related activities have been added yet.</td>
                                    </tr>
                                ";
                            }
                        ?>
                    </table>
                </div>
                <br>
            </div>
            <div id="Associations" class="tabcontent">
                <br>
                <div id="activitiesTable-container">
                    <table id="activitiesTable">
                        <?php
                            $fetchAssociationsQuery = "SELECT * FROM activity WHERE accountID='".$accountID."' AND activityType='3'";
                            $associationsResult = mysqli_query($conn, $fetchAssociationsQuery);
                            if (mysqli_num_rows($associationsResult) > 0) {
                                echo "
                                    <tr>
                                        <th>No.</th>
                                        <th>Session</th>
                                        <th>Level</th>
                                        <th>Details</th>
                                        <th>Remarks</th>
                                        <th>Image</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                ";

                                $rowIndex = 1;

                                while ($row = mysqli_fetch_assoc($associationsResult)) {
                                    $editID = $removeID = $imageID = $row["activityID"];

                                    // this block is to determine the output for activityLevel
                                    $levelOutput = '';
                                    switch($row["activityLevel"]) {
                                        case "1": $levelOutput = "Faculty"; break;
                                        case "2": $levelOutput = "University"; break;
                                        case "3": $levelOutput = "National"; break;
                                        case "4": $levelOutput = "International"; break;
                                        default: $levelOutput = "";
                                    }

                                    echo "
                                        <tr>
                                            <td>".$rowIndex."</td>
                                            <td>Sem ".$row["activitySem"]." Year ".$row["activityYear"]."</td>
                                            <td>".$levelOutput."</td>
                                            <td>".$row["activityDetails"]."</td>
                                            <td>".$row["activityRemarks"]."</td>
                                    ";

                                    if ($row["activityImagePath"] != '') {
                                        echo "
                                            <td style='text-align: center'>
                                                <a id='image' title='Open image' href='show_activity_image.php?id=".$imageID."' target='blank'><i class='fa fa-image'></i></a>
                                            </td>
                                        ";
                                    }
                                    else {
                                        echo "<td>&nbsp;</td>";
                                    }

                                    echo "
                                        <td style='text-align: center'>
                                            <a id='edit' title='Edit' href='activitieslist_edit.php?id=".$editID."'><i class='fa fa-pencil-square-o'></i></a>
                                            <a id='remove' title='Remove' onclick='confirmRemoval($removeID)'><i class='fa fa-trash-o'></i></a>
                                        </td>
                                    ";
                                }
                            }
                            else {  // if the query returns no rows
                                echo "
                                    <tr>
                                        <th>No.</th>
                                        <th>Session</th>
                                        <th>Level</th>
                                        <th>Details</th>
                                        <th>Remarks</th>
                                        <th>Image</th>
                                    </tr>
                                    <tr>
                                        <td colspan='6'>No associations-related activities have been added yet.</td>
                                    </tr>
                                ";
                            }
                        ?>
                    </table>
                </div>
                <br>
            </div>
            <div id="Competitions" class="tabcontent">
                <br>
                <div id="activitiesTable-container">
                    <table id="activitiesTable">
                        <?php
                            $fetchCompetitionsQuery = "SELECT * FROM activity WHERE accountID='".$accountID."' AND activityType='4'";
                            $competitionsResult = mysqli_query($conn, $fetchCompetitionsQuery);
                            if (mysqli_num_rows($competitionsResult) > 0) {
                                echo "
                                    <tr>
                                        <th>No.</th>
                                        <th>Session</th>
                                        <th>Level</th>
                                        <th>Details</th>
                                        <th>Remarks</th>
                                        <th>Image</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                ";

                                $rowIndex = 1;

                                while ($row = mysqli_fetch_assoc($competitionsResult)) {
                                    $editID = $removeID = $imageID = $row["activityID"];

                                    // this block is to determine the output for activityLevel
                                    $levelOutput = '';
                                    switch($row["activityLevel"]) {
                                        case "1": $levelOutput = "Faculty"; break;
                                        case "2": $levelOutput = "University"; break;
                                        case "3": $levelOutput = "National"; break;
                                        case "4": $levelOutput = "International"; break;
                                        default: $levelOutput = "";
                                    }

                                    echo "
                                        <tr>
                                            <td>".$rowIndex."</td>
                                            <td>Sem ".$row["activitySem"]." Year ".$row["activityYear"]."</td>
                                            <td>".$levelOutput."</td>
                                            <td>".$row["activityDetails"]."</td>
                                            <td>".$row["activityRemarks"]."</td>
                                    ";

                                    if ($row["activityImagePath"] != '') {
                                        echo "
                                            <td style='text-align: center'>
                                                <a id='image' title='Open image' href='show_activity_image.php?id=".$imageID."' target='blank'><i class='fa fa-image'></i></a>
                                            </td>
                                        ";
                                    }
                                    else {
                                        echo "<td>&nbsp;</td>";
                                    }

                                    echo "
                                        <td style='text-align: center'>
                                            <a id='edit' title='Edit' href='activitieslist_edit.php?id=".$editID."'><i class='fa fa-pencil-square-o'></i></a>
                                            <a id='remove' title='Remove' onclick='confirmRemoval($removeID)'><i class='fa fa-trash-o'></i></a>
                                        </td>
                                    ";
                                }
                            }
                            else {  // if the query returns no rows
                                echo "
                                    <tr>
                                        <th>No.</th>
                                        <th>Session</th>
                                        <th>Level</th>
                                        <th>Details</th>
                                        <th>Remarks</th>
                                        <th>Image</th>
                                    </tr>
                                    <tr>
                                        <td colspan='6'>No associations-related activities have been added yet.</td>
                                    </tr>
                                ";
                            }

                            mysqli_close($conn);
                        ?>
                    </table>
                </div>
                <br>
            </div>
            <br>
        </div>
        <div id="activitiesForm-container">
            <form id="activitiesForm" action="action_scripts/activitieslist_submit_action.php" method="POST" enctype="multipart/form-data">
                <p style="text-align: center">Have a new activity to add? Fill the form below and record it here. <br> Required fields are marked (*)</p>
        
                <label for="activitySem">Semester (*)</label><br>
                <select id="activitySem" name="activitySem" required>
                    <option value="" disabled selected>Select a Semester...</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                </select><br>

                <label for="activityYear">Year (*)</label><br>
                <select id="activityYear" name="activityYear" required>
                    <option value="" disabled selected>Select a Year...</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                </select><br>

                <label for="activityType">Activity Type (*)</label><br>
                <select id="activityType" name="activityType" required>
                    <option value="" disabled selected>Select an Activity Type...</option>
                    <option value="1">Activity</option>
                    <option value="2">Club</option>
                    <option value="3">Association</option>
                    <option value="4">Competition</option>
                </select><br>

                <label for="activityLevel">Activity Level (*)</label><br>
                <select id="activityLevel" name="activityLevel" required>
                    <option value="" disabled selected>Select an Activity Level...</option>
                    <option value="1">Faculty</option>
                    <option value="2">University</option>
                    <option value="3">National</option>
                    <option value="4">International</option>
                </select><br>

                <label for="activityDetails">Details (*)</label><br>
                <textarea name="activityDetails" rows="5" columns="50" required></textarea><br>

                <label for="activityRemarks">Remarks</label><br>
                <textarea name="activityRemarks" rows="5" columns="50"></textarea><br>

                <p>Upload activity image here (max. 2MB):</p>
                <input type="file" name="activityImageToUpload" accept=".jpg, .jpeg, .png"><br>

                <div id="center-content" style="text-align: center">
                    <br>
                    <input id="btnactivity" name="btnsubmit" type="submit" value="Add">
                    <input id="btnactivity" name="btnreset" type="reset" value="Reset">
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