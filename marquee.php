<?php
$sql = "Select * from categories";
$sorgu = $pdo->prepare($sql);
$sorgu->execute();
$kategoriler = $sorgu->fetchAll(PDO::FETCH_ASSOC);


?>
<div class="mqsec">
    <div class="mqtrack">
        <?php
        foreach ($kategoriler as $kategori) {
            echo ' <div class="mqitem"><i class="fas fa-circle"></i>' . $kategori['name'] . '</div>';


        }

        ?>


    </div>
</div>