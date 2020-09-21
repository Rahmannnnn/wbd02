<?php 
session_start();

require 'functions.php';

if(isset($_POST["signup"])) {
    $username = strtolower($_POST["username"]);
    $password = $_POST["password"];
    $name = $_POST["name"];

    //Cek username
    $result = mysqli_query($db, "SELECT * FROM user WHERE username = '$username'");
    if( mysqli_num_rows($result) < 1) {
        $query = "INSERT INTO user VALUES ('', '$username', '$password', '$name')";
        mysqli_query($db, $query);

        $_SESSION["login"] = true;
        $_SESSION["username"] = $username;

        header("Location: home.php");
        exit;
    }
    $error = true;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HELLO - Sign Up</title>
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
                        <input type="text" name="name" id="name" required>
                        <label for="name">Nama Lengkap</label>
                    </div>
                    <div>
                        <input type="text" name="username" id="username" required>
                        <label for="password">Username</label>
                    </div>
                    <div>
                        <input type="password" name="password" id="password" required>
                        <label for="password">Password</label>
                    
                        <i class="fa fa-eye" id="eye1" aria-hidden="true" id="eye1" onclick="hidePass()"></i>
                        <i class="fa fa-eye-slash" id="eye2" aria-hidden="true" id="eye2" onclick="showPass()"></i>
                        
                        <?php if( isset($error)) : ?>
                            <h5>Username sudah ada!</h5>
                        <?php endif; ?>
                    </div>
                    
                     
                    <input type="submit" name="signup" class="btn" value="Sign Up">
                    <h5>Already have an account? <a href="login.php">Log In</a></h5>
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