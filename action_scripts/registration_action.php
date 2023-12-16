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
            $matricNumber = mysqli_real_escape_string($conn, $_POST["matricNumber"]);
            $accountEmail = mysqli_real_escape_string($conn, $_POST["accountEmail"]);
            $accountPassword = mysqli_real_escape_string($conn, $_POST["accountPassword"]);
            $reenterPassword = mysqli_real_escape_string($conn, $_POST["reenterPassword"]);

            // validation for matching student_password and reenter_password
            if ($accountPassword !== $reenterPassword) {
                echo "
                    <script>
                        popup('ERROR: Passwords do not match. Please try again.', '../registration.php')
                    </script>
                ";
                die("Passwords do not match.");
            }

            // validation for whether matricNumber already exists
            $idQuery = "SELECT * FROM account WHERE matricNumber='".$matricNumber."' LIMIT 1";
            $result = mysqli_query($conn, $idQuery);
            $insertFlag = 0;

            if (mysqli_num_rows($result) == 1) {    // a row is returned, so a row with this ID already exists
                echo "
                    <script>
                        popup('ERROR: A user with this Matric Number already exists. Please register using a new Matric Number.', '../registration.php');
                    </script>
                ";
            }
            else {  // no row was returned, so this ID does not exist in the database yet
                $pwdHash = trim(password_hash($_POST["accountPassword"], PASSWORD_DEFAULT));
                $pushToDBQuery = "INSERT INTO account (matricNumber, accountEmail, accountPwd) VALUES
                ('$matricNumber', '$accountEmail', '$pwdHash');";
                if (mysqli_query($conn, $pushToDBQuery)) {    // if the connection to DB is successful,
                    echo "
                    <header>
                        <img class='header' src='../images/registrationheader.png'>
                    </header>
                    <nav class='topnav' id='myTopnav'>
                        <a href='../index.php' class='logo'><img src='../images/mystudykpi-topnavbtn-2-white.png'></a>
                        <a href='../login.php' class='active'>Login</a>
                        <a href='javascript:void(0);' class='icon' onClick='adjustTopnav()'><i class='fa fa-bars'></i></a>
                    </nav>
                    <main>
                        <p style='font-size:20px; text-align: center;'>New user record with Matric Number ".$matricNumber." created successfully!</p>
                        <p style='text-align: center'><a href='../login.php'>Back to login menu</a></p>
                    </main>
                    <footer style='position: fixed; bottom: 0;'>
                        <h5>© Chiew Cheng Yi | BI21110236 | KK34703 Individual Project</h5>
                    </footer>
                    ";
                    $insertFlag = 1;
                }
                if ($insertFlag == 1) {
                    $lastInsertedID = mysqli_insert_id($conn);
                    $pushToProfileQuery = "INSERT INTO profile (username, program, intakeBatch, phoneNumber, mentor, profileState, profileAddress, motto, profileImagePath, accountID)
                    VALUES ('', '', '', '', '', '', '', '', 'uploads/profile_images/default.png', '$lastInsertedID');";

                    if (mysqli_query($conn, $pushToProfileQuery)) {
                        // echo "New user profile created successfully."
                    }
                    else {
                        echo "ERROR: ".$pushToProfileQuery."<br>".mysqli_error($conn);
                    }
                }
            }
        }

        mysqli_close($conn);
    ?>
</body>

</html>