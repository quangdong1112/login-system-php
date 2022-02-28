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
            <h3>Sigup</h3>
            <div class="form-signup">
                <form action="inc/signup.inc.php" method="POST">
                    <input type="text" name="user_first" placeholder="First Name">
                    <input type="text" name="user_last" placeholder="Last Name">
                    <input type="email" name="user_email" placeholder="Email">
                    <input type="text" name="user_uid" placeholder="Username">
                    <input type="password" name="user_pswd" placeholder="Password">
                    <input type="password" name="user_pswd2" placeholder="Re Password">
                    <button class="btn btn-signup" name="submit" type="submit">Register</button>
                </form>
            </div>
        </section>
        <?php
            include_once 'includes/footer.php';
        ?>
    </div>
</body>
</html>