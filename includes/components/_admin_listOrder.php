<div
    style="width: 60%; margin:auto; margin-top: 100px; border-collapse: collapse; margin-bottom: 200px; text-align: center;">
    <h1>Danh sách đơn hàng</h1>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Id đơn hàng</th>
                <th scope="col">Địa chỉ (Ghi chú)</th>
                <th scope="col">Thời gian đặt</th>
                <th scope="col">Thời gian dự kiến</th>
                <th scope="col">Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php if (isset($listOrder)): ?>
            <?php foreach ($listOrder as $order): ?>
            <?php if ($order->status == 0): ?>
            <tr>
                <th scope="row"><?php echo $order->getOrderId(); ?></th>
                <td><?php echo $order->note; ?></td>
                <td><?php echo $order->date; ?></td>
                <td><?php echo $order->due_time; ?> phút</td>
                <td>
                    <a href="./admin_order_detail.php?order_id=<?php echo $order->getOrderId(); ?>">
                        <button class="btn btn-primary">Xem chi tiết đơn hàng</button>
                    </a>
                </td>
            </tr>
            <?php endif;?>
            <?php endforeach;?>
            <?php endif;?>
        </tbody>
    </table>
</div>