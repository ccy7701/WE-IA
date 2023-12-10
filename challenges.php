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
        <?php
            include("include/session_check.php");
        ?>
        <a href="javascript:void(0);" class="icon" onClick="adjustTopnav()"><i class="fa fa-bars"></i></a>
    </nav>
    <main>
        <?php
            if(isset($_SESSION["UID"])) {
                $matric = $_SESSION["UID"];
                $fetchChallengesQuery = "SELECT * FROM challenge_and_plan WHERE student_id='".$matric."'";
                $challengesResult = mysqli_query($conn, $fetchChallengesQuery);

                echo "
                <br>
                <div id='challengesTable-container'>
                    <table id='challengesTable' width='100%'>
                ";

                if (mysqli_num_rows($challengesResult) > 0) {
                    echo "
                    <tr>
                        <th>No.</th>
                        <th>Session</th>
                        <th>Challenge Details</th>
                        <th>Future Plan</th>
                        <th>Remarks</th>
                        <th>Date of Record</th>
                        <th>&nbsp;</th>
                    </tr>
                    ";

                    $row_index = 1;

                    while ($row = mysqli_fetch_assoc($challengesResult)) {
                        echo "
                        <tr>
                            <td>".$row_index."</td>
                            <td>".$row["challenge_year_sem"]."</td>
                            <td>".$row["challenge_details"]."</td>
                            <td>".$row["challenge_futureplan"]."</td>
                            <td>".$row["challenge_remark"]."</td>
                            <td>".$row["challenge_dateofrecord"]."</td>
                            <td>Edit | Remove</td>
                        </tr>
                        ";
                        $row_index++;
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
                            <th>Date of Record</th>
                        </tr>
                        <tr>   
                            <td colspan='6'>No challenges have been added yet.</td>
                        </tr>
                    ";
                }

                echo "</table>";
                echo "</div>";

                echo "
                    <br>
                    <div id='challengeForm-container'>
                        <form id='challengeForm' action='action_scripts/challenges_submit_action.php' method='POST'>
                            <p style='text-align: center'>Facing a new challenge? Fill the form below and record it here. <br> Required fields are marked (*)</p>
                            <label for='yearsem'>Year/Sem (*): </label><br>
                            <select id='yearsem' name='yearsem' required>
                                <option value='' disabled selected>Select a Year/Sem...</option>
                                <option value='Year 1 Sem 1'>Year 1 Sem 1</option>
                                <option value='Year 1 Sem 2'>Year 1 Sem 2</option>
                                <option value='Year 2 Sem 1'>Year 2 Sem 1</option>
                                <option value='Year 2 Sem 2'>Year 2 Sem 2</option>
                                <option value='Year 3 Sem 1'>Year 3 Sem 1</option>
                                <option value='Year 3 Sem 2'>Year 3 Sem 2</option>
                                <option value='Year 4 Sem 1'>Year 4 Sem 1</option>
                                <option value='Year 4 Sem 2'>Year 4 Sem 2</option>
                            </select><br>
                            <label for='recorddate'>Date of record (*): </label><br>
                            <input id='recorddate' name='recorddate' type='date' required><br>
                            <label for='challengedetails'>Challenge (*): </label><br>
                            <textarea name='challengedetails' rows='5' cols='50' required></textarea><br>
                            <label for='futureplan'>Future plan (*): </label><br>
                            <textarea name='futureplan' rows='5' cols='50' required></textarea><br>
                            <label for='remarks'>Remarks: </label><br>
                            <textarea name='remarks' rows='5' cols='50'></textarea><br><br>
                            <center>
                                <input id='btnchallenge' name='btnsubmit' type='submit' value='Submit'>
                                <input id='btnchallenge' name='btnreset' type='reset' value='Reset'><br><br>
                            </center>
                        </form>
                    </div>
                ";

                echo "
                    <footer>
                        <h5>© Chiew Cheng Yi | BI21110236 | KK34703 Individual Project</h5>
                    </footer>
                ";
            }
            else {
                echo "
                    <center>
                        <h3>You must be logged in to use this feature.</h3>
                        <input onclick='redirect(\"login.php\");' id='btngeneric' type='button' value='Login now'>
                        <br><br>
                    </center>
                <footer style='position: fixed; bottom: 0;'>
                    <h5>© Chiew Cheng Yi | BI21110236 | KK34703 Individual Project</h5>
                </footer>
                ";
            }
        ?>
    </main>
</body>

</html>