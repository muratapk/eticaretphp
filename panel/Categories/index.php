<?php
try {
    $sql = "Select * from categories";
    $stmt = $pdo->query($sql);
    $rows = $stmt->fetchAll();
    //echo var_dump($rows);

} catch (Exception $e) {
    echo "" . $e->getMessage() . "";
}
function kategoriAdi($gelen, $pdo)
{
    $sql = "Select name from Categories where id=?";
    $sorgu = $pdo->prepare($sql);
    $sorgu->execute([$gelen]);
    $row = $sorgu->fetch(PDO::FETCH_ASSOC);
    echo $row['name'];
}




?><a class="btn btn-primary" href="main.php?page=Categories&action=create">
    Yeni Kayıt
</a>
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Kategori Adı </th>
            <th scope="col">Alt Kategori</th>

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
            <td>{$row['name']}</td>
            <td>";
            kategoriAdi($row['id'], $pdo);

            echo "</td>
            <td><a class='btn btn-success' href='main.php?page=Categories&action=edit&id={$row['id']}'>Düzelt</a></td>
            <td><a class='btn btn-danger' href='main.php?page=Categories&action=delete&id={$row['id']}'>Silme</a></td>
        </tr>
           
           
           
           
           
           ";
        }

        ?>



    </tbody>
</table>