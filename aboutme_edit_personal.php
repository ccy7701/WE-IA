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
                padding-left: 50px;
                padding-right: 50px;
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
        <?php
            include("include/session_check.php");
        ?>
        <a href="javascript:void(0);" class="icon" onClick="adjustTopnav()"><i class="fa fa-bars"></i></a>
    </nav>
    <main>
        <h3 style="text-align: center">Edit Personal Info</h3>
        <?php
            // populate the editPersonalInfo form with data fetched from the DB
            if (isset($_SESSION["UID"])) {
                $matric = $_SESSION["UID"];
                $fetchProfileQuery = "SELECT * FROM student_profile WHERE student_id='".$matric."'";
                $result = mysqli_query($conn, $fetchProfileQuery);
                $row = mysqli_fetch_assoc($result);
    
                // fetch the data to populate the form
                $student_id = $row["student_id"];
                $student_name = $row["student_name"];
                // password value is not used
                $student_program = $row["student_program"];
                $student_email = $row["student_email"];
                $student_intakebatch = $row["student_intakebatch"];
                $student_phone = $row["student_phone"];
                $student_mentor = $row["student_mentor"];
                $student_state = $row["student_state"];
                $student_address = $row["student_address"];
                $student_motto = $row["student_motto"];
                $student_image = $row["student_imgpath"];

                mysqli_close($conn);
            }
            ?>
        <div id="editPersonalInfo-container">
            <form id="editPersonalInfo" action="action_scripts/aboutme_edit_personal_action.php" method="POST" enctype="multipart/form-data">
                <?php
                    // for the Program field
                    $program_display = '';
                    switch ($student_program) {
                        case 'hc00': $program_display = 'UH6481001 Software Engineering'; break;
                        case 'hc05': $program_display = 'UH6481001 Network Engineering'; break;
                        case 'hc12': $program_display = 'UH6481003 Multimedia Technology'; break;
                        case 'hc13': $program_display = 'UH6481004 Business Computing'; break;
                        case 'hc14': $program_display = 'UH6481005 Data Science'; break;
                        default: 'ERROR: Could not fetch student_program';
                    }

                    echo "
                        <label for='student_id'>Matric Number</label><br>
                        <input id='editfield' name='student_id' type='text' value='$student_id' disabled><br>

                        <label for='student_name'>Name</label><br>
                        <input id='editfield' name='student_name' type='text' value='$student_name' disabled><br>
                        
                        <label for='student_program'>Program</label><br>
                        <input id='editfield' name='student_program' type='text' value='$program_display' disabled><br>

                        <label for='student_email'>E-mail (*)</label>
                        <input id='editfield' name='student_email' type='text' value='$student_email' required><br>

                        <label for='student_intakebatch'>Intake Batch</label>
                        <input id='editfield' name='student_intakebatch' type='text' value='$student_intakebatch' disabled><br>

                        <label for='student_phone'>Phone Number (*)</label>
                        <input id='editfield' name='student_phone' type='text' value='$student_phone' required><br>

                        <label for='student_mentor'>Mentor</label>
                        <input id='editfield' name='student_mentor' type='text' value='$student_mentor'><br>

                        <label for='student_state'>State (*)</label>
                        <select id='select' name='student_state' required>
                            <option value='$student_state'>Currently selected: ".$student_state."</option>
                            <optgroup label='States'>
                                <option value='Johor'>Johor</option>
                                <option value='Kedah'>Kedah</option>
                                <option value='Kelantan'>Kelantan</option>
                                <option value='Malacca'>Malacca</option>
                                <option value='Negeri Sembilan'>Negeri Sembilan</option>
                                <option value='Pahang'>Pahang</option>
                                <option value='Penang'>Penang</option>
                                <option value='Perak'>Perak</option>
                                <option value='Perlis'>Perlis</option>
                                <option value='Sabah'>Sabah</option>
                                <option value='Sarawak'>Sarawak</option>
                                <option value='Selangor'>Selangor</option>
                                <option value='Terengganu'>Terengganu</option>
                            </optgroup>
                            <optgroup label='Federal Territories'>
                                <option value='Kuala Lumpur'>Kuala Lumpur</option>
                                <option value='Labuan'>Labuan</option>
                                <option value='Putrajaya'>Putrajaya</option>
                            </optgroup>
                            <optgroup label='Others'>
                                <option value='Overseas'>Overseas</option>
                            </optgroup>
                        </select><br>

                        <label for='student_address'>Address (*)</label>
                        <input id='editfield' name='student_address' type='text' value='$student_address' required><br>

                        <label for='student_motto'>Your Motto</label>
                        <input id='editfield' name='student_motto' type='text' value='$student_motto'><br>

                        <p>Upload new profile image here:<p>
                        <input id='pfpToUpload' type='file' name='pfpToUpload' accept='.jpg, .jpeg, .png'><br>
                    ";
                ?>
                <center>
                    <input id="btnedit" name="editsubmit" type="submit" value="EDIT">
                    <input id="btnedit" name="editreset" type="reset" value="RESET">
                </center>
            </form>
            <br>
        </div>
    </main>
    <footer>
        <h5>© Chiew Cheng Yi | BI21110236 | KK34703 Individual Project</h5>
    </footer>
</body>

</html>