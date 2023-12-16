<?php
    session_start();
    include("include/config.php");
?>

<!DOCTYPE HTML>
<html lang="en">

<html>

<head>
    <title>Edit Personal Info | MyStudyKPI </title>
    <meta charset="utf8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Jost">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="sitejavascript.js"></script>
    <style>
        #editPersonalInfo-container {
            align: center;
            padding-left: 30%;
            padding-right: 30%;
        }
        #editPersonalInfo {
            width: 100%;
            border-collapse: collapse;
        }
        #pfpToUpload {
            width: 100%;
            display: block;
        }
        @media screen and (max-width: 600px) {
            #editPersonalInfo-container {
                padding-left: 10%;
                padding-right: 10%;
            }
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
    <main>
        <h3 style="text-align: center">Edit Personal Info</h3>
        <?php
            // fetch the existing row data from the database
            if (isset($_SESSION["UID"])) {
                // do something
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
        <div id="editPersonalInfo-container">
            <form id="editPersonalInfo" action="action_scripts/aboutme_edit_personal_action.php" method="POST" enctype="multipart/form-data">
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

                <label for="matricNumber">Matric Number</label><br>
                <input id="editfield" name="matricNumber" type="text" value="<?=$matricNumber;?>" disabled><br>

                <label for="accountEmail">Email</label><br>
                <input id="editfield" name="accountEmail" type="text" value="<?=$accountEmail;?>" disabled><br>

                <label for="username">Username</label><br>
                <input id="editfield" name="username" type="text" value="<?=$username;?>"><br>

                <label for="program">Program</label><br>
                <select id="select" name="program">
                    <option value="<?=$program;?>" selected>Current: <?php echo ($program != '') ? $programOutput : "Not filled yet" ?></option>
                    <option value="hc00">UH6481001 Software Engineering</option>
                    <option value="hc05">UH6481002 Network Engineering</option>
                    <option value="hc12">UH6481003 Multimedia Technology</option>
                    <option value="hc13">UH6481004 Business Computing</option>
                    <option value="hc14">UH6481005 Data Science</option>
                </select><br>

                <label for="intakeBatch">Intake Batch</label><br>
                <input id="editfield" name="intakeBatch" type="text" value=<?php echo ($intakeBatch != 0) ? $intakeBatch : ""; ?>><br>

                <label for="phoneNumber">Phone Number</label><br>
                <input id="editfield" name="phoneNumber" type="text" value="<?=$phoneNumber;?>"><br>

                <label for="mentor">Mentor</label><br>
                <input id="editfield" name="mentor" type="text" value="<?=$mentor;?>"><br>

                <label for="profileState">State</label><br>
                <select id="select" name="profileState">
                    <option value="<?=$profileState;?>" selected>Current: <?php echo ($profileState != '') ? $profileState : "Not filled yet"; ?></option>
                    <optgroup label="States">
                        <option value="Johor">Johor</option>
                        <option value="Kedah">Kedah</option>
                        <option value="Kelantan">Kelantan</option>
                        <option value="Malacca">Malacca</option>
                        <option value="Negeri Sembilan">Negeri Sembilan</option>
                        <option value="Pahang">Pahang</option>
                        <option value="Penang">Penang</option>
                        <option value="Perak">Perak</option>
                        <option value="Perlis">Perlis</option>
                        <option value="Sabah">Sabah</option>
                        <option value="Sarawak">Sarawak</option>
                        <option value="Selangor">Selangor</option>
                        <option value="Terengganu">Terengganu</option>
                    </optgroup>
                    <optgroup label="Federal Territories">
                        <option value="Kuala Lumpur">Kuala Lumpur</option>
                        <option value="Labuan">Labuan</option>
                        <option value="Putrajaya">Putrajaya</option>
                    </optgroup>
                    <optgroup label="Others">
                        <option value="Overseas">Overseas</option>
                    </optgroup>
                </select><br>

                <label for="profileAddress">Address</label>
                <input id="editfield" name="profileAddress" type="text" value="<?=$profileAddress?>"><br>

                <label for="motto">Motto</label>
                <input id="editfield" name="motto" type="text" value="<?=$motto?>"><br>

                <p>Upload new profile image here:</p>
                <input id="pfptoupload" type="file" name="pfpToUpload" accept=".jpg, .jpeg, .png"><br><br>

                <center>
                    <input id="btnedit" name="editsubmit" type="submit" value="EDIT">
                    <input id="btnedit" name="editreset" type="reset" value="RESET">
                    <input id="btnedit" name="editcancel" type="button" onClick="redirect('aboutme.php')" value="CANCEL">
                </center>
            </form>
        </div>
        <br>
    </main>
    <footer>
        <h5>© Chiew Cheng Yi | BI21110236 | KK34703 Individual Project</h5>
    </footer>
</body>

</html>