<?php
include_once("config/settings.php");

include_once("header.php");
include_once("topbar.php");
include_once("navbar.php");
include_once("searchov.php");
$sql = "select cart_items.id, products.name,products.image_url,cart_items.quantity,cart_items.unit_price from products inner join cart_items on products.id=cart_items.product_id";
$sorgu = $pdo->prepare($sql);
$sorgu->execute();
$rows = $sorgu->fetchAll(PDO::FETCH_ASSOC);
//TÜM VERİLERİ BURAYA ÇEKMİŞ OLDUK
?>
<style>
body {
    background-color: #f5f6f8;
}

.cart-container {
    max-width: 1200px;
    margin: 50px auto;
}

.cart-card,
.summary-card {
    background: #fff;
    border: none;
    border-radius: 15px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
}

.cart-item {
    padding: 20px;
    border-bottom: 1px solid #eee;
}

.cart-item:last-child {
    border-bottom: none;
}

.product-image {
    width: 100px;
    height: 100px;
    object-fit: cover;
    border-radius: 12px;
    background: #f1f1f1;
}

.product-title {
    font-size: 18px;
    font-weight: 600;
}

.product-price {
    color: #198754;
    font-weight: 600;
}

.quantity-control {
    display: flex;
    align-items: center;
    gap: 8px;
}

.quantity-control button {
    width: 32px;
    height: 32px;
    padding: 0;
    border-radius: 8px;
}

.quantity-number {
    min-width: 30px;
    text-align: center;
    font-weight: 600;
}

.remove-btn {
    color: #dc3545;
    cursor: pointer;
    font-size: 14px;
}

.summary-card {
    padding: 25px;
    position: sticky;
    top: 20px;
}

.summary-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 15px;
}

.total-row {
    font-size: 22px;
    font-weight: 700;
    border-top: 1px solid #ddd;
    padding-top: 20px;
    margin-top: 20px;
}

.empty-cart {
    padding: 60px 20px;
    text-align: center;
}

.empty-cart-icon {
    font-size: 60px;
    margin-bottom: 20px;
}
</style>


<div class="container cart-container">

    <div class="row g-4">

        <!-- SEPET ÜRÜNLERİ -->
        <div class="col-lg-8">

            <div class="cart-card">

                <div class="p-4 border-bottom">
                    <h3 class="mb-1">Sepetim</h3>
                    <span class="text-muted">
                        <span id="cartCount">0</span> ürün
                    </span>
                </div>

                <div id="cartItems">
                    <!-- JavaScript ürünleri buraya ekleyecek -->
                </div>

            </div>

        </div>


        <!-- SİPARİŞ ÖZETİ -->
        <div class="col-lg-4">

            <div class="summary-card">

                <h4 class="mb-4">Sipariş Özeti</h4>

                <div class="summary-row">
                    <span>Ürünler</span>
                    <span id="subtotal">₺0,00</span>
                </div>

                <div class="summary-row">
                    <span>Kargo</span>
                    <span id="shipping">₺49,90</span>
                </div>

                <div class="summary-row">
                    <span>İndirim</span>
                    <span class="text-success" id="discount">
                        -₺0,00
                    </span>
                </div>

                <div class="summary-row total-row">
                    <span>Toplam</span>
                    <span id="total">₺0,00</span>
                </div>

                <button class="btn btn-success btn-lg w-100 mt-3" onclick="completeOrder()">
                    Siparişi Tamamla
                </button>

            </div>

        </div>

    </div>

</div>


<script>
// Sepetteki ürünler
let cart = [
    <?php
        foreach ($rows as $row) {
            ?> {
        id: <?php echo $row['id']; ?>,
        name: "<?php echo $row['name']; ?>",
        price: <?php echo $row['unit_price']; ?>,
        quantity: <?php echo $row['quantity']; ?>,
        image: "<?php
                $resim = $row['image_url'];
                $yeni = substr($resim, 3);
                echo $yeni; ?> "
    },
    <?php
        }
        ?>
];


// Para formatı
function formatPrice(price) {
    return price.toLocaleString("tr-TR", {
        style: "currency",
        currency: "TRY"
    });
}


// Sepeti ekrana bas
function renderCart() {

    const cartItems = document.getElementById("cartItems");

    cartItems.innerHTML = "";

    if (cart.length === 0) {

        cartItems.innerHTML = `
                <div class="empty-cart">
                    <div class="empty-cart-icon">🛒</div>

                    <h4>Sepetiniz boş</h4>

                    <p class="text-muted">
                        Sepetinizde henüz ürün bulunmuyor.
                    </p>

                    <a href="#" class="btn btn-success">
                        Alışverişe Başla
                    </a>
                </div>
            `;

        updateSummary();
        return;
    }


    cart.forEach(product => {

        const productTotal =
            product.price * product.quantity;

        cartItems.innerHTML += `
                <div class="cart-item">

                    <div class="row align-items-center g-3">

                        <!-- Ürün resmi -->
                        <div class="col-4 col-md-2">
                            <img
                                src="${product.image}"
                                alt="${product.name}"
                                class="product-image"
                            >
                        </div>


                        <!-- Ürün bilgileri -->
                        <div class="col-8 col-md-4">

                            <div class="product-title">
                                ${product.name}
                            </div>

                            <div class="product-price mt-2">
                                ${formatPrice(product.price)}
                            </div>

                            <div
                                class="remove-btn mt-2"
                                onclick="removeProduct(${product.id})"
                            >
                                🗑 Ürünü kaldır
                            </div>

                        </div>


                        <!-- Adet -->
                        <div class="col-6 col-md-3">

                            <div class="quantity-control">

                                <button
                                    class="btn btn-outline-secondary"
                                    onclick="changeQuantity(
                                        ${product.id},
                                        -1
                                    )"
                                >
                                    −
                                </button>

                                <span class="quantity-number">
                                    ${product.quantity}
                                </span>

                                <button
                                    class="btn btn-outline-secondary"
                                    onclick="changeQuantity(
                                        ${product.id},
                                        1
                                    )"
                                >
                                    +
                                </button>

                            </div>

                        </div>


                        <!-- Ürün toplamı -->
                        <div class="col-6 col-md-3 text-end">

                            <strong>
                                ${formatPrice(productTotal)}
                            </strong>

                        </div>

                    </div>

                </div>
            `;
    });


    updateSummary();
}


// Ürün adedini değiştir
function changeQuantity(id, amount) {

    const product = cart.find(item => item.id === id);

    if (!product) return;

    product.quantity += amount;

    // Adet 0 olursa ürünü sepetten çıkar
    if (product.quantity <= 0) {
        cart = cart.filter(item => item.id !== id);
    }

    renderCart();
}


// Ürünü tamamen sil
function removeProduct(id) {

    cart = cart.filter(item => item.id !== id);

    renderCart();
}


// Sepet özetini güncelle
function updateSummary() {

    let subtotal = 0;
    let cartCount = 0;

    cart.forEach(product => {

        subtotal += product.price * product.quantity;

        cartCount += product.quantity;

    });


    // 1000 TL üzeri ücretsiz kargo
    let shipping = subtotal >= 1000 || subtotal === 0 ?
        0 :
        49.90;


    // Örnek indirim
    let discount = subtotal >= 5000 ?
        subtotal * 0.10 :
        0;


    const total =
        subtotal +
        shipping -
        discount;


    document.getElementById("cartCount").textContent =
        cartCount;

    document.getElementById("subtotal").textContent =
        formatPrice(subtotal);

    document.getElementById("shipping").textContent =
        shipping === 0 ?
        "Ücretsiz" :
        formatPrice(shipping);

    document.getElementById("discount").textContent =
        "-" + formatPrice(discount);

    document.getElementById("total").textContent =
        formatPrice(total);
}


// Sipariş tamamlama
function completeOrder() {

    if (cart.length === 0) {

        alert("Sepetiniz boş.");

        return;
    }

    alert("Siparişiniz başarıyla oluşturuldu!");

    // AJAX ile gönderilecek veriyi hazırla
    const orderData = cart.map(product => {

        return {
            id: product.id,
            quantity: Number(product.quantity)
        };

    });


    // Butonu geçici olarak pasifleştir
    const button = document.querySelector(
        'button[onclick="completeOrder()"]'
    );

    if (button) {
        button.disabled = true;
        button.innerHTML = `
            <span class="spinner-border spinner-border-sm me-2"></span>
            İşleniyor...
        `;
    }


    // AJAX
    fetch("siparis_onayla.php", {

            method: "POST",

            headers: {
                "Content-Type": "application/json"
            },

            body: JSON.stringify({
                cart: orderData
            })

        })

        .then(response => {

            if (!response.ok) {
                throw new Error("Sunucu hatası: " + response.status);
            }

            return response.json();

        })

        .then(data => {

            console.log("Sunucu cevabı:", data);


            if (data.success) {

                // Sipariş başarılı
                window.location.href =
                    "siparis-basarili.php?order_id=" +
                    encodeURIComponent(data.order_id);

            } else {

                alert(
                    data.message ||
                    "Sipariş oluşturulurken bir hata oluştu."
                );

                // Butonu tekrar aktif et
                if (button) {
                    button.disabled = false;
                    button.innerHTML = "Siparişi Tamamla";
                }

            }

        })

        .catch(error => {

            console.error("AJAX Hatası:", error);

            alert(
                "Sipariş gönderilirken bir hata oluştu."
            );

            // Butonu tekrar aktif et
            if (button) {
                button.disabled = false;
                button.innerHTML = "Siparişi Tamamla";
            }

        });



}


// Sayfa açıldığında sepeti oluştur
renderCart();
</script>
<?php
include_once("footer.php");
?>