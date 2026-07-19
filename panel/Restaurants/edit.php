<?php
if (!isset($_REQUEST['id']) || empty($_REQUEST['id'])) {

    header("Refresh: 2; url=main.php");
    exit;
}
$id = $_REQUEST['id'];
$sql = "Select * from Restaurants where id=?";
$sorgu = $pdo->prepare($sql);
$sorgu->execute([$id]);
$row = $sorgu->fetch(PDO::FETCH_ASSOC);

//İLK SATIR GETİR AL 


?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow">
                <div class="card-header">
                    <h3 class="mb-0">Resturants Kayıt Formu</h3>
                </div>

                <div class="card-body">
                    <form action="main.php?page=Restaurants&action=update" method="POST" class="row g-3">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <div class="col-md-6">
                            <label class="form-label">Restoran Adı</label>
                            <input type="text" class="form-control" name="name" value="<?php echo $row['name']; ?>"
                                required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">İşletme Sahibi (Owner ID)</label>
                            <input type="number" class="form-control" value="<?php echo $row['owner_id']; ?>"
                                name="owner_id" required>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Açıklama</label>
                            <textarea class="form-control" name="description"
                                rows="4"><?php echo $row['description']; ?></textarea>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Telefon</label>
                            <input type="text" class="form-control" value="<?php echo $row['phone']; ?>" name="phone">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">E-Posta</label>
                            <input type="email" class="form-control" value="<?php echo $row['email']; ?>" name="email">
                        </div>

                        <div class="col-12">
                            <label class="form-label">Adres</label>
                            <textarea class="form-control" name="address"
                                rows="3"><?php echo $row['address']; ?></textarea>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Şehir</label>
                            <input type="text" class="form-control" value="<?php echo $row['city']; ?>" name="city">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">İlçe</label>
                            <input type="text" class="form-control" value="<?php echo $row['district']; ?>"
                                name="district">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Enlem (Latitude)</label>
                            <input type="text" class="form-control" value="<?php echo $row['latitude']; ?>"
                                name="latitude" placeholder="41.008238">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Boylam (Longitude)</label>
                            <input type="text" class="form-control" value="<?php echo $row['longitude']; ?>"
                                name="longitude" placeholder="28.978359">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Minimum Sipariş Tutarı (₺)</label>
                            <input type="number" class="form-control"
                                value="<?php echo $row['minimum_order_amount']; ?>" name="minimum_order_amount"
                                value="0.00" step="0.01">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Teslimat Ücreti (₺)</label>
                            <input type="number" class="form-control" value="<?php echo $row['delivery_fee']; ?>"
                                name="delivery_fee" value="0.00" step="0.01">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Çalışma Durumu</label>
                            <select class="form-select" name="is_open">
                                <?php
                                if ($row['is_open'] == 1) {
                                    echo "<option value='1'>Açık</option>";
                                } else {
                                    echo "<option value='0'>Kapalı</option>";
                                }

                                ?>
                                <option value="1">Açık</option>
                                <option value="0">Kapalı</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Aktiflik Durumu</label>
                            <select class="form-select" name="is_active">
                                <?php
                                if ($row['is_active'] == 1) {
                                    echo "<option value='1'>Aktif</option>";
                                } else {
                                    echo "<option value='0'>Pasif</option>";
                                }

                                ?>
                                <option value="1">Aktif</option>
                                <option value="0">Pasif</option>
                            </select>
                        </div>

                        <div class="col-12 text-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Kaydet
                            </button>

                            <button type="reset" class="btn btn-secondary">
                                Temizle
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>