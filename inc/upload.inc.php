<?php
    session_start();

    $uid = $_SESSION['u_uid'];

    include_once 'db.inc.php';

    if (isset($_POST['submit'])) {

        $file = $_FILES['uploadFileAvatar'];

        $fileName = $file['name'];
        $fileType = $file['type'];
        $fileTmpName = $file['tmp_name'];
        $fileError = $file['error'];
        $fileSize = $file['size'];
        
        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        // error handlers check file type
        $allowed = array('jpg', 'png', 'gif', 'jpeg', 'bmp');

        if (in_array($fileActualExt, $allowed)) {
            if($fileError === 0) {
                if($fileSize < 1000000) {
                    $fileNameNew = 'profile' .$uid. '.'.$fileActualExt;
                    $fileDestination = '../assets/img/' .$fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);

                    $sql = "UPDATE profile SET status = 1 WHERE uid = '$uid'";
                    mysqli_query($conn, $sql);
                    header("Location:../index.php");
                    exit();
                } else {
                    echo "<p>The size of the file is too large</p>";
                }
            } else {
                echo "<p>There was an error uploading the file</p>";
            }
        } else {
            echo "<p>You can not upload file with type</p>";
        }

    } else {
        header('Location: ../upload.php?action=error');
        exit();
    }
?>