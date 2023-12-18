<?php
    // NEW ADDITIONS TO CHALLENGES:
    // 1. Search function
    // 2. Photos column
?>

<?php
    session_start();
    include("include/config.php");
?>

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
    <script type="text/javascript">
        function createPath(target) {
            let scriptPath = "action_scripts/challenge_remove_action.php?id=";
            let overallPath = scriptPath.concat(target);
            return overallPath;
        }
        function confirmRemoval(target_id) {
            var promptConfirm = confirm("Are you sure you want to remove this record?");

            if (promptConfirm) {
                // if OK is clicked, redirect to challenge_remove_action with the target id
                var path = createPath(target_id);
                window.location.href = path;
            }
            // do nothing otherwise
        }
    </script>
    <style>
    #challengesTable-container {
        padding-left: 30px;
        padding-right: 30px;
    }
    #challengesTable {
        font-family: "Jost";
        border: 1px solid black;
        width: 100%;
    }
    #challengesTable th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: center;
        background-color: #F7D8BA;
        color: #000000;
    }
    #challengesTable tr {
        transition: background-color 0.1s, color 0.1s;
    }
    #challengesTable tr:nth-child(odd) {
        background-color: #DDDDDD;
    }
    #challengesTable tr:hover {
        background-color: #C8B4BA;
        font-weight: bold;
    }
    #challengeForm-container {
        padding-top: 10px;
        padding-left: 20%;
        padding-right: 20%;
        background-color: #D3D3D3;
    }
    #challengeForm #yearsem {
        height: 30px;
        width: 40%;
        display: block;
        font-family: Jost, monospace;
    }
    #challengeForm #recorddate {
        height: 30px;
        width: 30%;
        display: block;
        font-family: Jost, monospace;
    }
    #challengeForm textarea {
        height: 100px;
        width: 100%;
        font-family: Jost, monospace;
        resize: none;
        display: block;
    }
    #btnchallenge {
        width: 30%;
        height: 30px;
        font-family: Jost, monospace;
        font-size: 18px;
        background-color: white;
        border: 1px solid grey;
        transition: background-color 0.1s, color 0.1s;
    }
    #btnchallenge:hover {
        cursor: pointer;
        background-color: #333333;
        color: white;
    }
    #challengesTable #edit, #remove, #image {
        text-decoration: none;
        color: black;
        transition: color 0.1s;
    }
    #challengesTable #edit:hover {
        cursor: pointer;
        color: #3BB143;
    }
    #challengesTable #remove:hover {
        cursor: pointer;
        color: #FF0000;
    }
    #challengesTable #image:hover {
        cursor: pointer;
        color: #1E90FF;
    }
    #btngeneric {
        height: 40px;
        background-color: white;
        border: 1px solid black;
        width: 25%;
        font-size: 16px;
        font-family: Jost, monospace;
        transition: background-color 0.1s, color 0.1s;
    }
    #btngeneric:hover {
        cursor: pointer;
        background-color: #333333;
        color: white;
    }
    #searchBar {
        text-align: right;
        font-family: Jost, monospace;
    }
    @media screen and (max-width: 600px) {
        #challengeForm-container {
            padding-left: 10%;
            padding-right: 10%;
        }
        #challengeForm #yearsem {
            width: 50%;
        }
        #challengeForm #recorddate {
            width: 40%;
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
        <br>
        <?php
            if (isset($_SESSION["UID"])) {
                $accountID = $_SESSION["UID"];
                $fetchChallengesQuery = "SELECT * FROM challenge WHERE accountID='".$accountID."'";
                $challengesResult = mysqli_query($conn, $fetchChallengesQuery);
            }
        ?>
        <br>
        <div id="challengesTable-container">
            <form id="searchBar" action="challenges_search.php" method="POST">
                <input type="text" placeholder="Search..." name="search" style="font-family: Jost, monospace; width: 30%">
                <input type="submit" value="Search" style="font-family: Jost, monospace;">
            </form>
            <br>
            <table id="challengesTable">
                <?php
                    if (mysqli_num_rows($challengesResult) > 0) {
                        echo "
                            <tr>
                                <th>No.</th>
                                <th>Session</th>
                                <th>Challenge Details</th>
                                <th>Future Plan</th>
                                <th>Remarks</th>
                                <th>Image</th>
                                <th>&nbsp;</th>
                            </tr>
                        ";

                        $rowIndex = 1;

                        while ($row = mysqli_fetch_assoc($challengesResult)) {
                            $editID = $removeID = $imageID = $row["challengeID"];

                            echo "
                                <tr>
                                    <td>".$rowIndex."</td>
                                    <td>Sem ".$row["challengeSem"]." - ".$row["challengeYear"]."</td>
                                    <td>".$row["challengeDetails"]."</td>
                                    <td>".$row["challengeFuturePlan"]."</td>
                                    <td>".$row["challengeRemark"]."</td>
                            ";

                            if ($row["challengeImagePath"] != '') {
                                echo "
                                    <td style='text-align: center'>
                                        <a id='image' title='Open image' href='show_challenge_image.php?id=".$imageID."' target='blank'><i class='fa fa-image'></i></a>
                                    </td>
                                ";
                            }
                            else {
                                echo "<td>&nbsp;</td>";
                            }

                            echo "
                                <td style='text-align: center'>
                                    <a id='edit' title='Edit challenge' href='challenges_edit.php?id=".$editID."'><i class='fa fa-pencil-square-o'></i></a>
                                    <a id='remove' title='Remove challenge' onclick='confirmRemoval($removeID)'><i class='fa fa-trash-o'></i></a>
                                </td>
                            </tr>
                            ";

                            $rowIndex++;
                        }
                    }
                    else {  // if the query returns no rows
                        echo "
                            <tr>
                                <th>No.</th>
                                <th>Session</th>
                                <th>Challenge Details</th>
                                <th>Future Plan</th>
                                <th>Remarks</th>
                                <th>Image</th>
                            </tr>
                            <tr>
                                <td colspan='6'>No challenges have been added yet.</td>
                            </tr>
                        ";
                    }
                ?>
            </table>
        </div>
        <br>
        <div id="challengeForm-container">
            <form id="challengeForm" action="action_scripts/challenge_submit_action.php" method="POST" enctype="multipart/form-data">
                <p style="text-align: center">Facing a new challenge? Fill the form below and record it here. <br> Required fields are marked (*)</p>
                
                <label for="challengeSem">Semester (*)</label><br>
                <select id="yearsem" name="challengeSem" required>
                    <option value="" disabled selected>Select a Semester...</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                </select><br>

                <label for="challengeYear">Year (*)</label><br>
                <select id="yearsem" name="challengeYear" required>
                    <option value="" disabled selected>Select a Year...</option>
                    <option value="2021/2022">2021/2022</option>
                    <option value="2022/2023">2022/2023</option>
                    <option value="2023/2024">2023/2024</option>
                    <option value="2024/2025">2024/2025</option>
                </select><br>

                <label for="challengeDetails">Challenge Details (*)</label><br>
                <textarea name="challengeDetails" rows="5" columns="50" required></textarea><br>

                <label for="challengeFuturePlan">Future Plan (*)</label><br>
                <textarea name="challengeFuturePlan" rows="5" columns="50" required></textarea><br>

                <label for="challengeRemark">Remarks</label><br>
                <textarea name="challengeRemark" rows="5" columns="50" required></textarea><br>

                <p>Upload challenge image here:</p>
                <input type="file" name="challengeImageToUpload" accept=".jpg, .jpeg, .png" style="width: 100%; display: block;"><br><br>

                <center>
                    <input id="btnchallenge" name="btnsubmit" type="submit" value="Add">
                    <input id="btnchallenge" name="btnreset" type="reset" value="Reset"><br><br>
                </center>
            </form>
        </div>
    </main>
    <footer>
        <h5>© Chiew Cheng Yi | BI21110236 | KK34703 Individual Project</h5>
    </footer>
</body>

</html>