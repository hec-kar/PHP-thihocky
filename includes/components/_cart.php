<?php

?>
<section class="h-100 h-custom" style="background-color: #d2c9ff;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12">
                <div class="card card-registration card-registration-2" style="border-radius: 15px;">
                    <div class="card-body p-0">
                        <div class="row g-0">
                            <div class="col-lg-8">
                                <div class="p-5">
                                    <div class="d-flex justify-content-between align-items-center mb-5">
                                        <h1 class="fw-bold mb-0 text-black">Đơn hàng của bạn</h1>
                                        <h6 class="mb-0"><a href="../controllers/CartController.php?clear=OK"
                                                class="text-body"><i class="fas fa-long me-2"></i>Xóa</a></h6>
                                        <h6 class="mb-0 text-muted"><?php echo isset($cart) ? count($cart) : 0; ?> món
                                        </h6>
                                    </div>
                                    <hr class="my-4">
                                    <?php $total = 0;?>
                                    <?php if (isset($cart)) {?>
                                    <?php foreach ($cart as $product): ?>
                                    <form action="../controllers/CartController.php" method="post">
                                        <!-- Product in cart -->
                                        <div class="row mb-4 d-flex justify-content-between align-items-center">
                                            <div class="col-md-2 col-lg-2 col-xl-2">
                                                <img src="../public/assets/img/food/<?=$product->getImage()?>"
                                                    class="img-fluid rounded-3" alt="<?=$product->getImage()?>">
                                            </div>
                                            <div class="col-md-3 col-lg-3 col-xl-3">
                                                <h6 class="text-muted"><?=$product->getName()?></h6>
                                                <h6 class="text-black mb-0"><?=$product->getDescription()?></h6>
                                            </div>
                                            <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                                                <button class="btn btn-link px-2" type="submit" name="action"
                                                    value="update"
                                                    onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                                <input type="hidden" name="id_product"
                                                    value="<?=$product->getProductId()?>">
                                                <input id="form1" min="0" name="quantity"
                                                    value="<?=$product->getQuantity()?>" type="number"
                                                    class="form-control form-control-sm" />
                                                <button class="btn btn-link px-2" type="submit" name="action"
                                                    value="update"
                                                    onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </div>
                                            <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                                <h6 class="mb-0"><?=$product->getPrice()?></h6>
                                            </div>
                                            <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                                <button type="submit" name="action" value="delete">
                                                    <a href="#!" class="text-muted"><i class="fas fa-times"></i></a>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                    <hr class="my-4">
                                    <?php $total += $product->quantity * $product->price;?>
                                    <?php endforeach;?>
                                    <?php }?>
                                    <div class="pt-5">
                                        <h6 class="mb-0"><a href="./home.php" class="text-body"><i
                                                    class="fas fa-long-arrow-alt-left me-2"></i>Back to shop</a></h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 bg-grey">
                                <div class="p-5">
                                    <h3 class="fw-bold mb-5 mt-2 pt-1">Xác nhận đơn hàng, thanh toán</h3>
                                    <hr class="my-4">

                                    <form action="../controllers/CartController.php" method="post"
                                        onsubmit="return validateForm()">
                                        <h5 class="text-uppercase mb-3">Ghi chú</h5>

                                        <div class="mb-5">
                                            <div class="form-outline">
                                                <input type="text" id="form3Examplea2" name="note"
                                                    class="form-control form-control-lg" />
                                                <label class="form-label" for="form3Examplea2">Điền thông tin, địa
                                                    chỉ</label>
                                            </div>
                                        </div>

                                        <hr class="my-4">

                                        <div class="d-flex justify-content-between mb-5">
                                            <h5 class="text-uppercase">Thành tiền</h5>
                                            <h5><?php echo $total; ?></h5>
                                        </div>
                                        <?php echo isset($_SESSION['payment_error']) == null ? "" : $_SESSION['payment_error']; ?>
                                        <button type="submit" class="btn btn-dark btn-block btn-lg" name=action
                                            value="payment" data-mdb-ripple-color="dark">Thanh toán</button>
                                    </form>
                                    <script>
                                    function showSuccess() {
                                        window.alert("Thanh toán thành công");
                                    }

                                    function validateForm() {
                                        var noteValue = document.getElementById("form3Examplea2").value;
                                        // Kiểm tra xem trường "note" có giá trị hay không
                                        if (noteValue.trim() === "") {
                                            window.alert(
                                                "Bạn chưa nhập thông tin địa chỉ. Vui lòng điền thông tin vào trường ghi chú."
                                            );
                                            return false; // Ngăn chặn việc submit form nếu thông tin chưa được nhập
                                        }
                                        showSuccess();
                                        return true;
                                    }
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>