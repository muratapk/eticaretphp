<section id="category">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="slbl">Yemeklerimiz</span>
            <h2 class="stitle">Kategorileri göre <span>Yemekler</span></h2>
            <div class="sline"></div>
            <p class="sdesc mx-auto" style="max-width:480px;">Enfes Yemekler,Leziz Tabaklar Sizi Bekliyor</p>
        </div>

        <div class="row g-3 justify-content-center">
            <?php
            $sql = "SELECT categories.id ,categories.name as kategoriAdi,products.name,products.image_url,products.price FROM categories inner join products
on categories.id=products.category_id where EXISTS (Select  DISTINCT(name) from categories where products.category_id=categories.id) ";
            $sorgu = $pdo->prepare($sql);
            $sorgu->execute();
            $kategoriler = $sorgu->fetchAll(PDO::FETCH_ASSOC);
            //TÜM VERİLERİ ALDIK
            function kategoriAdet($id = 0, $pdo)
            {
                if ($id == 0) {
                    $sql = "SELECT COUNT(id) AS adet, category_id
                FROM products
                GROUP BY category_id";
                    $sorgu = $pdo->prepare($sql);
                    $sorgu->execute();
                } else {
                    $sql = "SELECT COUNT(id) AS adet, category_id
                FROM products
                WHERE category_id = ?
                GROUP BY category_id";
                    $sorgu = $pdo->prepare($sql);
                    $sorgu->execute([$id]);
                }

                $sonuc = $sorgu->fetch(PDO::FETCH_ASSOC);

                if ($sonuc) {
                    echo $sonuc['adet'];
                } else {
                    echo 0;
                }
            }

            ?>
            <div class="col-6 col-sm-4 col-md-3 col-lg-2" data-aos="zoom-in" data-aos-delay="0">
                <div class="catcard active" data-filter="all">
                    <img class="catimg" src="img/category/1.jpg" alt="" />
                    <div class="catnm">Tüm Yemekler</div>
                    <div class="catct"><?php kategoriAdet(0, $pdo); ?></div>
                </div>
            </div>

            <?php
            foreach ($kategoriler as $kategori) {



                ?>

            <div class="col-6 col-sm-4 col-md-3 col-lg-2" data-aos="zoom-in" data-aos-delay="70">
                <div class="catcard" data-filter="<?php echo $kategori['kategoriAdi']; ?>">
                    <img class="catimg" src="Product_Images/<?php echo $kategori['image_url']; ?>" alt="" />
                    <div class="catnm"><?php echo $kategori['kategoriAdi']; ?></div>
                    <div class="catct"><?php echo kategoriAdet($kategori['id'], $pdo); ?></div>
                </div>
            </div>
            <?php
            }
            ?>

            <!--veritabanından gelen veriler-->




        </div>
    </div>
</section>