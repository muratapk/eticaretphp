<?php
if (!isset($_REQUEST['id']) || empty($_REQUEST['id'])) {

    header("Refresh: 2; url=main.php");
    exit;
}
$id = $_REQUEST['id'];
$sql = "Select * from Categories where id=?";
$sorgu = $pdo->prepare($sql);
$sorgu->execute([$id]);
$row = $sorgu->fetch(PDO::FETCH_ASSOC);
$SubCategory = $row['SubCategory'];
//İLK SATIR GETİR AL 


?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow">
                <div class="card-header">
                    <h3 class="mb-0">Kategori Düzeltme Formu</h3>
                </div>

                <div class="card-body">
                    <form action="main.php?page=Categories&action=update" method="POST">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="first_name" class="form-label">Kategori Adı</label>
                                <input type="text" class="form-control" id="name" value="<?php echo $row['name']; ?>"
                                    name="name" maxlength="100" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="last_name" class="form-label">Ana Kategori</label>
                                <select id="SubCategory" name="SubCategory" class="form-control">
                                    <?php
                                    $sql = "Select id,name from Categories where id=?";
                                    $sorgu = $pdo->prepare($sql);
                                    $sorgu->execute([$SubCategory]);
                                    $satir = $sorgu->fetch(PDO::FETCH_ASSOC);
                                    echo "<option value='{$satir['id']}'>{$satir['name']}</option>"
                                        ?>

                                    <option value="0">Ana Kategori</option>
                                    <?php
                                    $sql = "SELECT id, name FROM Categories WHERE SubCategory = 0";
                                    $sorgu = $pdo->prepare($sql);
                                    $sorgu->execute();
                                    $rows = $sorgu->fetchAll(PDO::FETCH_ASSOC);

                                    foreach ($rows as $row) {
                                        echo "<option value='{$row['id']}'>{$row['name']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>












                        <button type="submit" class="btn btn-primary">
                            Kaydet
                        </button>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>