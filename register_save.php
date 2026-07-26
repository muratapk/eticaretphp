<?php
include_once("config/settings.php");
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$password = $_POST['password'];
$confim_password = $_POST['confirm_password'];
$role = "customer";
$created_at = date("Y-m-d H:i:s");
if ($password == $confim_password) {
    $password = md5($password);
    $sql = "insert into users (first_name,last_name,email,phone,password_hash,role,created_at)
    values (?,?,?,?,?,?,?)";
    $sorgu = $pdo->prepare($sql);
    $sorgu->execute([$first_name, $last_name, $email, $phone, $password, $role, $created_at]);
    echo "Kaydınız Yapılmıştır";
    header("Refresh:2;url=index.php");





} else {
    echo "<script>history.back()</script>";
}


?>