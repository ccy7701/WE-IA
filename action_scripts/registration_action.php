<?php
    include("../include/config.php");
?>

<!DOCTYPE HTML>

<html>

<head>
    <title>Registration Action | MyStudyKPI </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Jost">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="../sitejavascript.js"></script>
</head>

<body>
    <?php
        // STEP 1: Form data handling using mysqli_real_escape_string function to escape special characters for use in an SQL query
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $student_id = mysqli_real_escape_string($conn, $_POST["student_id"]);
            $student_password = mysqli_real_escape_string($conn, $_POST["student_password"]);
            $reenter_password = mysqli_real_escape_string($conn, $_POST["reenter_password"]);

            // validation for matching student_password and reenter_password
            if ($student_password !== $reenter_password) {
                die("Passwords do not match.");
            }

            $student_name = mysqli_real_escape_string($conn, $_POST["student_name"]);
            $student_program = mysqli_real_escape_string($conn, $_POST["student_program"]);
            $student_email = mysqli_real_escape_string($conn, $_POST["student_email"]);
            $student_intakebatch = mysqli_real_escape_string($conn, (int)$_POST["student_intakebatch"]);
            $student_phone = mysqli_real_escape_string($conn, $_POST["student_phone"]);
            $student_mentor = mysqli_real_escape_string($conn, $_POST["student_mentor"]);
            $student_state = mysqli_real_escape_string($conn, $_POST["student_state"]);
            $student_address = mysqli_real_escape_string($conn, $_POST["student_address"]);
            $student_motto = mysqli_real_escape_string($conn, $_POST["student_motto"]);

            // validation for whether student_id already exists
            $idQuery = "SELECT * FROM student_profile WHERE student_id='".$student_id."' LIMIT 1";
            $result = mysqli_query($conn, $idQuery);

            if (mysqli_num_rows($result) == 1) {    // a row is returned, so a row with this ID already exists
                echo "
                    <script>
                        popup('ERROR: A user with this Matric Number already exists. Please register using a new Matric Number.', '../login.php');
                    </script>
                ";
            }
            else {  // no row was returned, so this ID does not exist in the database yet
                $pwdHash = trim(password_hash($_POST["student_password"], PASSWORD_DEFAULT));
                $pushToDBQuery = "INSERT INTO student_profile (student_id, student_name, student_password, student_program, student_email, student_intakebatch,
                student_phone, student_mentor, student_state, student_address, student_motto, student_imgpath) VALUES
                ('$student_id', '$student_name', '$pwdHash', '$student_program', '$student_email', '$student_intakebatch',
                '$student_phone', '$student_mentor', '$student_state', '$student_address', '$student_motto', '');";
                if (mysqli_query($conn, $pushToDBQuery)) {    // if the connection to DB is successful,
                    // echo "<p>New user record created successfully. Welcome '$student_name' ('$student_id')!";
                    echo "
                    <header>
                        <img class='header' src='../images/registrationheader.png'>
                    </header>
                    <nav class='topnav' id='myTopnav'>
                        <a href='../index.php' class='logo'><img src='../images/mystudykpi-topnavbtn-2-white.png'></a>
                        <a href='../aboutme.php' class='tabs'>About Me</a>
                        <a href='../kpimodule.php' class='tabs'>MyKPI Indicator Module</a>
                        <a href='../activitieslist.php' class='tabs'>Activities List</a>
                        <a href='../challenges.php' class='tabs'>Challenges and Future Plans</a>
                        <a href='../login.php' class='tabs'>Login</a>
                        <a href='javascript:void(0);' class='icon' onClick='adjustTopnav()'><i class='fa fa-bars'></i></a>
                    </nav>
                    <main>
                        <p style='font-size:20px; text-align: center;'>New user record created successfully. Welcome, ".$student_name."!</p>
                        <p style='text-align: center'><a href='../login.php'>Back to login menu</a></p>
                    </main>
                    <footer style='position: fixed; bottom: 0;'>
                        <h5>© Chiew Cheng Yi | BI21110236 | KK34703 Individual Project</h5>
                    </footer>
                    ";
                }
            }
        }

        mysqli_close($conn);
    ?>
</body>

</html>