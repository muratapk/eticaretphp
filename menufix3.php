<section id="menu">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="slbl">Ne Yemek İstersiniz?</span>
            <h2 class="stitle">Zengin <span>Menüler</span></h2>
            <div class="sline"></div>
        </div>
        <!-- FIX 3 � filter buttons -->
        <!--kategoriler Verileri gelecek-->
        <div class="text-center mb-4" data-aos="fade-up">
            <?php
            $sql = "Select * from categories";
            $sorgu = $pdo->prepare($sql);
            $sorgu->execute();
            $kategoriler = $sorgu->fetchAll(PDO::FETCH_ASSOC);
            ?>

            <button class="filtbtn active" data-f="all">Hepsi</button>
            <?php
            foreach ($kategoriler as $kategori) {
                echo '<button class="filtbtn" data-f="' . $kategori['name'] . '">' . $kategori['name'] . '</button>';
            }
            ?>

        </div>
        <!--kategoriler Verileri gelecek-->
        <div class="row g-4" id="mgrid">

            <?php
            $sql = "SELECT products.id as urunId,categories.name as kategoriad,products.name, products.image_url,
            products.description,products.price,categories.SubCategory         
            FROM categories inner join products on categories.id=products.category_id";

            $sorgu = $pdo->prepare($sql);
            $sorgu->execute();
            $urunler = $sorgu->fetchAll(PDO::FETCH_ASSOC);
            foreach ($urunler as $urun) {
                //döngü burada başlıyor..
            
                ?>

            <!-- CARD 1: Burgers -->
            <div class="col-sm-6 col-lg-4 mwrap" data-c="<?php echo $urun['kategoriad']; ?>" data-aos="fade-up">
                <div class="mcard" data-img="Product_Images/<?php echo $urun['image_url']; ?>"
                    data-title="<?php echo $urun['name']; ?>" data-cat="<?php echo $urun['kategoriad']; ?>"
                    data-price="<?php echo $urun['price']; ?>" data-old="<?php echo $urun['price']; ?>"
                    data-rating="4.9" data-reviews="128" data-product="<?php echo $urun['urunId']; ?>" data-cal="620"
                    data-time="12" data-desc="<?php echo $urun['description']; ?>" data-tags="Spicy,Bestseller,Beef">

                    <div class="mimg">
                        <img src="Product_Images/<?php echo $urun['image_url']; ?>"
                            alt="<?php echo $urun['name']; ?>" />
                        <div class="mbdg hot"><i class="fas fa-star"></i> <?php echo $urun['kategoriad']; ?></div>
                        <div class="mhrt"><i class="far fa-heart"></i></div>
                    </div>
                    <div class="mbody">
                        <div class="mcat">Burgers</div>
                        <div class="mtit"><?php echo $urun['name']; ?></div>
                        <div class="mdesc">
                            <?php echo $urun['description']; ?>

                        </div>
                        <div class="mfoot">
                            <div>
                                <div class="mprice"><?php echo $urun['price']; ?>
                                    <small><?php echo $urun['price']; ?></small>
                                </div>
                                <div class="mstars"><i class="fas fa-star"></i> <span
                                        style="color:#bbb;font-size:.7rem;">(128)</span></div>
                            </div>
                            <button class="madd" title="View Details"><i class="fas fa-plus"></i></button>
                            <button class="madd sepet"
                                data-id="<?php echo $urun['urunId']; ?>-<?php echo $urun['price']; ?>"
                                title=" View Details"><i class="fa-solid fa-basket-shopping"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <?php

                //döngü bu alt nokta bitiyor...
            }
            ?>
            <!-- CARD 2: Pizza -->

            <!-- CARD 4: Wraps -->

            <!-- CARD 5: Desserts -->

            <!-- CARD 6: Pasta -->

        </div>
        <!-- end #mgrid -->
        <div class=" text-center mt-5"><a href="#" class="btn-red"><i class="fas fa-th-large"></i>View
                Full
                Menu</a>
        </div>
    </div>
</section>