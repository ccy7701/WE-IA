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
            $activitySem = mysqli_real_escape_string($conn, $_POST["activitySem"]);
            $activityYear = mysqli_real_escape_string($conn, $_POST["activityYear"]);
            $activityType = mysqli_real_escape_string($conn, $_POST["activityType"]);
            $activityLevel = mysqli_real_escape_string($conn, $_POST["activityLevel"]);
            $activityDetails = mysqli_real_escape_string($conn, $_POST["activityDetails"]);
            $activityRemarks = mysqli_real_escape_string($conn, $_POST["activityRemarks"]);

            // for image upload
            $activityImageUploadFlag = 0;

            // IF THERE IS NO ATTACHED IMAGE
            if (isset($_FILES["activityImageToUpload"]) && $_FILES["activityImageToUpload"]["name"] == "") {
                // <! LAST STOP HERE, 18/12/2023 1:56PM!!!! !>
            }
        }
    ?>
</body>

</html>