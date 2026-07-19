<?php
include_once("../config/settings.php");
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$password = $_POST['password'];
$password_confirm = $_POST['password_confirm'];
$role = $_POST['role'];
$is_active = $_POST['is_active'];
$sql = "insert into Users (first_name,last_name,email,phone,password,role,is_active) values (?,?,?,?,?,?,?)";
$sorgu = $pdo->prepare($sql);
$sorgu->execute([$first_name, $last_name, $email, $phone, $password, $role, $is_active]);
echo "<a href='main.php'>Kaydınız Tamamlanmıştır.</a>";

?>