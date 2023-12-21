<?php
    session_start();
    include("../include/config.php");
?>

<!DOCTYPE HTML>
<html lang="en">

<html>

<head>
    <title>Edit Indicator Record</title>
    <script src="../sitejavascript.js"></script>
</head>

<body>
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $target = mysqli_real_escape_string($conn, $_POST["indicatorID"]);
            $newIndicatorCGPA = (float)mysqli_real_escape_string($conn, $_POST["indicatorCGPA"]);
            $newIndicatorLeadership = (int)mysqli_real_escape_string($conn, $_POST["indicatorLeadership"]);
            $newIndicatorGraduateAim = mysqli_real_escape_string($conn, $_POST["indicatorGraduateAim"]);
            $newIndicatorProfCert = (int)mysqli_real_escape_string($conn, $_POST["indicatorProfCert"]);
            $newIndicatorEmployability = (int)mysqli_real_escape_string($conn, $_POST["indicatorEmployability"]);
            $newIndicatorMobProg = (int)mysqli_real_escape_string($conn, $_POST["indicatorMobProg"]);

            $pushToDBQuery = "
                UPDATE indicator
                SET indicatorCGPA = '$newIndicatorCGPA', indicatorLeadership = '$newIndicatorLeadership',
                indicatorGraduateAim = '$newIndicatorGraduateAim', indicatorProfCert = '$newIndicatorProfCert',
                indicatorEmployability = '$newIndicatorEmployability', indicatorMobProg = '$newIndicatorMobProg'
                WHERE indicatorID = '$target';
            ";

            if (mysqli_query($conn, $pushToDBQuery)) {
                echo "
                    <script>
                        popup(\"Indicator info updated successfully.\", \"../kpimodule.php\");
                    </script>
                ";
            }
            else {
                echo "
                    <script>
                        popup(\"Oops. Something went wrong: ".mysqli_error($conn)."\", \"../aboutme_edit_personal.php\");
                    </script>
                ";
            }
        }

        mysqli_close($conn);
    ?>
</body>

</html>