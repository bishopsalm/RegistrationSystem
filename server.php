<?php
    session_start();

    $username = "";
    $email = "";
    $minpassword = 8;
    $errors = array();

    // Connecting to database
    $db = mysqli_connect('localhost', 'root', '', 'registration');

    // When register button is clicked
    if (isset($_POST['register'])) {
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
        $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

        // affirm form fields are filled appropriately
        if (empty($username)) {
            array_push($errors, "Username is required");
        }
        if (empty($email)) {
            array_push($errors, "Email is required");
        }
        if (empty($password_1)) {
            array_push($errors, "Password is required");
        }
        if (strlen($password_1) < $minpassword) {
            array_push($errors, "Password requires min of eight characters");
        }
        if ($password_1 != $password_2) {
            array_push($errors, "Password do not match");
        }

        // if no error, save user to database
        if (count($errors) == 0) {
            $password = md5($password_1); // encrypt password before saving to database
            $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
            mysqli_query($db, $sql);

            $_SESSION['username'] = $username;
            $_SESSION['success'] = "You are now logged in";
            header('location: index.php'); // redirect to homepage

        }
    }

    // log user in from login page
    if (isset($_POST['login'])) {
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $password = mysqli_real_escape_string($db, $_POST['password']);

        // affirm form fields are filled appropriately
        if (empty($username)) {
            array_push($errors, "Username is required");
        }
        if (empty($password)) {
            array_push($errors, "Password is required");
        }

        // error check
        if (count($errors) == 0) {
            $password = md5($password); // encrypt password before comparing with the one in the database
            $query = "SELECT * FROM users WHERE username ='$username' AND password = '$password'";
            $result = mysqli_query($db, $query);
            if (mysqli_num_rows($result) == 1) {
                // log user in
                $_SESSION['username'] = $username;
                $_SESSION['success'] = "You are now logged in";
                header('location: index.php'); // redirect to homepage
            }else{
                array_push($errors, "Wrong username/password combination");
            }
        }
    }



    // logout
    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['username']);
        header('location: login.php');
    }
?>