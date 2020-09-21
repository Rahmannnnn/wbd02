<?php

session_start();

require 'functions.php';

if(isset($_POST["login"])) {

    $username = strtolower($_POST["username"]);
    $password = $_POST["password"];

    //Cek username
    $result = mysqli_query($db, "SELECT * FROM user WHERE username = '$username'");
    if( mysqli_num_rows($result) === 1) {
        //Cek Password
        $row = mysqli_fetch_assoc($result);
        if($row["password"] === $password){
            //Set Session
            $_SESSION["login"] = true;
            $_SESSION["username"] = $username;
            
            header("Location: home.php");
            exit;
        }
    }
    $error = true;
}

//Ke halaman home.php
if(isset($_SESSION["login"])){
    header("Location: home.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HELLO - Log In</title>
    <link rel="icon" href="./assets/images/logo.png">
    <link rel="stylesheet" href="assets/styles/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="banner">
                <span class="typed"></span>
                <h1>on HELLO</h1>
            </div>
            <div class="field">
                <form action="" method="post">
                    <div>
                        <input type="text" id="username" name="username" required>
                        <label for="password">Username</label>
                    </div>
                    <div>
                        <input type="password" id="password" name="password" required>
                        <label for="password">Password</label>
                    
                        <i class="fa fa-eye" id="eye1" aria-hidden="true" id="eye1" onclick="hidePass()"></i>
                        <i class="fa fa-eye-slash" id="eye2" aria-hidden="true" id="eye2" onclick="showPass()"></i>

                        <?php if( isset($error)) : ?>
                            <h5>Username/Password salah!</h5>
                        <?php endif; ?>
                    </div>

                    <input type="submit" name="login" value="Log In">
                    <h5>Don't have an account? <a href="signup.php">Sign Up</a></h5>
                </form>
            </div>
        </div>
    </div>
    
    <script src="assets/script/password.js"></script>
    <script src="assets/script/typed.js"></script>            
    <script>
        const typed = new Typed('.typed', {
            strings: ['Say Hi!', 'Say <strong>Hello :)</strong>', 'Say Everything you want'],
            typeSpeed: 50,
            backSpeed: 50,
            backDelay: 500,
            startDelay: 1000,
            loop: true
        });
    </script>
</body>
</html>