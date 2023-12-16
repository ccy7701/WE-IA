<?php
    session_start();
    include("include/config.php");
?>

<!DOCTYPE HTML>
<html lang="en">

<html>

<head>
    <title>Edit Challenge Record</title>
    <meta charset="utf8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Jost">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="sitejavascript.js"></script>
    <style>
        #editChallengeRecord-container {
            align: center;
            padding-left: 30%;
            padding-right: 30%;
        }
        #editChallengeRecord {
            width: 100%;
            border-collapse: collapse;
        }
        #editChallengeRecord #recorddate {
            height: 30px;
            width: 50%;
            display: block;
            font-family: Jost, monospace;
        }
        #btneditchallenge {
            width: 30%;
            height: 30px;
            font-family: Jost, monospace;
            font-size: 18px;
            background-color: white;
            border: 1px solid grey;
            transition: background-color 0.1s, color 0.1s;
        }
        #btneditchallenge:hover {
            cursor: pointer;
            background-color: #333333;
            color: white;
        }
        #editChallengeRecord textarea {
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
        <img class="header" src="images/challengesheader.png">
    </header>
    <nav class="topnav" id="myTopnav">
        <a href="index.php" class="logo"><img src="images/mystudykpi-topnavbtn-2-white.png"></a>
        <a href="aboutme.php" class="tabs">About Me</a>
        <a href="kpimodule.php" class="tabs">MyKPI Indicator Module</a>
        <a href="activitieslist.php" class="tabs">Activities List</a>
        <a href="challenges.php" class="active">Challenges and Future Plans</a>
        <a href="logout.php" class="tabs">Logout</a>
        <a href="javascript:void(0);" class="icon" onClick="adjustTopnav()"><i class="fa fa-bars"></i></a>
    </nav>
    <main>
        <h3 style="text-align: center">Edit Challenge Record</h3>
        <?php
            if (isset($_GET["id"]) && $_GET["id"] != "") {
                $id = $_GET["id"];
                $fetchRecordQuery = "SELECT * FROM challenge WHERE challengeID=".$id;
                $result = mysqli_query($conn, $fetchRecordQuery);
                $row = mysqli_fetch_assoc($result);

                // fetch the data to populate the form
                $challengeID = $row["challengeID"];
                $challengeSem = $row["challengeSem"];
                $challengeYear = $row["challengeYear"];
                $challengeDetails = $row["challengeDetails"];
                $challengeFuturePlan = $row["challengeFuturePlan"];
                $challengeRemark = $row["challengeRemark"];

                mysqli_close($conn);
            }
        ?>
        <div id="editChallengeRecord-container">
            <form id="editChallengeRecord" action="action_scripts/challenge_edit_action.php" method="POST" enctype="multipart/form-data">
                <input name="challengeID" type="text" value="challengeID" hidden>

                <label for="challengeSem">Semester</label>
                <select id="select" name="challengeSemester">
                    <option value="<?=$challengeSem;?>">Currently selected: <?=$challengeSem;?></option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                </select><br>

                <label for="challengeYear">Year</label>
                <select id="select" name="challengeYear">
                    <option value="<?=$challengeYear;?>">Currently selected: <?=$challengeYear;?></option>
                    <option value="2021/2022">2021/2022</option>
                    <option value="2022/2023">2022/2023</option>
                    <option value="2023/2024">2023/2024</option>
                    <option value="2024/2025">2024/2025</option>
                </select><br>

                <label for="challengeDetails">Challenge Details</label>
                <textarea name="challengeDetails" rows="5" columns="50"><?=$challengeDetails;?></textarea><br>

                <label for="challengeFuturePlan">Future Plan</label>
                <textarea name="challengeFuturePlan" rows="5" columns="50"><?=$challengeFuturePlan;?></textarea><br>

                <label for="challengeRemark">Remarks</label>
                <textarea name="challengeRemark" rows="5" columns="50"><?=$challengeRemark;?></textarea><br>
            
                <p>Upload new challenge image here:</p>
                <input id="challengeImageToUpload" type="file" name="challengeImageToUpload" accept=".jpg, .jpeg, .png"><br><br>

                <center>
                    <input id="btneditchallenge" name="btnsubmit" type="submit" value="EDIT">
                    <input id="btneditchallenge" name="btnreset" type="reset" value="RESET">
                    <input id="btneditchallenge" name="btncancel" type="button" onClick="redirect('challenges.php');" value="CANCEL">
                    <br><br>
                </center>
            </form>
        </div>
    </main>
    <footer>
        <h5>© Chiew Cheng Yi | BI21110236 | KK34703 Individual Project</h5>
    </footer>
</body>

</html>