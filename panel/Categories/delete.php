<?php
include_once("../config/settings.php");
$id = $_REQUEST['id'];
$sql = "Delete from Categories where id=?";
$sorgu = $pdo->prepare($sql);
$sorgu->execute([$id]);
echo "<a href='main.php'>Kayıt Silindi Anasayfa Git >>></a>";


?>