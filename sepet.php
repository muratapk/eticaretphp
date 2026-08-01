<?php
include_once("config/settings.php");
$productId = $_POST['Id'];
$quantity = 1;
$card_id = 1;
$sql = "insert into cart_items (cart_id,product_id,quantity) values (?,?,?)";
$sorgu = $pdo->prepare($sql);
$sorgu->execute([$card_id, $productId, $quantity]);
echo "Sepette Eklendi";


?>