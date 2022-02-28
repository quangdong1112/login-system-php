<?php
    // check data back-end
    if(isset($_POST['submit'])) {
        // connect database
        include_once 'db.inc.php';

        // except error special charset
        $first = mysqli_escape_string($conn, $_POST['user_first']); 
        $last = mysqli_escape_string($conn, $_POST['user_last']);
        $email = mysqli_escape_string($conn, $_POST['user_email']);
        $name = mysqli_escape_string($conn, $_POST['user_uid']);
        $pswd = mysqli_escape_string($conn, $_POST['user_pswd']);
        $pswd2 = mysqli_escape_string($conn, $_POST['user_pswd2']);

        // Error handlers
            // Check for empty fields
        if (empty($first) || empty($last) || 
            empty($email) || empty($name) || 
            empty($pswd)  || empty($pswd2)) {
                header('Location: ../signup.php?signup=empty');
                exit();
        } else {
            // check character input name
            if (!preg_match("/^[a-zA-Z]*$/", $first) || !preg_match("/^[a-zA-Z]*$/", $last)) {
                header('Location: ../signup.php?signup=invalid');
                exit();
            }
            else {
                // check valid email
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    header('Location: ../signup.php?signup=email');
                    exit();
                } else {
                    if ($pswd !== $pswd2) {
                        header('Location: ../signup.php?signup=pswd');
                        exit();
                    }
                    else {
                        // check exits account
                        $sql = "SELECT * FROM users WHERE user_uid='$name'";
                        $result = mysqli_query($conn, $sql);
                        $checkResult = mysqli_num_rows($result);
                        if ($checkResult > 0) {
                            header('Location: ../signup.php?signup=usertaken');
                            exit();
                        } else {
                            // hashing password
                            $hashPwd = password_hash($pswd, PASSWORD_DEFAULT);
                            // insert database
                            $sql  = "INSERT INTO users(user_first, user_last, user_email, user_uid, user_pswd) VALUES ('$first', '$last', '$email','$name','$hashPwd')";
                            $sql2 = "INSERT INTO profile(uid, status) VALUES ('$name', 0)";
                            $result = mysqli_query($conn, $sql);
                            $result2 = mysqli_query($conn, $sql2);
                            if($result && $result2){
                                header('Location: ../index.php?signup=success');
                                exit();
                            } else {
                                echo "error";
                            }
                                
                        }
                    }
                }
            }
        }

    } else {
        header('Location: ../signup.php?signup=error');
        exit();
    }
?>