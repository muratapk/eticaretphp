<?php
include_once("../config/settings.php");



// Form verileri
$restaurant_id = $_POST['restaurant_id'] ?? 0;
$category_id = $_POST['category_id'] ?? 0;
$name = trim($_POST['name'] ?? '');
$description = trim($_POST['description'] ?? '');
$price = $_POST['price'] ?? 0;
$is_available = $_POST['is_available'] ?? 1;

// Resim yükleme
$image_url = null;

if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {

    $uploadDir = "../Product_Images/";

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $extension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
    //gelen dosyanını yol bilgiisin pathinfo ile dosyanın bilgini burada
    //PATHINFO_EXTENSION ile dosyasının uzantı strtolower dosya uzantısını küçük harfe çevir

    $fileName = uniqid() . "." . $extension;
    //uniqid() benzersiz rakamlar oluşturuyor bu benzer rakam ile elde etmiş olduğum
    //dosya uzantısı birleştiriyorum

    $targetFile = $uploadDir . $fileName;
    //dosyanın nereye kayıt olacağına dair dosya yolunun ve adını birleştirerek 
    //$targetFile kayıt atıyorum

    if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
        $image_url = $targetFile;
    }
    //move uploaded_file ile dosyayı verilen yol üzerine kayıt ediyorum
    //$image_url değişkenin yolumu atıyorum..
}

// Zorunlu alan kontrolü
if ($restaurant_id == 0 || $category_id == 0 || empty($name) || empty($price)) {
    die("Lütfen zorunlu alanları doldurunuz.");
}

// Veritabanına kayıt
$sql = "INSERT INTO products
(
    restaurant_id,
    category_id,
    name,
    description,
    price,
    image_url,
    is_available
)
VALUES
(
    :restaurant_id,
    :category_id,
    :name,
    :description,
    :price,
    :image_url,
    :is_available
)";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    ':restaurant_id' => $restaurant_id,
    ':category_id' => $category_id,
    ':name' => $name,
    ':description' => $description,
    ':price' => $price,
    ':image_url' => $image_url,
    ':is_available' => $is_available
]);

echo "Ürün başarıyla kaydedildi.";

// İsterseniz yönlendirme yapabilirsiniz.
// header("Location: products.php?status=success");
// exit;
?>