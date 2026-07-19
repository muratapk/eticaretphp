<?php
include_once("../config/settings.php");
$name = $_POST['name'];
$SubCategory = $_POST['SubCategory'];
$sql = "insert into Categories (name,SubCategory) values (?,?)";
$sorgu = $pdo->prepare($sql);
$sorgu->execute([$name, $SubCategory]);
echo "Kayıt Yapılmıştir";
echo "<a href='main.php'>Anasayfa</a>";


?>