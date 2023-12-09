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
        <?php
            include("include/session_check.php");
        ?>
        <a href="javascript:void(0);" class="icon" onClick="adjustTopnav()"><i class="fa fa-bars"></i></a>
    </nav>
    <main>
        <?php
            if (isset($_SESSION["UID"])) {
                $matric = $_SESSION["UID"];
                $fetchProfileQuery = "SELECT * FROM student_profile WHERE student_id='".$matric."'";
                $result = mysqli_query($conn, $fetchProfileQuery);
                $row = mysqli_fetch_assoc($result);

                // this block is to determine the profile image to output
                $image = $row["student_imgpath"];

                // COL-LEFT STARTS HERE
                echo "
                <div class='row'>
                    <div class='col-left'>
                        <table id='tblprofile' width='100%'>
                        <caption><h3>PERSONAL INFO</h3></caption>
                ";

                if ($row["student_imgpath"] != '') {
                    echo "
                        <tr><td colspan=2 style='text-align: center; padding-top: 10px'><img src='".$image."' style='width: 40%'></td></tr>
                    ";
                }
                else {
                    echo "
                        <tr><td colspan=2 style='text-align: center; padding-top: 10px; color: #7f7f7f'><i>No profile image has been added yet.</i></td></tr>
                    ";
                }

                // this block is to determine what to output for Program
                $fetched_program = $row["student_program"];
                $program_output = '';

                switch($fetched_program) {
                    case "hc00": $program_output = "UH6481001 Software Engineering"; break;
                    case "hc05": $program_output = "UH6481002 Network Engineering"; break;
                    case "hc12": $program_output = "UH6481003 Multimedia Technology"; break;
                    case "hc13": $program_output = "UH6481004 Business Computing"; break;
                    case "hc14": $program_output = "UH6481005 Data Science"; break;
                    default: "ERROR";
                }

                echo "
                <tr><td>Name</td><td>".$row["student_name"]."</td></tr>
                <tr><td>Matric No.</td><td>".$row["student_id"]."</td></tr>
                <tr><td>Program</td><td>".$program_output."</td><tr>
                <tr><td>E-mail</td><td>".$row["student_email"]."</td></tr>
                <tr><td>Intake Batch</td><td>".$row["student_intakebatch"]."</td></tr>
                <tr><td>Phone Number</td><td>".$row["student_phone"]."</td></tr>
                ";

                if ($row["student_mentor"] != '') {
                    echo "
                    <tr><td>Mentor</td><td>".$row["student_mentor"]."</td></tr>
                    ";
                }
                else {
                    echo "
                        <tr><td>Mentor</td><td style='color: #7f7f7f'><i>not filled yet</i></td></tr>
                    ";
                }

                echo "
                    <tr><td>State of Origin</td><td>".$row["student_state"]."</td></tr>
                    <tr><td>Address</td><td>".$row["student_address"]."</td></tr>
                ";

                if ($row["student_motto"] != '') {
                    echo "
                        <tr><td>Motto</td><td>".$row["student_motto"]."</td></tr>
                    ";
                }
                else {
                    echo "
                        <tr><td>Motto</td><td style='color: #7f7f7f'><i>not filled yet</i></td><tr>
                    ";
                }

                echo "
                    <tr><td colspan='2' style='text-align: center;'><input onclick='redirect(\"aboutme_edit_personal.php\")' id='btneditpersonal' type='button' name='btneditpersonal' value='Edit Details'></td></tr>
                    </table>
                    </div>
                ";
                // COL-LEFT ENDS HERE

                // COL-RIGHT STARTS HERE

                // ACTIVITIES table
                echo "
                    <div class='col-right'>
                        <table id='tblactivities' width='100%'>
                            <caption><h3>ACTIVITIES</h3></caption>
                            <tr>
                                <th>No.</th>
                                <th>Session</th>
                                <th>Name</th>
                                <th>Level</th>
                                <th>Remarks</th>
                            </tr>
                ";

                $fetchActivitiesQuery = "SELECT * FROM activity WHERE student_id='".$matric."'";
                $activitiesResult = mysqli_query($conn, $fetchActivitiesQuery);
                if (mysqli_num_rows($activitiesResult) > 0) {
                    // output the data of each row
                    $row_index = 1;
                    
                    while($row = mysqli_fetch_assoc($activitiesResult)) {
                        echo "
                            <tr>
                                <td>".$row_index."</td>
                                <td>Sem ".$row["activity_sem"].", ".$row["activity_year"]."</td>
                                <td>".$row["activity_name"]."</td>
                                <td>LEVEL, UPDATE PHP LATER</td>
                                <td>".$row["activity_remarks"]."</td>
                            </tr>
                        ";
                        $row_index++;
                    }
                    echo "</table>";
                }
                else {
                    // if the query returns no rows
                    echo "
                        <tr>
                            <td colspan='5'>No activites have been added yet.</td>
                        </tr>
                        </table>
                    ";
                }

                // COMPETITIONS table
                echo "
                    <table id='tblcompetitions' width='100%'>
                        <caption><h3>COMPETITIONS</h3></caption>
                        <tr>
                            <th>No.</th>
                            <th>Session</th>
                            <th>Name</th>
                            <th>Level</th>
                            <th>Remarks</th>
                        </tr>
                ";

                $fetchCompetitionsQuery = "SELECT * FROM competition WHERE student_id='".$matric."'";
                $competitionsResult = mysqli_query($conn, $fetchCompetitionsQuery);
                if (mysqli_num_rows($competitionsResult) > 0) {
                    // output the data of each row
                    $row_index = 1;

                    while ($row = mysqli_fetch_assoc($activitiesResult)) {
                        echo "
                            <tr>
                                <td>".$row_index."</td>
                                <td>Sem ".$row["comp_sem"].", ".$row["comp_year"]."</td>
                                <td>".$row["comp_name"]."</td>
                                <td>LEVEL, UPDATE PHP LATER</td>
                                <td>".$row["comp_remarks"]."</td>
                            </tr>
                        ";
                        echo "</table>";
                        $row_index++;
                    }
                    echo "</table>";
                }
                else {
                    // if the query returns no rows
                    echo "
                        <tr>
                            <td colspan='5'>No competitions have been added yet.</td>
                        </tr>
                        </table>
                    ";
                }

                // CERTIFICATIONS table

                echo "
                    <table id='tblcertifications' width='100%'>
                        <caption><h3>CERTIFICATIONS</h3></caption>
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Issuer</th>
                            <th>Description</th>
                            <th>Award Date</th>
                        </tr>
                ";

                $fetchCertificationsQuery = "SELECT * FROM certification WHERE student_id='".$matric."'";
                $certificationsResult = mysqli_query($conn, $fetchCertificationsQuery);
                if (mysqli_num_rows($certificationsResult) > 0) {
                    // output the data of each row
                    $row_index = 1;

                    while ($row = mysqli_fetch_assoc($certificationsResult)) {
                        echo "
                            <tr>
                                <td>".$row_index."</td>
                                <td>".$row["cert_name"]."</td>
                                <td>".$row["cert_issuer"]."</td>
                                <td>".$row["cert_description"]."</td>
                                <td>".$row["cert_awarddate"]."</td>
                            </tr>
                        ";
                        $row_index++;
                    }
                    echo "</table>";
                }
                else {
                    echo "
                        <tr>
                            <td colspan='5'>No certifications have been added yet.</td>
                        </tr>
                        </table>
                    ";
                }

                echo "
                    </div>
                    </div>
                    <footer>
                        <h5>© Chiew Cheng Yi | BI21110236 | KK34703 Individual Project</h5>
                    </footer>
                ";


                // COL-RIGHT ENDS HERE
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