<?php
    session_start();
    include("include/config.php");
?>

<!DOCTYPE HTML>
<html lang="en">

<html>

<head>
    <title>About Me | MyStudyKPI </title>
    <meta charset="utf8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Jost">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="sitejavascript.js"></script>
    <style>
        #tblprofile {
            text-align: left;
            border: 1px solid black;
        }
        #tblactivities, #tblcompetitions, #tblcertifications {
            text-align: left;
            border: 1px solid black;
        }
        #tblactivities tr, #tblcompetitions tr, #tblcertifications tr {
            transition: background-color 0.1s, color 0.1s;
        }
        #tblactivities tr:nth-child(odd), #tblcompetitions tr:nth-child(odd), #tblcertifications tr:nth-child(odd) {
            background-color: #DDDDDD;
        }
        #tblactivities tr:hover, #tblcompetitions tr:hover, #tblcertifications tr:hover {
            background-color: #C8B4BA;
            font-weight: bold;
        }
        #tblactivities th {
            text-align: center;
            background-color: #BAE1FF;
            color: black;
        }
        #tblcompetitions th {
            text-align: center;
            background-color: #BAFFC9;
            color: black;
        }
        #tblcertifications th {
            text-align: center;
            background-color: #FFFFBA;
            color: black;
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
    </style>
</head>

<body>
    <header>
        <img class="header" src="images/aboutmeheader.png">
    </header>
    <nav class="topnav" id="myTopnav">
        <a href="index.php" class="logo"><img src="images/mystudykpi-topnavbtn-2-white.png"></a>
        <a href="aboutme.php" class="active">About Me</a>
        <a href="kpimodule.php" class="tabs">MyKPI Indicator Module</a>
        <a href="activitieslist.php" class="tabs">Activities List</a>
        <a href="challenges.php" class="tabs">Challenges and Future Plans</a>
        <a href="logout.php" class="tabs">Logout</a>
        <a href="javascript:void(0);" class="icon" onClick="adjustTopnav()"><i class="fa fa-bars"></i></a>
    </nav>
    <main style="flex: 1;">
        <?php
            if (isset($_SESSION["UID"])) {
                $accountID = $_SESSION["UID"];
                $fetchAccountQuery = "SELECT * FROM account WHERE accountID='".$accountID."' LIMIT 1";
                $fetchProfileQuery = "SELECT * FROM profile WHERE accountID='".$accountID."' LIMIT 1";

                $result = mysqli_query($conn, $fetchAccountQuery);
                $row = mysqli_fetch_assoc($result);

                // variables for the fetched ACCOUNT data
                $matricNumber = $row["matricNumber"];
                $accountEmail = $row["accountEmail"];

                $result = mysqli_query($conn, $fetchProfileQuery);
                $row = mysqli_fetch_assoc($result);

                // variables for the fetched PROFILE data
                $username = $row["username"];
                $program = $row["program"];
                $intakeBatch = $row["intakeBatch"];
                $phoneNumber = $row["phoneNumber"];
                $mentor = $row["mentor"];
                $profileState = $row["profileState"];
                $profileAddress = $row["profileAddress"];
                $motto = $row["motto"];
                $profileImagePath = $row["profileImagePath"];

                mysqli_close($conn);
            }
            else {
                echo "ERROR: ".mysqli_error($conn);
            }
        ?>
        <div class="row">
            <div class="col-left">
                <h4>Profile Picture</h4>
                <form id="image-container" style="max-width: 100%; margin; 0 auto; border: 1px solid black; padding-top: 5px;">
                    <tr>
                        <img src="<?=$profileImagePath;?>" style="width: 50%;"></image>
                    </tr>
                </form>
            </div>
            <div class="col-right">
                <?php  
                    // this block is to determine what to output for Program
                    $programOutput = '';
                    switch ($program) {
                        case "hc00": $programOutput = "UH6481001 Software Engineering"; break;
                        case "hc05": $programOutput = "UH6481002 Network Engineering"; break;
                        case "hc12": $programOutput = "UH6481003 Multimedia Technology"; break;
                        case "hc13": $programOutput = "UH6481004 Business Computing"; break;
                        case "hc14": $programOutput = "UH6481005 Data Science"; break;
                        default: $programOutput = "";
                    }
                ?>
                <table id='tblprofile' width="100%">
                    <caption><h4>Personal Info</h4></caption>
                        <tr>
                            <td>Name</td>
                            <td><?php echo ($username != '') ? $username : "Not filled yet"; ?></td>
                        </tr>
                        <tr>
                            <td>Matric Number</td>
                            <td><?=$matricNumber;?></td>
                        </tr>
                        <tr>
                            <td>Program</td>
                            <td><?php echo ($programOutput != '') ? $programOutput : "Not filled yet"; ?></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><?=$accountEmail;?></td>
                        </tr>
                        <tr>
                            <td>Intake Batch</td>
                            <td><?php echo ($intakeBatch != 0) ? $intakeBatch : "Not filled yet"; ?></td>
                        </tr>
                        <tr>
                            <td>Phone Number</td>
                            <td><?php echo ($phoneNumber != '') ? $phoneNumber : "Not filled yet"; ?></td>
                        </tr>
                        <tr>
                            <td>Mentor</td>
                            <td><?php echo ($mentor != '') ? $mentor : "Not filled yet"; ?></td>
                        </tr>
                        <tr>
                            <td>State of Origin</td>
                            <td><?php echo ($profileState != '') ? $profileState : "Not filled yet"; ?></td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td><?php echo ($profileAddress != '') ? $profileAddress : "Not filled yet"; ?></td>
                        </tr>
                </table>
                <br>
                <table id='tblprofile' width='100%'>
                    <caption><h4>Study Motto</h4></caption>
                    <tr>
                        <td style="text-align: center"><?php echo ($motto != '') ? $motto : "Not filled yet"; ?></td>
                    </tr>
                </table>
                <br>
                <div id="center-container" style="text-align: center; width: 100%;">
                    <div id="center-content">
                        <input onclick="redirect('aboutme_edit_personal.php')" id="btneditpersonal" type="button" name="btneditpersonal" value="Edit Details">
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer>
            <h5>© Chiew Cheng Yi | BI21110236 | KK34703 Individual Project</h5>
    </footer>
</body>

</html>