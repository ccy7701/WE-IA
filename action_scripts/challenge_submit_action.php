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
            $challengeSem = mysqli_real_escape_string($conn, $_POST["challengeSem"]);
            $challengeYear = mysqli_real_escape_string($conn, $_POST["challengeYear"]);
            $challengeDetails = mysqli_real_escape_string($conn, $_POST["challengeDetails"]);
            $challengeFuturePlan = mysqli_real_escape_string($conn, $_POST["challengeFuturePlan"]);
            $challengeRemark = mysqli_real_escape_string($conn, $_POST["challengeRemark"]);
        
            // for image upload
            $challengeImageUploadFlag = 0;

            // IF THERE IS NO ATTACHED IMAGE
            if (isset($_FILES["challengeImageToUpload"]) && $_FILES["challengeImageToUpload"]["name"] == "") {
                echo "Say something";

                $pushToDBQuery = "INSERT INTO challenge (challengeSem, challengeYear, challengeDetails, challengeFuturePlan, challengeRemark, challengeImagePath, accountID)
                VALUES ('$challengeSem', '$challengeYear', '$challengeDetails', '$challengeFuturePlan', '$challengeRemark', '', '$target');
                ";

                if (mysqli_query($conn, $pushToDBQuery)) { // if the connection to the DB and the query is successful
                    echo "
                        <script>
                            popup(\"New challenge record added successfully.\", \"../challenges.php\");
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
            }
            else if (isset($_FILES["challengeImageToUpload"]) && $_FILES["challengeImageToUpload"]["error"] == UPLOAD_ERR_OK) {
                // rationale: it may be possible that a user has several challenges that share a common image file name
                // in that case fetching the challengeID would help differentiate between the images
                // the flow would go: (1) push the text data (2) fetch the row for this text data (3) upload the image
                $pushToDBQuery = "INSERT INTO challenge (challengeSem, challengeYear, challengeDetails, challengeFuturePlan, challengeRemark, accountID)
                VALUES('$challengeSem', '$challengeYear', '$challengeDetails', '$challengeFuturePlan', '$challengeRemark', '$target');
                ";

                // MORE MODIFICATION IS NEEDED HERE
                if (mysqli_query($conn, $pushToDBQuery)) {  // if the connection to the DB and the query is successful
                    // retrieve the last automatically generated challengeID
                    $lastInsertedID = mysqli_insert_id($conn);
                    
                    $challengeImageUploadFlag = 1;
                    $targetDirectory = "uploads/challenges/";
                    $targetFile = '';
                    $filetmp = $_FILES["challengeImageToUpload"];
                    $challengeImageFileName = $filetmp["name"];
        
                    $targetFile = "../".$targetDirectory.$lastInsertedID."_".basename($_FILES["challengeImageToUpload"]["name"]);
                    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

                    // check: if file already exists
                    if (file_exists($targetFile)) {
                        echo "
                            <script>
                                popup(\"ERROR-1: File already exists.\", \"../challenges.php\");
                            </script>
                        ";
                        $challengeImageUploadFlag = 0;
                    }
                    // check: if file size <= 2MiB or 2097152 bytes
                    if ($_FILES["challengeImageToUpload"]["size"] > 2097152) {
                        echo "
                            <script>
                                popup(\"ERROR-2: File size exceeds allowed limit.\", \"../challenges.php\");
                            </script>
                        ";
                        $challengeImageUploadFlag = 0;
                    }
                    // check: if file follows file format constraints
                    if ($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png") {
                        echo "
                            <script>
                                popup(\"ERROR-3: File does not follow file type constraints.\", \"../challenges.php\");
                            </script>
                        ";
                        $challengeImageUploadFlag = 0;
                    }

                    if ($challengeImageUploadFlag) {
                        // push the image path to the DB
                        $imgName = $lastInsertedID."_".$challengeImageFileName;
                        $fullPath = $targetDirectory.$imgName;
                        $pushToDBQuery = "
                            UPDATE challenge
                            SET challengeImagePath = '$fullPath'
                            WHERE challengeID = '$lastInsertedID';
                        ";

                        if (mysqli_query($conn, $pushToDBQuery)) {
                            // then, move a copy of the image to uploads/challenges
                            if (move_uploaded_file($_FILES["challengeImageToUpload"]["tmp_name"], $targetFile)) {
                                echo "
                                    <script>
                                        popup(\"New challenge record added successfuly.\", \"../challenges.php\");
                                    </script>
                                ";
                            }
                        }
                    }
                }
                else {
                    echo "
                        <script>
                            popup(\"Oops. Something went wrong.\", \"../challenges.php\");
                        </script>
                    ";
                }
            }
        }

        mysqli_close($conn);
    ?>
</body>

</html>