<?php
    session_start();    
    if (isset($_POST['login'])) {
    // connect database
        include_once 'db.inc.php';
    // except error special charset
        $name = mysqli_escape_string($conn, $_POST['user_uid']);
        $pswd = mysqli_escape_string($conn, $_POST['user_pswd']);

    // error error
        if (empty($name) || empty($pswd)) {
            header('Location: ../index.php?login=empty');
            exit();
        } else {
            $sql = "SELECT * FROM users WHERE user_uid ='$name'";
            $result = mysqli_query($conn, $sql);
            $checkResult = mysqli_num_rows($result);
            if ($checkResult ==0) {
                header('Location: ../index.php?login=nouid');
                exit();
            } else {
                if( $row = mysqli_fetch_assoc($result)) {
                    $hashPwd = password_verify($pswd, $row['user_pswd']);
                    if ($hashPwd == false) {
                        header('Location: ../index.php?login=pwdfail');
                        exit();
                    }
                    else if($hashPwd == true) {
                        $_SESSION['u_id'] = $row['user_id'];
                        $_SESSION['u_first'] = $row['user_first'];
                        $_SESSION['u_last'] = $row['user_last'];
                        $_SESSION['u_email'] = $row['user_email'];
                        $_SESSION['u_uid'] = $row['user_uid'];
                        $_SESSION['u_id'] = $row['user_id'];
                        header('Location: ../index.php?login=success');
                        exit();
                    }
                }
            }
        }
    } else {
        header('Location: ../index.php?login=error');
    }
?>