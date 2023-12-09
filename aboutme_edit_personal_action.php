<?php
    session_start();
    include("include/config.php");
?>

<!DOCTYPE HTML>
<html lang="en">

<html>

<head>
    <title>Edit Confirmation</title>
    <script src="sitejavascript.js"></script>
</head>

<body>
    <?php
        // commit to the database the data from the editable fields ONLY
        // whatever is set to 'disabled' in the form, stays unchanged in the DB
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $target = $_SESSION["UID"];
            // but why not $target = $_POST["student_id"]....
            $new_student_email = mysqli_real_escape_string($conn, $_POST["student_email"]);
            $new_student_phone = mysqli_real_escape_string($conn, $_POST["student_phone"]);
            $new_student_mentor = mysqli_real_escape_string($conn, $_POST["student_mentor"]);
            $new_student_state = mysqli_real_escape_string($conn, $_POST["student_state"]);
            $new_student_address = mysqli_real_escape_string($conn, $_POST["student_address"]);
            $new_student_motto = mysqli_real_escape_string($conn, $_POST["student_motto"]);

            // this is in testing. specifically for image upload only.
            $pfpUploadFlag = 0;

            // IF THERE IS NO NEW IMAGE
            if (isset($_FILES["pfpToUpload"]) && $_FILES["pfpToUpload"]["name"] == "") {
                echo "
                    <script>
                        popup('Personal info updated successfully.', 'aboutme.php');
                    </script>
                ";

                $pushToDBQuery = "
                UPDATE student_profile
                SET student_email = '$new_student_email', student_phone = '$new_student_phone',
                student_mentor = '$new_student_mentor', student_state = '$new_student_state',
                student_address = '$new_student_address', student_motto = '$new_student_motto'
                WHERE student_id='$target';
                ";
    
                if (mysqli_query($conn, $pushToDBQuery)) {
                    echo "<script>popup(\"Personal info updated successfully.\", \"aboutme.php\");</script>";
                }
                else {
                    echo "
                        <script>
                            popup('Oops. Something went wrong.', 'aboutme_edit_personal.php');
                        </script>
                    ";
                }
    
                mysqli_close($conn);
            }
            // IF THERE IS A NEW IMAGE
            else if (isset($_FILES["pfpToUpload"]) && $_FILES["pfpToUpload"]["error"] == UPLOAD_ERR_OK) {
                $pfpUploadFlag = 1;
                $targetDirectory = "uploads/student_profile_imgs/";
                $targetFile = '';
                $filetmp = $_FILES["pfpToUpload"];
                $pfpFileName = $filetmp["name"];

                $targetFile = $targetDirectory.$target."_".basename($_FILES["pfpToUpload"]["name"]);
                $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

                // check: if file already exists
                if (file_exists($targetFile)) {
                    echo "
                        <script>
                            popup('ERROR-1: File already exists.', 'aboutme_edit_personal.php');
                        </script>
                    ";
                    $pfpUploadFlag = 0;
                }
                // check: if file size <= 2MiB or 2097152 bytes
                if ($_FILES["pfpToUpload"]["size"] > 2097152) {
                    echo "
                    <script>
                        popup('ERROR-2: File size exceeds allowed limit.', 'aboutme_edit_personal.php');
                    </script>
                    ";
                    $pfpUploadFlag = 0;
                }
                // check: if file follows file format constraints
                if ($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png") {
                    echo "
                        <script>
                            popup('ERROR-3: File does not follow file type constraints.', 'aboutme_edit_personal.php');
                        </script>
                    ";
                    $pfpUploadFlag = 0;
                }

                if ($pfpUploadFlag) {
                    // first, unlink the current image
                    $imgPathSeekQuery = "SELECT * FROM student_profile WHERE student_id='$target'";
                    $return = mysqli_query($conn, $imgPathSeekQuery);
                    $row = mysqli_fetch_assoc($return);
                    $imgToDelete = $row["student_imgpath"];
                    if ($imgToDelete != "") {
                        unlink($imgToDelete);
                    }

                    // push the updated data to the DB first
                    $imgName = $target."_".$pfpFileName;
                    $fullPath = $targetDirectory.$imgName;
                    $pushToDBQuery = "
                        UPDATE student_profile
                        SET student_email = '$new_student_email', student_phone = '$new_student_phone',
                        student_mentor = '$new_student_mentor', student_state = '$new_student_state',
                        student_address = '$new_student_address', student_motto = '$new_student_motto',
                        student_imgpath = '$fullPath'
                        WHERE student_id='$target';
                    ";

                    if (mysqli_query($conn, $pushToDBQuery)) {
                        // then, move a copy of the image to uploads/student_profile_imgs
                        if (move_uploaded_file($_FILES["pfpToUpload"]["tmp_name"], $targetFile)) {
                            echo "
                            <script>
                                popup('Personal info updated successfully.', 'aboutme.php');
                            </script>
                            ";
                        }
                        else {
                            echo "
                            <script>
                                popup('Oops. Something went wrong.', 'aboutme_edit_personal.php');
                            </script>
                            ";
                        }
                    }
                    else {
                        echo "
                            <script>
                                popup('Oops. Something went wrong.', 'aboutme_edit_personal.php');
                            </script>
                        ";
                    }

                    mysqli_close($conn);
                }
            }
        }
    ?>
</body>

</html>