<div class="container">
    <div class="row">
        <div class="card">
            <div class="row no-gutters">
                <!-- Image Column -->
                <div class="col-md-4">
                    <img src="../public/assets/img/shop/<?php echo $shop->image; ?>" class="card-img" alt="Store Image">
                </div>
                <!-- Information Column -->
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">
                            <?php echo $shop->name; ?>
                        </h5>
                        <p class="card-text">
                            <?php echo $shop->address; ?>
                        </p>
                        <p class="card-text">99+ đánh giá trên Phongpee</p>
                        <p class="card-text"><a href="#">Xem thêm lượt đánh giá từ Foody</a></p>
                        <p class="card-text">Giờ mở cửa: 07:00 - 22:00</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-18" style="margin-top: 100px">
        <?php foreach ($listProduct as $product): ?>
            <ul class="list-group" style="height: 200px; width: auto; ">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <img src="../public/assets/img/food/<?php echo $product->image; ?>" alt="<?php echo $product->image; ?>"
                        width="100" class="flex-shrink-0">
                    <div class="product-info flex-fill" style="margin-left: 20px">
                        <h5 class="product-name">
                            <?php echo $product->name; ?>
                        </h5>
                        <p class="product-description">
                            <?php echo $product->description; ?>
                        </p>
                        <?php $money = $product->getPrice(); ?>
                        <p class="product-price">
                            <?php echo $money; ?>
                        </p>
                        <p class="product-quantity">Số lượng:
                            <?php echo $product->quantity; ?>
                        </p>
                    </div>
                    <a href="<?php echo ($user == null) ? 'login' : "quanan?shop_id={$shop->shop_id}&id_product={$product->id}"; ?>"
                        class="btn btn-warning btn-add-to-cart">Thêm vào giỏ hàng</a>
                </li>
            </ul>
        <?php endforeach; ?>
    </div>
</div>