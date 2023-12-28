<div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Id đơn hàng</th>
                <th scope="col">Địa chỉ (Ghi chú)</th>
                <th scope="col">Thời gian đặt</th>
                <th scope="col">Thời gian dự kiến</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row"><?php echo $order->order_id; ?></th>
                <td><?php echo $order->note; ?></td>
                <td><?php echo $order->date; ?></td>
                <td><?php echo $order->due_time; ?> phút</td>
            </tr>
        </tbody>
    </table>
</div>

<div class="col-md-18" style="margin-top: 100px">
    <?php foreach ($listProduct as $product): ?>
    <ul class="list-group" style="height: 200px; width: auto; ">
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <img src="../public/assets/img/food/<?php echo $product->image; ?>" alt="<?php echo $product->image; ?>"
                width="100" class="flex-shrink-0">
            <div class="product-info flex-fill" style="margin-left: 20px">
                <h5 class="product-name"><?php echo $product->name; ?></h5>
                <p class="product-description"><?php echo $product->description; ?></p>
                <?php $money = $product->getPrice();?>
                <p class="product-price"><?php echo $money; ?></p>
                <p class="product-quantity">Số lượng: <?php echo $product->quantity; ?></p>
            </div>
        </li>
    </ul>
    <?php endforeach;?>
</div>

<form action="../controllers/AdminOrderController.php" method="post">
    <button type="submit" name="order_id" value="<?php echo $order->order_id; ?>" onclick="showSuccess()"
        class="btn btn-primary">Xác
        nhận đơn hàng</button>
</form>

<script>
function showSuccess() {
    window.alert("Xác nhận thành công!!");
}
</script>