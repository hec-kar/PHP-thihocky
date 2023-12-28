<nav class="navbar navbar-expand-lg bg-body-tertiary ">
    <div class="container-fluid" style="width:  80%">
        <a class="nav-link" href="../../page/admin.php">
            <img src="../../public/assets/img/icon/shopeefoodvn.png" alt="alt" />
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <?php if ($user == null): ?>
                <li class="nav-item">
                    <a class="nav-link" href="../../page/login.php">Login</a>
                </li>
                <?php endif;?>

                <?php if ($user != null): ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Hi
                        <?=$user->getUsername();?>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="../../controllers/AdminProductController.php">Quản lý món
                                ăn</a></li>
                        <li><a class="dropdown-item" href="./admin.php">Đơn hàng</a></li>
                        <li><a class="dropdown-item" href="./logout.php">Log out</a></li>
                    </ul>
                </li>
                <?php endif;?>

            </ul>

        </div>
    </div>
</nav>