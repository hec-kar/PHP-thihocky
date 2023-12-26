<section>
    <div class="container my-5">
        <header class="mb-4">
            <h3>Quán ăn</h3>
        </header>
        <div class="row">
            <?php foreach ($listShop as $shop): ?>
                    <div class="col-lg-3 col-md-6 col-sm-6 d-flex">
                        <div class="card w-100 my-2 shadow-2-strong">
                            <img src="../public/assets/img/shop/<?php echo $shop->getImage(); ?>" class="card-img-top"
                                style="aspect-ratio: 1 / 1" />
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">
                                    <?php echo $shop->name; ?>
                                </h5>
                                <p class="card-text">
                                    <?php echo $shop->address; ?>
                                </p>
                                <div class="card-footer d-flex align-items-end pt-3 px-0 pb-0 mt-auto">
                                    <a href="./product_page.php?shop_id=<?php echo $shop->shop_id; ?>"
                                        class="btn btn-warning shadow-0 me-1">Xem
                                        thêm</a>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>