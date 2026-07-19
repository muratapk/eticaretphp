<?php
try {
    $sql = "Select * from restaurants";
    $stmt = $pdo->query($sql);
    $rows = $stmt->fetchAll();
    //echo var_dump($rows);

} catch (Exception $e) {
    echo "" . $e->getMessage() . "";
}




?><a class="btn btn-primary" href="main.php?page=Restaurants&action=create">
    Yeni Kayıt
</a>
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Restaurants Adı </th>
            <th scope="col">Email</th>
            <th scope="col">Telefon</th>
            <th scope="col">Adres</th>
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
             <td>{$row['email']}</td>
             <td>{$row['phone']}</td>
             <td>{$row['address']}</td>
           
             
            <td><a class='btn btn-success' href='main.php?page=Restaurants&action=edit&id={$row['id']}'>Düzelt</a></td>
            <td><a class='btn btn-danger' href='main.php?page=Restaurants&action=delete&id={$row['id']}'>Silme</a></td>
        </tr>
           
           
           
           
           
           ";
        }

        ?>



    </tbody>
</table>