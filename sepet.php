<?php
session_start();
include_once("config/settings.php");
if (isset($_SESSION['email'])) {
    ///burada kişi login olmuş mu diye kontrol ediyoruz.. login ise
//login ise direk sepete ekleme işlemine başlıyoruz    


    $email = $_SESSION['email'];
    $sql = "Select * from users where email=?";
    $sorgu = $pdo->prepare($sql);
    $sorgu->execute([$email]);
    $row = $sorgu->fetch(PDO::FETCH_ASSOC);
    $user_id = $row['id'];
    /*burada email adresine göre kişinin id numarasını alıyoruz 
    çünkü bunu cart dosyasına kayıt edeceğiz..
    */
    /*
      bu kişinin kullanıcının card numarası var mı kontrol edilecek yok ise
      kart numarası oluşturlacak var ise sepete ekleme işlemi gerçekleştirilecek
     */
    $sql = "Select * from carts where user_id=?";
    $sorgu3 = $pdo->prepare($sql);
    $sorgu3->execute([$user_id]);
    $row2 = $sorgu3->fetch(PDO::FETCH_ASSOC);
    if ($row2) {
        //cart içindek kullanıcı var ise işlemi yap
        $card_id2 = $row2['id'];
    } else {
        //yoksa işlemi gerçekleştirme diyorum
        $sql2 = "insert into carts (user_id) values (?)";
        $sorgu2 = $pdo->prepare($sql2);
        $sorgu2->execute([$user_id]);
        $card_id2 = $pdo->lastInsertId();
        //en son eklenen kart numarasını bize verecek

    }
    //Cart_items içine verimizi ekleyeceğiz....

    $gelen = $_POST['Id'];
    $dizi = explode('-', $gelen);
    $productId = $dizi[0];
    $price = $dizi[1];
    $quantity = 1;
    $card_id = $card_id2;
    //bu üründe daha önce eklenmiş ise burda sadece ürünün adedi güncellenecek
    //bir sorgu daha lazım
    $sql5 = "select * from cart_items where cart_id=? && product_id=?";
    $sorgu5 = $pdo->prepare($sql5);
    $sorgu5->execute([$card_id, $productId]);
    $row5 = $sorgu5->fetch(PDO::FETCH_ASSOC);
    if ($row5) {
        $adet = $row5['quantity'] + 1;
        $sql6 = "update cart_items set quantity=? where cart_id=? && product_id=?";
        $sorgu6 = $pdo->prepare($sql6);
        $sorgu6->execute([$adet, $card_id, $productId]);

    } else {
        $sql = "insert into cart_items (cart_id,product_id,quantity,unit_price) values (?,?,?,?)";
        $sorgu = $pdo->prepare($sql);
        $sorgu->execute([$card_id, $productId, $quantity, $price]);
    }


    echo "1";
} else {

    echo "2";
}

?>