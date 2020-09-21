<?php
session_start();
date_default_timezone_set("Asia/Jakarta");

require 'functions.php';

//Belum Login
if( !isset($_SESSION["login"])){
    header("Location: index.php");
    exit;
}

//Get Data from Database
$posting = query("SELECT * FROM post");
$user = query("SELECT * FROM user");

$username = $_SESSION["username"];
$nama = mysqli_query($db, "SELECT * FROM user WHERE username = '$username'");
$nama_profil = mysqli_fetch_assoc($nama);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/styles/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />
    <link rel="icon" href="./assets/images/logo.png">
    
    <title>HELLO</title>
</head>
<body>
    <!-- Burger -->
    <input type="checkbox" id="check">

    <!-- header -->
    <header>
        <div class="logo">
            <h3>Hello</h3>
        </div>
        <div class="logout">
            <a href="logout.php" class="logout_btn">Logout</a>
        </div>
    </header>

    <!-- sidebar -->
    <div class="sidebar">
        <label for="check">
            <i class="fa fa-bars" aria-hidden="true" id="sidebar_btn"></i>
        </label>

        <div class="center">
            <i class="fa fa-user-circle" aria-hidden="true"></i>
            <h5 class="text"><?=$nama_profil["name"]?></h5>
        </div>

        <a href="#" class="active"><i class="fa fa-home" aria-hidden="true"></i><span>Home</span></a>

    </div>

    <div class="content">
        <div class="chat-box" id="chat-box">
            <!-- <h5 class="date">Sat, 19 Sept 2020</h5> -->

            <!-- mencetak semua postingan -->
            <?php for($i = 0; $i < count($posting); $i++) : ?>
                <?php if($posting[$i]["id_parent"] == 0) : ?>
            <!-- Postingan Card -->
            <div class="post-card">

                <!-- Postingan -->
                <div class="blank"></div>
                <div class="post">
                    <?php if($posting[$i]["username"] == $username) : ?>
                        <form action="post.php" method="post">
                            <button type="submit" name="buttonDelpost" class="delete" value="<?= $posting[$i]["id"]?>"><i class="fa fa-times" aria-hidden="true"></i></button>
                        </form>
                    <?php endif; ?>
                    <div class="title">
                        <?php $nama_post = $posting[$i]["username"]; ?>
                        <?php $j = 0; ?>
                        <?php while($j < count($user) && $user[$j]["username"] != $nama_post) : ?>
                            <?php $j++; ?>
                        <?php endwhile; ?>
                        <h5 class="PostUser"><?php echo $user[$j]["name"]?></h5>
                        <h5 class="PostDate"><?= date('l, d M Y H:i', $posting[$i]["timestamp"])?></h5>
                    </div>
                    <h5 class="Postingan"><?= nl2br($posting[$i]["message"])?></h5>
                    <div class="countComment">
                        <?php $jumlah_komentar = 0 ?>
                        <?php for($k = 0; $k < count($posting); $k++) : ?>
                            <?php if($posting[$k]["id_parent"] != 0 && $posting[$i]["id"] == $posting[$k]["id_parent"]) : ?>
                                <?php $jumlah_komentar += 1; ?>
                            <?php endif;?>
                        <?php endfor; ?>
                        <h5 class="jumlah_komentar">
                            <?= $jumlah_komentar?> Repl<?php
                                if($jumlah_komentar > 1){echo("ies");}
                                else {echo("y");}
                            ;?>
                        </h5>
                    </div>
                </div>

                <!-- Komentar -->
                <!-- mencetak semua komentar pada postingan -->
                <?php for($l = 0; $l < count($posting); $l++) : ?>
                    <?php if($posting[$i]["id"] == $posting[$l]["id_parent"]) : ?>
                        <div class="comment">
                            <?php if($posting[$l]["username"] == $username) : ?>
                                <form action="reply.php" method="post">
                                    <button type="submit" name="buttonDelrep" class="delete" value="<?= $posting[$l]["id"]?>"><i class="fa fa-times" aria-hidden="true"></i></button>
                                </form>
                            <?php endif; ?>
                            <div class="title">
                                <?php $m = 0; ?>
                                <?php while($m < count($user) && $user[$m]["username"] != $posting[$l]["username"]) : ?>
                                    <?php $m++; ?>
                                <?php endwhile; ?>
                                <h5 class="PostUser"><?= $user[$m]["name"] ?></h5>
                                <h5 class="PostDate"><?= date('l, d M Y H:i', $posting[$l]["timestamp"])?></h5>
                            </div>
                            <h5 class="Postingan"><?= nl2br($posting[$l]["message"])?></h5>
                        </div>
                    <?php endif; ?>
                <?php endfor; ?>
                
                <!-- Reply -->
                <form method="post" action="reply.php">
                    <div class="reply">
                        <textarea name="reply_area" class="reply-area" placeholder="Reply" rows="1" required=""></textarea>
                        <button type="submit" class="button" name="reply" value="<?= $posting[$i]["id"]?>"><i class="fa fa-reply" aria-hidden="true"></i></button>
                    </div>
                </form>
                <div class="blank"></div>
            </div>

                <?php endif; ?>
            <?php endfor; ?>

            
        </div>

        <div class="box">
            <form method="post" action="post.php">
                <textarea id="user_post" placeholder="Say Something . . ." rows="1" name="posting_area" required></textarea>
                <button type="submit" class="button" name="posting"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
            </form>
        </div>
    </div>

    <script src="assets/script/home.js"></script>

</body>
</html>