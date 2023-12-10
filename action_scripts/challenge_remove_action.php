<?php
    session_start();
    include("../include/config.php");
?>

<!DOCTYPE HTML>
<html lang="en">

<html>

<head>
    <title>Challenge Remove Action | MyStudyKPI </title>
    <meta charset="utf8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Jost">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="../sitejavascript.js"></script>
</head>

<body>
    <?php
    // this action_script is executed when the Remove link (icon?) is clicked
    if (isset($_GET["id"]) && $_GET["id"] != "") {
        $id = $_GET["id"];
        $deleteQuery = "DELETE FROM challenge_and_plan WHERE challenge_index=".$id;

        if (mysqli_query($conn, $deleteQuery)) {
            echo "
                <script>
                    popup(\"Challenge record removed successfully.\", \"../challenges.php\");
                </script>
            ";
        }
        else {
            echo "
                <script>
                    popup(\"Oops. Something went wrong.\", \"../challenges.php\");
                </script>
            ";
        }

        mysqli_close($conn);
    }
    ?>
</body>

</html>