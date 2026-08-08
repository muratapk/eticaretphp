<?php
include_once("config/settings.php");

include_once("header.php");
include_once("topbar.php");
include_once("navbar.php");
include_once("searchov.php");
try {

    // JavaScript'ten gelen JSON
    $json = file_get_contents("php://input");

    $data = json_decode($json, true);


    // Veri kontrolü
    if (
        !$data ||
        !isset($data['cart']) ||
        !is_array($data['cart'])
    ) {

        echo json_encode([
            'success' => false,
            'message' => 'Geçersiz sepet verisi.'
        ]);

        exit;
    }


    $cart = $data['cart'];


    if (count($cart) === 0) {

        echo json_encode([
            'success' => false,
            'message' => 'Sepet boş.'
        ]);

        exit;
    }


    /*
     * Burada kullanıcının ID'sini
     * kendi sisteminden almalısın.
     */
    $user_id = $_SESSION['user_id'];


    $pdo->beginTransaction();


    /*
     * 1. Önce sipariş toplamını
     *    veritabanındaki GÜNCEL fiyatlardan hesapla.
     */

    $subtotal = 0;

    $products = [];


    $productQuery = $pdo->prepare("
        SELECT
            id,
            name,
            unit_price,
            stock
        FROM products
        WHERE id = ?
    ");


    foreach ($cart as $item) {

        $product_id = (int) $item['id'];
        $quantity = (int) $item['quantity'];


        // Adet kontrolü
        if ($quantity <= 0) {

            throw new Exception(
                "Geçersiz ürün adedi."
            );
        }


        // Ürünü veritabanından çek
        $productQuery->execute([
            $product_id
        ]);

        $product = $productQuery->fetch(
            PDO::FETCH_ASSOC
        );


        if (!$product) {

            throw new Exception(
                "Ürün bulunamadı: " . $product_id
            );
        }


        // Stok kontrolü
        if ($product['stock'] < $quantity) {

            throw new Exception(
                $product['name'] .
                " için yeterli stok yok."
            );
        }


        $unit_price = (float) $product['unit_price'];

        $product_total =
            $unit_price * $quantity;


        $subtotal += $product_total;


        $products[] = [
            'id' => $product_id,
            'name' => $product['name'],
            'unit_price' => $unit_price,
            'quantity' => $quantity,
            'total' => $product_total
        ];

    }


    /*
     * 2. Kargo
     */
    $shipping =
        ($subtotal >= 1000)
        ? 0
        : 49.90;


    /*
     * 3. İndirim
     */
    $discount =
        ($subtotal >= 5000)
        ? $subtotal * 0.10
        : 0;


    /*
     * 4. Genel toplam
     */
    $total =
        $subtotal +
        $shipping -
        $discount;


    /*
     * 5. orders tablosuna ekle
     */
    $orderQuery = $pdo->prepare("
        INSERT INTO orders
        (
            user_id,
            subtotal,
            shipping,
            discount,
            total_price,
            status,
            created_at
        )
        VALUES
        (
            ?,
            ?,
            ?,
            ?,
            ?,
            'pending',
            NOW()
        )
    ");


    $orderQuery->execute([
        $user_id,
        $subtotal,
        $shipping,
        $discount,
        $total
    ]);


    // Oluşan sipariş ID
    $order_id = $pdo->lastInsertId();


    /*
     * 6. order_items tablosuna ürünleri ekle
     */
    $itemQuery = $pdo->prepare("
        INSERT INTO order_items
        (
            order_id,
            product_id,
            product_name,
            unit_price,
            quantity,
            total_price
        )
        VALUES
        (
            ?,
            ?,
            ?,
            ?,
            ?,
            ?
        )
    ");


    foreach ($products as $product) {

        $itemQuery->execute([

            $order_id,

            $product['id'],

            $product['name'],

            $product['unit_price'],

            $product['quantity'],

            $product['total']

        ]);

    }


    /*
     * 7. Stokları azalt
     */
    $stockQuery = $pdo->prepare("
        UPDATE products
        SET stock = stock - ?
        WHERE id = ?
    ");


    foreach ($products as $product) {

        $stockQuery->execute([

            $product['quantity'],

            $product['id']

        ]);

    }


    /*
     * 8. Kullanıcının sepetini temizle
     */
    $deleteCart = $pdo->prepare("
        DELETE FROM cart_items
        WHERE user_id = ?
    ");

    $deleteCart->execute([
        $user_id
    ]);


    /*
     * Her şey başarılı
     */
    $pdo->commit();


    echo json_encode([

        'success' => true,

        'message' =>
            'Sipariş başarıyla oluşturuldu.',

        'order_id' =>
            $order_id

    ]);


} catch (Exception $e) {


    // Hata olursa yapılan işlemleri geri al
    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }


    echo json_encode([

        'success' => false,

        'message' =>
            $e->getMessage()

    ]);

}

include_once("footer.php");
?>