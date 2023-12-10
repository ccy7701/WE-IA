<?php
    session_start();
    include("../include/config.php");
?>

<!DOCTYPE HTML>
<html lang="en">

<html>

<head>
    <title>Challenge Submit Action | MyStudyKPI </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Jost">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="../sitejavascript.js"></script>
</head>

<body>
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $target = $_SESSION["UID"];
            $challenge_year_sem = mysqli_real_escape_string($conn, $_POST["yearsem"]);
            $challenge_dateofrecord = mysqli_real_escape_string($conn, $_POST["recorddate"]);
            $challenge_details = mysqli_real_escape_string($conn, $_POST["challengedetails"]);
            $challenge_futureplan = mysqli_real_escape_string($conn, $_POST["futureplan"]);
            $challenge_remark = mysqli_real_escape_string($conn, $_POST["remarks"]);

            $pushToDBQuery = "INSERT INTO challenge_and_plan (challenge_year_sem, challenge_details, challenge_futureplan,
            challenge_remark, challenge_dateofrecord, student_id) VALUES
            ('$challenge_year_sem', '$challenge_details', '$challenge_futureplan', '$challenge_remark', '$challenge_dateofrecord', '$target');";

            if (mysqli_query($conn, $pushToDBQuery)) {  // if the connection to the DB is successful
                echo "
                    <script>
                        popup(\"New challenge record added successfully.\", \"../challenges.php\");
                    </script>
                ";
            }
        }
    ?>
</body>

</html>