<?php
session_start();
include_once("config/settings.php");
if (isset($_SESSION['email'])) {
    //kişi login ise burası çalışacak
    //bu kullanıcıya ait cart_items içindeki ürünleri görebilmek için
    //musteri ait ilk önce cart veritabanında bu müşteriye ait kart var mı
    //onu kontrol etmemiz lazım..
    $email = $_SESSION['email'];
    $sql = "Select * from users where email=?";
    $sorgu = $pdo->prepare($sql);
    $sorgu->execute([$email]);
    $row = $sorgu->fetch(PDO::FETCH_ASSOC);
    $user_id = $row['id'];
    //kullanıcı id numarasını alalım
    $sql2 = "select * from carts where user_id=?";
    $sorgu2 = $pdo->prepare($sql2);
    $sorgu2->execute([$user_id]);
    $row2 = $sorgu2->fetch(PDO::FETCH_ASSOC);
    if ($row2) {
        $card_id = $row2['id'];
        $sorgu3 = "select sum(quantity) as toplam from cart_items where cart_id=?";
        $sorgu4 = $pdo->prepare($sorgu3);
        $sorgu4->execute([$card_id]);
        $row3 = $sorgu4->fetch(PDO::FETCH_ASSOC);
        $toplamUrun = $row3['toplam'] ?? 0;
    } else {
        $toplamUrun = 0;
    }

} else {
    //kişi login değilse burası çalışacak
    $toplamUrun = 0;
}

?> <a href="kullanici_kayit.php" class="nav-link nav-cta"><i
        class="fas fa-shopping-bag me-1"></i><?php echo $toplamUrun; ?></a>