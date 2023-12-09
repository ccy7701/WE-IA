<?php
    session_start();
    include("include/config.php");
?>

<!DOCTYPE HTML>
<html lang="en">

<html>

<head>
    <title>Login Action | MyStudyKPI </title>
    <meta charset="utf8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Jost">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="sitejavascript.js"></script>
</head>

<body>
    <?php
        $loginMatric = $_POST["loginmatric"];
        $loginPassword = $_POST["loginpassword"];

        $loginQuery = "SELECT * FROM student_profile WHERE student_id='$loginMatric' LIMIT 1;";
        $result = mysqli_query($conn, $loginQuery);

        if (mysqli_num_rows($result) == 1) {    // a row with the same data is found
            // check password hash
            $row = mysqli_fetch_assoc($result);

            // verify matching passwords
            if (password_verify($_POST["loginpassword"], $row["student_password"])) {
                echo "Login was successful.";
                // bind the current session to student_id
                $_SESSION["UID"] = $row["student_id"];
                $_SESSION["student_name"] = $row["student_name"];
                // set log-in time
                $_SESSION["login_time"] = time();
                
                header("location: index.php");
                //echo "<br><a href='index.php'>Return to main menu</a>";
            }
            else {
                echo "
                    <script>
                        popup('Login error: The student Matric Number and Password are incorrect. Please try again.', 'login.php');
                    </script>
                ";
            }
        }
        else {
            echo "
                <script>
                    popup('Login error: User with Matric Number ".$loginMatric." does not exist. Please try again.', 'login.php');
                </script>
            ";
        }

        mysqli_close($conn);
    ?>
</body>

</html>