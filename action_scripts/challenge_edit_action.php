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
            $target = mysqli_real_escape_string($conn, $_POST["challengeID"]);
            $newChallengeSem = mysqli_real_escape_string($conn, $_POST["challengeSem"]);
            $newChallengeYear = mysqli_real_escape_string($conn, $_POST["challengeYear"]);
            $newChallengeDetails = mysqli_real_escape_string($conn, $_POST["challengeDetails"]);
            $newChallengeFuturePlan = mysqli_real_escape_string($conn, $_POST["challengeFuturePlan"]);
            $newChallengeRemark = mysqli_real_escape_string($conn, $_POST["challengeRemark"]);

            // for image upload
            $challengeImageUploadFlag = 0;

            if (isset($_FILES["challengeImageToUpload"]) && $_FILES["challengeImageToUpload"]["name"] == "") {
                $pushToDBQuery = "
                    UPDATE challenge
                    SET challengeSem = '$newChallengeSem', challengeYear = '$newChallengeYear',
                    challengeDetails = '$newChallengeDetails', challengeFuturePlan = '$newChallengeFuturePlan',
                    challengeRemark = '$newChallengeRemark'
                    WHERE challengeID = '$target';
                ";
 
                if (mysqli_query($conn, $pushToDBQuery)) {
                    echo "
                        <script>
                            popup(\"Challenge info updated successfully.\", \"../challenges.php\");
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
            else if (isset($_FILES["challengeImageToUpload"]) && $_FILES["challengeImageToUpload"]["error"] == UPLOAD_ERR_OK) {
                $challengeImageUploadFlag = 1;
                $targetDirectory = "uploads/challenges/";
                $filetmp = $_FILES["challengeImageToUpload"];
                $newChallengeImageFileName = $filetmp["name"];

                $targetFile = "../".$targetDirectory.$target."_".basename($_FILES["challengeImageToUpload"]["name"]);
                $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

                // check: if file already exists
                if (file_exists($targetFile)) {
                    echo "
                        <script>
                            popup(\"ERROR-1: File already exists.\", \"..\challenges.php\");
                        </script>
                    ";
                    $challengeImageUploadFlag = 0;
                }
                // check: if file size > 2MiB or 2097152 bytes
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
                    // first, unlink the current image
                    $imgPathSeekQuery = "SELECT * FROM challenge WHERE challengeID='$target'";
                    $return = mysqli_query($conn, $imgPathSeekQuery);
                    $row = mysqli_fetch_assoc($return);
                    $imgToDelete = "../".$row["challengeImagePath"];
                    if ($imgToDelete != "") {
                        unlink($imgToDelete);
                    }

                    // push the updated data to the DB first
                    $imgName = $target."_".$newChallengeImageFileName;
                    $fullPath = $targetDirectory.$imgName;
                    $pushToDBQuery = "
                        UPDATE challenge
                        SET challengeSem = '$newChallengeSem', challengeYear = '$newChallengeYear',
                        challengeDetails = '$newChallengeDetails', challengeFuturePlan = '$newChallengeFuturePlan',
                        challengeRemark = '$newChallengeRemark', challengeImagePath = '$fullPath'
                        WHERE challengeID = '$target';
                    ";

                    if (mysqli_query($conn, $pushToDBQuery)) {
                        // then, move a copy of the image to uploads/challenges
                        if (move_uploaded_file($_FILES["challengeImageToUpload"]["tmp_name"], $targetFile)) {
                            echo "
                                <script>
                                    popup(\"Challenge info updated successfully.\", \"../challenges.php\");
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
                }

                mysqli_close($conn);
            }
        }
    ?>
</body>

</html>