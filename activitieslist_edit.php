<?php
    session_start();
    include("include/config.php");
?>

<!DOCTYPE HTML>
<html lang="en">

<html>

<head>
    <title>Edit Activity Record</title>
    <meta charset="utf8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Jost">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="sitejavascript.js"></script>
    <style>
        #editActivityRecord-container {
            align: center;
            padding-left: 30%;
            padding-right: 30%;
        }
        #editActivityRecord {
            width: 100%;
            border-collapse: collapse;
        }
        #btneditactivity {
            width: 30%;
            height: 30px;
            font-family: Jost, monospace;
            font-size: 18px;
            background-color: white;
            border: 1px solid grey;
            transition: background-color 0.1s, color 0.1s;
        }
        #btneditactivity:hover {
            cursor: pointer;
            background-color: #333333;
            color: white;
        }
        #editActivityRecord textarea {
            height: 100px;
            width: 100%;
            font-family: Jost, monospace;
            resize: none;
            display: block;
            font-size: 18px;
        }
        @media screen and (max-width: 600px) {
            #editChallengeRecord-container {
                padding-left: 10%;
                padding-right: 10%;
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
        <h3 style="text-align: center">Edit Activity Record</h3>
        <?php
            if (isset($_GET["id"]) && $_GET["id"] != "") {
                $id = $_GET["id"];
                $fetchRecordQuery = "SELECT * FROM activity WHERE activityID=".$id;
                $result = mysqli_query($conn, $fetchRecordQuery);
                $row = mysqli_fetch_assoc($result);

                // fetch the data to populate the form
                $activityID = $row["activityID"];
                $activitySem = $row["activitySem"];
                $activityYear = $row["activityYear"];
                $activityType = $row["activityType"];
                $activityLevel = $row["activityLevel"];
                $activityDetails = $row["activityDetails"];
                $activityRemarks = $row["activityRemarks"];

                // this block is to determine the output for activityType
                $typeOutput = '';
                switch($activityType) {
                    case "1": $typeOutput = "Activity"; break;
                    case "2": $typeOutput = "Club"; break;
                    case "3": $typeOutput = "Association"; break;
                    case "4": $typeOutput = "Competition"; break;
                    default: $typeOutput = "";
                }

                // this block is to determine the output for activityLevel
                $levelOutput = '';
                switch($row["activityLevel"]) {
                    case "1": $levelOutput = "Faculty"; break;
                    case "2": $levelOutput = "University"; break;
                    case "3": $levelOutput = "National"; break;
                    case "4": $levelOutput = "International"; break;
                    default: $levelOutput = "";
                }

                mysqli_close($conn);
            }
        ?>
        <div id="editActivityRecord-container">
            <form id="editActivityRecord" action="action_scripts/activitieslist_edit_action.php" method="POST" enctype="multipart/form-data">
                <input name="activityID" type="text" value="<?=$activityID;?>" hidden>
                
                <label for="activitySem">Semester</label>
                <select id="select" name="activitySem">
                    <option value="<?=$activitySem;?>">Currently selected: <?=$activitySem;?></option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                </select><br>

                <label for="activityYear">Year</label>
                <select id="select" name="activityYear">
                    <option value="<?=$activityYear;?>">Currently selected: <?=$activityYear;?></option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                </select><br>

                <label for="activityType">Activity Type</label>
                <select id="select" name="activityType">
                    <option value="<?=$activityType;?>">Currently selected: <?=$typeOutput;?></option>
                    <option value="1">Activity</option>
                    <option value="2">Club</option>
                    <option value="3">Association</option>
                    <option value="4">Competition</option>
                </select><br>

                <label for="activityLevel">Activity Level</label>
                <select id="select" name="activityLevel">
                    <option value="<?=$activityLevel;?>">Currently selected: <?=$levelOutput;?></option>
                    <option value="1">Faculty</option>
                    <option value="2">University</option>
                    <option value="3">National</option>
                    <option value="4">International</option>
                </select><br>

                <label for="activityDetails">Details</label>
                <textarea name="activityDetails" rows="5" columns="50"><?=$activityDetails;?></textarea><br>

                <label for="activityRemarks">Remarks</label>
                <textarea name="activityRemarks" rows="5" columns="50"><?=$activityRemarks;?></textarea><br>
            
                <p>Upload new activity image here (max. 2MB):</p>
                <input id="activityImageToUpload" type="file" name="activityImageToUpload" accept=".jpg, .jpeg, .png"><br><br>
            
                <div id="center-content" style="text-align: center">
                    <input id="btneditactivity" name="btnsubmit" type="submit" value="EDIT">
                    <input id="btneditactivity" name="btnreset" type="reset" value="RESET">
                    <input id="btneditactivity" name="btncancel" type="button" onClick="redirect('activitieslist.php');" value="CANCEL">
                    <br><br>
                </div>
            </form>
        </div>
    </main>
    <footer>
        <h5>© Chiew Cheng Yi | BI21110236 | KK34703 Individual Project</h5>
    </footer>
</body>

</html>a