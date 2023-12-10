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
        <?php
            include("include/session_check.php");
        ?>
        <a href="javascript:void(0);" class="icon" onClick="adjustTopnav()"><i class="fa fa-bars"></i></a>
    </nav>
    <main>
        <h3 style="text-align: center">Edit Challenge Record</h3>
        <?php
            if (isset($_GET["id"]) && $_GET["id"] != "") {
                $id = $_GET["id"];
                $fetchRecordQuery = "SELECT * FROM challenge_and_plan WHERE challenge_index=".$id;
                $result = mysqli_query($conn, $fetchRecordQuery);
                $row = mysqli_fetch_assoc($result);

                // fetch the data to populate the form
                $challenge_index = $row["challenge_index"];
                $challenge_year_sem = $row["challenge_year_sem"];
                $challenge_details = $row["challenge_details"];
                $challenge_futureplan = $row["challenge_futureplan"];
                $challenge_remark = $row["challenge_remark"];
                $challenge_dateofrecord = $row["challenge_dateofrecord"];

                mysqli_close($conn);
            }
        ?>
        <div id="editChallengeRecord-container">
            <form id="editChallengeRecord" action="action_scripts/challenge_edit_action.php" method="POST" enctype="multipart/form-data">
                <?php
                    echo "
                        <input name='challenge_index' type='text' value='challenge_index' hidden>

                        <label for='challenge_sem_year'>Session (*)</label>
                        <select id='select' name='challenge_year_sem' required>
                            <option value='$challenge_year_sem'>Currently selected: ".$challenge_year_sem."</option>
                            <option value='Year 1 Sem 1'>Year 1 Sem 1</option>
                            <option value='Year 1 Sem 2'>Year 1 Sem 2</option>
                            <option value='Year 2 Sem 1'>Year 2 Sem 1</option>
                            <option value='Year 2 Sem 2'>Year 2 Sem 2</option>
                            <option value='Year 3 Sem 1'>Year 3 Sem 1</option>
                            <option value='Year 3 Sem 2'>Year 3 Sem 2</option>
                            <option value='Year 4 Sem 1'>Year 4 Sem 1</option>
                            <option value='Year 4 Sem 2'>Year 4 Sem 2</option>
                        </select><br>

                        <label for='challenge_details'>Challenge Details (*)</label>
                        <input id='editfield' name='challenge_details' type='text' value='$challenge_details' required><br>

                        <label for='challenge_futureplan'>Future Plan (*)</label>
                        <input id='editfield' name='challenge_futureplan' type='text' value='$challenge_futureplan' required><br>

                        <label for='challenge_remark'>Remarks</label>
                        <input id='editfield' name='challenge_remark' type='text' value='$challenge_remark'><br>

                        <label for='challenge_dateofrecord'>Date of Record (*)</label>
                        <input id='recorddate' name='challenge_dateofrecord' type='date' value='$challenge_dateofrecord' required><br>

                        <center>
                            <input id='btneditchallenge' name='btnsubmit' type='submit' value='Edit'>
                            <input id='btneditchallenge' name='btnreset' type='reset'value='Reset'><br><br>
                        </center>
                    ";
                ?>
            </form>
        </div>
    </main>
    <footer style="position: fixed; bottom: 0">
        <h5>© Chiew Cheng Yi | BI21110236 | KK34703 Individual Project</h5>
    </footer>
</body>

</html>