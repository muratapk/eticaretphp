<?php
include_once("../config/settings.php");
// POST verilerini al
$owner_id = $_POST['owner_id'] ?? 0;
$name = trim($_POST['name'] ?? '');
$description = trim($_POST['description'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$email = trim($_POST['email'] ?? '');
$address = trim($_POST['address'] ?? '');
$city = trim($_POST['city'] ?? '');
$district = trim($_POST['district'] ?? '');
$latitude = $_POST['latitude'] ?? null;
$longitude = $_POST['longitude'] ?? null;
$minimum_order_amount = $_POST['minimum_order_amount'] ?? 0;
$delivery_fee = $_POST['delivery_fee'] ?? 0;
$is_open = $_POST['is_open'] ?? 1;
$is_active = $_POST['is_active'] ?? 1;
$created_at = date("Y-mm-dd");
// Zorunlu alan kontrolü
if (empty($owner_id) || empty($name)) {
    die("Owner ID ve Restoran Adı zorunludur.");
}



$id = $_POST['id'];
$sql = "Update Restaurants set owner_id=?, name=?,description=?,phone=?,email=?,address=?,city=?,district=?,latitude=?,longitude=?,minimum_order_amount=?,delivery_fee=?,is_open=?,is_active=? where id=?";
$sorgu = $pdo->prepare($sql);
$sorgu->execute([
    $owner_id,
    $name,
    $description,
    $phone,
    $email,
    $address,
    $city,
    $district,
    $latitude,
    $longitude,
    $minimum_order_amount,
    $delivery_fee,
    $is_open,
    $is_active,
    $id
]);
echo "<a href='main.php'>Anasayfa</a>";



?>