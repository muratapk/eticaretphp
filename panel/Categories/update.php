<?php
include_once("../config/settings.php");
$name = $_POST['name'];
$SubCategory = $_POST['SubCategory'];
$id = $_POST['id'];
$sql = "Update Categories set name=?,SubCategory=? where id=?";
$sorgu = $pdo->prepare($sql);
$sorgu->execute([$name, $SubCategory, $id]);
echo "<a href='main.php'>Anasayfa</a>";



?>