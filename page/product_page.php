<?php include_once "../includes/opening.php"; ?>
<?php define("PAGE_TITLE", "Home Page"); ?>

<!-- chưa code bên login nên phải để bằng null không lỗi 2 thứ này () -->
<?php $user = null; ?>
<?php $cart = null; ?>
<!--  -->

<?php
$shop_id = 0;
if (isset($_GET['shop_id'])) {
    // Lấy giá trị của 'shop_id'
    $shop_id = $_GET['shop_id'];
}

$shop = new Shop();
$shop = getShopDetail($conn, $shop_id);

$listProduct = getProductByShop($conn, $shop_id);
?>






<?php include_once '../includes/components/_header.php'; ?>
<?php include_once '../includes/components/_nav.php'; ?>
<?php include_once '../includes/components/_product_by_shop.php'; ?>
<?php include_once '../includes/components/_footer.php'; ?>


<?php include_once "../includes/closing.php"; ?>