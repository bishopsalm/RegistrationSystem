<?php include('server.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="header">
        <h1>Login</h1>
    </div>
    
    <form method="post" action="login.php">
        <!-- error message to be displayed here -->
        <?php include ('errors.php'); ?>

        <div class="input-group">
            <label>Username</label>
            <input type="text" name="username" value="<?php echo $username ?>">
        </div>
        <div class="input-group">
            <label>Password</label>
            <input type="password" name="password">
        </div>
        <div class="input-group">
            <button type="submit" name="login" class="btn">Login</button>
        </div>
        <p>
            Not yet a member? <a href="register.php">Sign up</a>
        </p>
    </form>



</body>
</html>