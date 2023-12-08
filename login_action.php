<?php
    session_start();
    include("include/config.php");
?>

<!DOCTYPE HTML>
<html lang="en">

<html>

<head>
    <title>Login Action | MyStudyKPI </titlte>
    <meta charset="utf8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Jost">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="sitejavascript.js"></script>
</head>

<body>
    <?php
        $loginMatric = $_POST['loginmatric'];
        $loginPassword = $_POST['loginpassword'];

        $loginQuery = "SELECT * FROM student_profile WHERE student_password='.$loginPassword.' LIMIT 1";
        $result = mysqli_query($conn, $loginQuery);

        // if (mysqli_num_rows())
    ?>
</body>

</html>