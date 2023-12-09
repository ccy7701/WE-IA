<?php
    session_start();
    include("include/config.php");
?>

<!DOCTYPE HTML>
<html lang="en">

<html>

<head>
    <title>Edit Confirmation</title>
    <script src="sitejavascript.js"></script>
</head>

<body>
    <?php
        // commit to the database the data from the editable fields ONLY
        // whatever is set to 'disabled' in the form, stays unchanged in the DB
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $target = $_SESSION["UID"];
            // but why not $target = $_POST["student_id"]....
            $new_student_email = mysqli_real_escape_string($conn, $_POST["student_email"]);
            $new_student_phone = mysqli_real_escape_string($conn, $_POST["student_phone"]);
            $new_student_mentor = mysqli_real_escape_string($conn, $_POST["student_mentor"]);
            $new_student_state = mysqli_real_escape_string($conn, $_POST["student_state"]);
            $new_student_address = mysqli_real_escape_string($conn, $_POST["student_address"]);
            $new_student_motto = mysqli_real_escape_string($conn, $_POST["student_motto"]);

            $pushToDBQuery = "
            UPDATE student_profile
            SET student_email = '$new_student_email', student_phone = '$new_student_phone',
            student_mentor = '$new_student_mentor', student_state = '$new_student_state',
            student_address = '$new_student_address', student_motto = '$new_student_motto'
            WHERE student_id='$target';
            ";

            if (mysqli_query($conn, $pushToDBQuery)) {
                // echo "Edit of personal information successful.";

                // echo "
                //     <a href='aboutme.php'>BACK</a>
                // ";
                echo "<script>confirmationPopup(\"Personal info updated successfully.\", \"aboutme.php\");</script>";
            }
            else {
                echo "ERROR: Something went wrong.";

                echo "
                    <a href='aboutme.php'>BACK</a>
                ";
            }

            mysqli_close($conn);

        }
    ?>
</body>

</html>