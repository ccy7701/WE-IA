<?php
    session_start();
    include("../include/config.php");
?>

<!DOCTYPE HTML>
<html lang="en">

<html>

<head>
    <title>Edit Challenge Record | MyStudyKPI </title>
    <script src="../sitejavascript.js"></script>
</head>

<body>
    <?php
        // commit to the database
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $target = mysqli_real_escape_string($conn, $_POST["challenge_index"]);
            $new_challenge_year_sem = mysqli_real_escape_string($conn, $_POST["challenge_year_sem"]);
            $new_challenge_details = mysqli_real_escape_string($conn, $_POST["challenge_details"]);
            $new_challenge_futureplan = mysqli_real_escape_string($conn, $_POST["challenge_futureplan"]);
            $new_challenge_remark = mysqli_real_escape_string($conn, $_POST["challenge_remark"]);
            $new_challenge_dateofrecord = mysqli_real_escape_string($conn, $_POST["challenge_dateofrecord"]);

            $pushToDBQuery = "
                UPDATE challenge_and_plan
                SET challenge_year_sem = '$new_challenge_year_sem', challenge_details = '$new_challenge_details',
                challenge_futureplan = '$new_challenge_futureplan', challenge_remark = '$new_challenge_remark',
                challenge_dateofrecord = '$new_challenge_dateofrecord'
                WHERE challenge_index=$target;
            ";

            if (mysqli_query($conn, $pushToDBQuery)) {
                echo "<script>popup(\"Challenge record updated successfully.\", \"../challenges.php\");</script>";
            }
            else {
                echo "
                    <script>
                        popup('Oops. Something went wrong.', '../challenges.php');
                    </script>
                ";
            }
        }
    ?>
</body>

</html>