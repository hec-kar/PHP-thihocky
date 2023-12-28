<?php include_once "../includes/opening.php";?>
<?php define("PAGE_TITLE", "Admin Home Page");?>

<?php
session_start();
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
} else {
    $user = null;
}

if (isset($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];
} else {
    $cart = null;
}

if (isset($_GET['order_id'])) {
    $order = findOrder($conn, $_GET['order_id']);
    $listProduct = findByOrder($conn, $_GET['order_id']);
}

?>



<?php include_once '../includes/components/_header.php';?>
<?php include_once '../includes/components/_admin_nav.php';?>
<?php include_once '../includes/components/_admin_order_detail.php';?>
<?php include_once '../includes/components/_footer.php';?>


<?php include_once "../includes/closing.php";?>