<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page Login System</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="wrap">
        <?php
            include_once 'includes/nav.php';
        ?>
        <section class="">
            <h3>Home</h3>
            <div class="wrap-img">
                <div class="content-selfimg">
                    <div class="wrap-selfimg">
                    <?php

                        if (isset($_SESSION['u_id'])) {
                            include_once 'inc/db.inc.php';
                            echo '<p class="selfname">You are logged in by '.$_SESSION['u_uid'].'</p>';

                            $uid = $_SESSION['u_uid'];

                            $sql = "SELECT * FROM profile WHERE uid ='$uid'";
                            $result = mysqli_query($conn, $sql);
                            $checkResult = mysqli_num_rows($result);
                            if ($checkResult > 0) {
                                $row = mysqli_fetch_assoc($result);
                                if($row['status'] == 1) {
                                    echo '<img src="assets/img/profile'.$uid.'.png" alt="" class="img-user selfuser">';
                                }
                                else {
                                    echo '<img src="assets/img/profiledefault.png" alt="" class="img-user selfuser">';
                                }
                            }
                            echo '
                                <p class="selfname2">'.$_SESSION['u_uid'].'</p>
                                <p class="selfemail">'.$_SESSION['u_email'].'</p>
                                <form class="form-upload-profile" action="inc/upload.inc.php" method="POST" enctype="multipart/form-data">
                                    <input  type="file" name="uploadFileAvatar" id="uploadFileAvatar" width="100px">
                                    <label class="uploadFileAvatar" for="uploadFileAvatar">Change your profile</label>
                                    <button class="btn-upload" type="submit" name="submit">UPLOAD</button>
                                </form>';

                        } else {
                            echo "<p>You are not logged in!</p>";
                        }
                    ?>

                    </div>
                </div>
            </div>
        </section>
        <?php
            include_once 'includes/footer.php';
        ?>
    </div>
</body>
</html>