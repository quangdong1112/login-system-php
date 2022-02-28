
<nav class="nav nav-custom">
    <?php
        if (!isset($_SESSION['u_id'])) {
            echo '<h1>Login</h1>
                    <form action="inc/signin.inc.php" class="form-signin" method="POST">
                        <input type="text" name="user_uid" placeholder="Username/Email">
                        <input type="password" name="user_pswd" placeholder="Password">
                        <button type="submit" name="login" class="login">Login</button>
                    </form>
                    <a href="signup.php" class="btn btn-red signup">Register</a>';
        } else {
            echo '<a href="inc/logout.inc.php" class="btn btn-red signup">Logout</a>';
        }

    ?>

    
</nav>