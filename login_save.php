<?php
session_start();
include_once("config/settings.php");
$email = $_POST['email'];
$password = md5($_POST['password']);
$sql = "Select * from users where email=? and password_hash=?";
$sorgu = $pdo->prepare($sql);
$sorgu->execute([$email, $password]);
$uye = $sorgu->fetch(PDO::FETCH_ASSOC);
if ($uye) {
    header("Refresh:2;url=panel/main.php");
    $_SESSION['email'] = $email;
} else {
    echo "<script>history.go(-1);</script>";
}


?>