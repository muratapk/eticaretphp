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
    if (isset($_POST['benihatirla'])) {
        setcookie("kullanici", $email, time() + (30 * 24 * 60 * 60), "/");
    } else {
        // İşaretli değilse cookie'yi sil
        setcookie("kullanici", "", time() - 3600, "/");
    }
    $_SESSION['email'] = $email;


    header("Refresh:2;url=panel/index.php");


} else {
    echo "<script>history.go(-1);</script>";
}


?>