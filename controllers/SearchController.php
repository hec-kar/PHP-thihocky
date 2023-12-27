<?php include_once '../includes/opening.php';?>

<?php

if (isset($_GET["query"])) {
    // Lấy giá trị từ trường tìm kiếm
    $query = $_GET["query"];

    // Gọi hàm tìm kiếm cửa hàng từ CSDL
    $listShopByQuery = findShopByQuery($conn, $query);

    // Kiểm tra kết quả tìm kiếm
    if ($listShopByQuery === null) {
        $listShop = null;
    } else {
        // Kiểm tra số lượng cửa hàng tìm thấy
        if (count($listShopByQuery) == 1) {
            // Nếu chỉ có một cửa hàng, chuyển hướng đến trang chi tiết cửa hàng
            header("Location: ../page/product_page.php?shop_id=" . $listShopByQuery[0]->getShop_id());
            exit();
        } else {
            $listShop = $listShopByQuery;
        }
    }
}