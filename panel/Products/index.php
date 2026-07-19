<?php
try {
    $sql = "Select * from products";
    $stmt = $pdo->query($sql);
    $rows = $stmt->fetchAll();
    //echo var_dump($rows);

} catch (Exception $e) {
    echo "" . $e->getMessage() . "";
}




?><a class="btn btn-primary" href="main.php?page=Products&action=create">
    Yeni Kayıt
</a>
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Restaurants Adı </th>
            <th scope="col">Kategori Adı</th>
            <th scope="col">Ürün Adı</th>
            <th scope="col">Ürün Fiyatı</th>
            <th scope="col">Ürün Resim</th>
            <th scope="col">Düzelt</th>
            <th scope="col">Silme</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($rows as $row) {
            echo " 
              <tr>
            <th scope='row'>1</th>
            <td>{$row['restaurant_id']}</td>
             <td>{$row['category_id']}</td>
             <td>{$row['name']}</td>
             <td>{$row['price']}</td>
             <td><img src='{$row['image_url']}' height='100' width='100'/></td>
             
            <td><a class='btn btn-success' href='main.php?page=Products&action=edit&id={$row['id']}'>Düzelt</a></td>
            <td><a class='btn btn-danger' href='main.php?page=Products&action=delete&id={$row['id']}'>Silme</a></td>
        </tr>
           
           
           
           
           
           ";
        }

        ?>



    </tbody>
</table>