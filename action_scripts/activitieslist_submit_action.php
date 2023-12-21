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
                $pushToDBQuery = "INSERT INTO activity (activitySem, activityYear, activityType, activityLevel, activityDetails, activityRemarks, activityImagePath, accountID)
                VALUES ('$activitySem', '$activityYear', '$activityType', '$activityLevel', '$activityDetails', '$activityRemarks', '', '$target');
                ";

                if (mysqli_query($conn, $pushToDBQuery)) {  // if the connection to the DB and the query is successful
                    echo "
                        <script>
                            popup(\"New activity record added successfully.\", \"../activitieslist.php\");
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
            else if (isset($_FILES["activityImageToUpload"]) && $_FILES["activityImageToUpload"]["error"] == UPLOAD_ERR_OK) {
                // rationale: it may be possible that a user has several challenges that share a common image file name
                // in that case fetching the activityID would help differentiate between the images
                // the flow would go: (1) push the text data (2) fetch the row for this text data (3) upload the image
                $pushToDBQuery = "INSERT INTO activity (activitySem, activityYear, activityType, activityLevel, activityDetails, activityRemarks, accountID)
                VALUES('$activitySem', '$activityYear', '$activityType', '$activityLevel', '$activityDetails', '$activityRemarks', '$target');
                ";

                if (mysqli_query($conn, $pushToDBQuery)) {  // if the connection to the DB and the query is successful
                    // retrieve the last automatically generated challengeID
                    $lastInsertedID = mysqli_insert_id($conn);

                    $activityImageUploadFlag = 1;
                    $targetDirectory = "uploads/activities/";
                    $targetFile = '';
                    $filetmp = $_FILES["activityImageToUpload"];
                    $activityImageFileName = $filetmp["name"];

                    $targetFile = "../".$targetDirectory.$lastInsertedID."_".basename($_FILES["activityImageToUpload"]["name"]);
                    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

                    // check: if file already exists
                    if (file_exists($targetFile)) {
                        echo "
                            <script>
                                popup(\"ERROR-1: File already exists.\", \"../activitieslist.php\");
                            </script>
                        ";
                        $activityImageUploadFlag = 0;
                    }
                    // check: if file size <= 2MiB or 2097152 bytes
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
                        // push the image path to the DB
                        $imgName = $lastInsertedID."_".$activityImageFileName;
                        $fullPath = $targetDirectory.$imgName;
                        $pushToDBQuery= "
                            UPDATE activity
                            SET activityImagePath = '$fullPath'
                            WHERE activityID =  '$lastInsertedID';
                        ";

                        if (mysqli_query($conn, $pushToDBQuery)) {
                            // then, move a copy of the image to uploads/challenges
                            if (move_uploaded_file($_FILES["activityImageToUpload"]["tmp_name"], $targetFile)) {
                                echo "
                                    <script>
                                        popup(\"New activity record added successfully.\", \"../activitieslist.php\");
                                    </script>
                                ";
                            }
                        }
                    }
                }
                else {
                    echo "
                        <script>
                            popup(\"Oops. Something went wrong: ".mysqli_error($conn)."\", \"../aboutme_edit_personal.php\");
                        </script>
                    ";
                }
            }
        }

        mysqli_close($conn);
    ?>
</body>

</html>