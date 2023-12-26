<?php include_once "../includes/opening.php"; ?>
<?php define("PAGE_TITLE", "Home Page"); ?>


<?php $user = null; ?>
<?php $cart = null; ?>
<?php $listShop = getAllShop($conn); ?>


<?php include_once '../includes/components/_header.php'; ?>
<?php include_once '../includes/components/_nav.php'; ?>
<?php include_once '../includes/components/_slider.php'; ?>
<?php include_once '../includes/components/_body.php'; ?>
<?php include_once '../includes/components/_footer.php'; ?>


<?php include_once "../includes/closing.php"; ?>