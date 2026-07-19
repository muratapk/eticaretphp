<?php
include_once("../config/settings.php");
if (!isset($_REQUEST['id']) || empty($_REQUEST['id'])) {

    header("Refresh: 2; url=main.php");
    exit;
}
$id = $_REQUEST['id'];
$sql = "Select * from Products where id=?";
$sorgu = $pdo->prepare($sql);
$sorgu->execute([$id]);
$urun = $sorgu->fetch(PDO::FETCH_ASSOC);

//İLK SATIR GETİR AL 


?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow">
                <div class="card-header">
                    <h3 class="mb-0">Ürün Kayıt Formu</h3>
                </div>

                <div class="card-body">
                    <form action="main.php?page=Products&action=save" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $urun['id']; ?>" />
                        <div class="card shadow-sm">
                            <div class="card-header bg-success text-white">
                                <h5 class="mb-0">Ürün Düzeltme</h5>
                            </div>

                            <div class="card-body">

                                <div class="row">

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Restoran</label>
                                        <select name="restaurant_id" class="form-select" required>
                                            <option value="">Restoran Seçiniz</option>

                                            <?php
                                            $sql = "SELECT id,name FROM restaurants ORDER BY name";
                                            $stmt = $pdo->prepare($sql);
                                            $stmt->execute();

                                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                echo "<option value='{$row['id']}'>{$row['name']}</option>";
                                            }
                                            ?>

                                        </select>
                                    </div>

                                    <div class=" col-md-6 mb-3">
                                        <label class="form-label">Kategori</label>
                                        <select name="category_id" class="form-select" required>
                                            <option value="">Kategori Seçiniz</option>

                                            <?php
                                            $sql = "SELECT id,name FROM categories ORDER BY name";
                                            $stmt = $pdo->prepare($sql);
                                            $stmt->execute();

                                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                echo "<option value='{$row['id']}'>{$row['name']}</option>";
                                            }
                                            ?>

                                        </select>
                                    </div>

                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Ürün Adı</label>
                                    <input type="text" name="name" value="<?php echo $urun['name']; ?>"
                                        class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Açıklama</label>
                                    <textarea name="description" rows="4" class="form-control">
                                          <?php echo $urun['description']; ?>
                                    </textarea>
                                </div>

                                <div class="row">

                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Fiyat (₺)</label>
                                        <input type="number" name="price" class="form-control" step="0.01" min="0"
                                            value="<?php echo $urun['price']; ?>" required>
                                    </div>

                                    <div class=" col-md-4 mb-3">
                                        <label class="form-label">Ürün Resmi</label>
                                        <img src="../Product_Image/<?php echo $urun['image_url']; ?>" height="100"
                                            width="100" />
                                        <input type="file" name="image" class="form-control" accept="image/*">
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Durum</label>
                                        <select name="is_available" class="form-select">
                                            <?php
                                            if ($urun['is_available'] == 1) {
                                                echo "<option value='1'>Satışta</option>";
                                            } else {
                                                echo "<option value='0'>Satışta Değil</option>";
                                            }
                                            ?>
                                            <option value="1">Satışta</option>
                                            <option value="0">Satışta Değil</option>
                                        </select>
                                    </div>

                                </div>

                            </div>

                            <div class="card-footer text-end">
                                <button type="submit" class="btn btn-success">
                                    Kaydet
                                </button>

                                <button type="reset" class="btn btn-secondary">
                                    Temizle
                                </button>
                            </div>

                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>