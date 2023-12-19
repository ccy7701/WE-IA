<?php
    session_start();
    include("../include/config.php");
?>

<!DOCTYPE HTML>
<html lang="en">

<html>

<head>
    <title>Edit Activity Record</title>
    <script src="../sitejavascript.js"></script>
</head>

<body>
    <?php
        // commit to the database
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $target = mysqli_real_escape_string($conn, $_POST["activityID"]);
            $newActivitySem = mysqli_real_escape_string($conn, $_POST["activitySem"]);
            $newActivityYear = mysqli_real_escape_string($conn, $_POST["activityYear"]);
            $newActivityType = mysqli_real_escape_string($conn, $_POST["activityType"]);
            $newActivityLevel = mysqli_real_escape_string($conn, $_POST["activityLevel"]);
            $newActivityDetails = mysqli_real_escape_string($conn, $_POST["activityDetails"]);
            $newActivityRemarks = mysqli_real_escape_string($conn, $_POST["activityRemarks"]);

            // for image upload
            $activityImageUploadFlag = 0;

            if (isset($_FILES["activityImageToUpload"]) && $_FILES["activityImageToUpload"]["name"] == "") {
                $pushToDBQuery = "
                    UPDATE activity
                    SET activitySem = '$newActivitySem', activityYear = '$newActivityYear',
                    activityType = '$newActivityType', activityLevel = '$newActivityLevel',
                    activityDetails = '$newActivityDetails', activityRemarks = '$newActivityRemarks'
                    WHERE activityID = '$target';
                ";
    
                if (mysqli_quey($conn, $pushToDBQuery)) {
                    echo "
                        <script>
                            popup(\"Activity info updated successfully\", \"../activitieslist.php\");
                        </script>
                    ";
                }
                else {
                    echo "
                        <script>
                            popup(\"Oops. Something went wrong.\", \"../activitieslist.php\");
                        </script>
                    ";
                }
    
                mysqli_close($conn);
            }
            else if (isset($_FILES["activityImageToUpload"]) && $_FILES["activityImageToUpload"]["error"] == UPLOAD_ERR_OK) {
                $activityImageUploadFlag = 1;
                $targetDirectory = "uploads/activities/";
                $filetmp = $_FILES["activityImageToUpload"];
                $newActivityImageFileName = $filetmp["name"];
    
                $targetFile = "../".$targetDirectory.$target."_".basename($_FILES["activityImageToUpload"]["name"]);
                $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    
                // check: if file already exists
                if (file_exists($targetFile)) {
                    echo "
                        <script>
                            popup(\"ERROR-1: File already exists.\", \"..\activitieslist.php\");
                        </script>
                    ";
                    $activityImageUploadFlag = 0;
                }
                // check: if file size > 2MiB or 2097152 bytes
                if ($_FILES["activityImageToUpload"]["size"] > 2097152) {
                    echo "
                        <script>
                            popup(\"ERROR-2: File size exceeds allowed limit.\", \"../activitieslist.php\");
                        </script>
                    ";
                    $activityImageUploadFlag = 0;
                }
                // check: if file follows file format constraints
                if ($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png") {
                    echo "
                        <script>
                            popup(\"ERROR-3: File does not follow file type constraints.\", \"../activitieslist.php\");
                        </script>
                    ";
                    $activityImageUploadFlag = 0;
                }
    
                if ($activityImageUploadFlag) {
                    // first, unlink the current image
                    $imgPathSeekQuery = "SELECT * FROM activity WHERE activityID='$target'";
                    $return = mysqli_query($conn, $imgPathSeekQuery);
                    $row = mysqli_fetch_assoc($return);
                    $imgToDelete = "../".$row["activityImagePath"];
                    if ($imgToDelete != "") {
                        unlink($imgToDelete);
                    }
    
                    // push the updated data to the DB first
                    $imgName = $target."_".$newActivityImageFileName;
                    $fullPath = $targetDirectory.$imgName;
                    $pushToDBQuery = "
                        UPDATE activity
                        SET activitySem = '$newActivitySem', activityYear = '$newActivityYear',
                        activityType = '$newActivityType', activityLevel = '$newActivityLevel',
                        activityDetails = '$newActivityDetails', activityRemarks = '$newActivityRemarks',
                        activityImagePath = '$fullPath'
                        WHERE activityID = '$target';
                    ";
    
                    if (mysqli_query($conn, $pushToDBQuery)) {
                        // then, move a copy of the image to uploads/challenges
                        if (move_uploaded_file($_FILES["activityImageToUpload"]["tmp_name"], $targetFile)) {
                            echo "
                                <script>
                                    popup(\"Challenge info updated successfully.\", \"../activitieslist.php\");
                                </script>
                            ";
                        }
                        else {
                            echo "
                                <script>
                                    popup(\"Oops. Something went wrong.\", \"../activitieslist.php\");
                                </script>
                            ";
                        }
                    }
                }

                mysqli_close($conn);
            }
        }
    ?>
</body>

</html>