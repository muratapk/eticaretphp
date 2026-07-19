<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow">
                <div class="card-header">
                    <h3 class="mb-0">Ürün Kayıt Formu</h3>
                </div>

                <div class="card-body">
                    <form action="main.php?page=Products&action=save" method="POST" enctype="multipart/form-data">

                        <div class="card shadow-sm">
                            <div class="card-header bg-success text-white">
                                <h5 class="mb-0">Yeni Ürün Ekle</h5>
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

                                    <div class="col-md-6 mb-3">
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
                                    <input type="text" name="name" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Açıklama</label>
                                    <textarea name="description" rows="4" class="form-control"></textarea>
                                </div>

                                <div class="row">

                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Fiyat (₺)</label>
                                        <input type="number" name="price" class="form-control" step="0.01" min="0"
                                            required>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Ürün Resmi</label>
                                        <input type="file" name="image" class="form-control" accept="image/*">
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Durum</label>
                                        <select name="is_available" class="form-select">
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