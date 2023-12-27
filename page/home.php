<?php include_once "../includes/opening.php";?>
<?php define("PAGE_TITLE", "Home Page");?>

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
?>

<?php
if (isset($_GET['query'])) {
    include_once '../controllers/SearchController.php';
} else {
    $listShop = getAllShop($conn);
}
?>

<?php include_once '../includes/components/_header.php';?>
<?php include_once '../includes/components/_nav.php';?>
<?php include_once '../includes/components/_slider.php';?>
<?php include_once '../includes/components/_body.php';?>
<?php include_once '../includes/components/_footer.php';?>


<?php include_once "../includes/closing.php";?>