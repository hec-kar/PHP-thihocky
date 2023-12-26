<?php 
session_start();
define("PAGE_TITLE", "Login Page"); 
$error_register = isset($_SESSION['error_register']) ? $_SESSION['error_register'] : '';
$err_email = isset($_SESSION['err_email']) ? $_SESSION['err_email'] : '';
$err_phone = isset($_SESSION['err_phone']) ? $_SESSION['err_phone'] : '';
$err_repassword = isset($_SESSION['err_repassword']) ? $_SESSION['err_repassword'] : '';
$name_value = isset($_SESSION['name_value']) ? $_SESSION['name_value'] : '';
$email_value = isset($_SESSION['email_value']) ? $_SESSION['email_value'] : '';
$phone_value = isset($_SESSION['phone_value']) ? $_SESSION['phone_value'] : '';
?>


<section class="vh-60" style="background-color: #eee; display: block;">
  <div class="container h-60">
    <div class="row d-flex justify-content-center align-items-center h-60">
      <div class="col-lg-12 col-xl-11">
        <div class="card text-black" style="border-radius: 25px;">
          <div class="card-body p-md-5">
            <div class="row justify-content-center">
              <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                <p class="text-center h1 fw-bold mb-3 mx-1 mx-md-4 mt-4">Sign up</p>
                
                <form class="mx-1 mx-md-4" action="" method="post">

                  <?php if (!empty($error_register)) : ?>
                    <div class="link-danger"> <?php echo $error_register; ?></div>
                  <?php endif; ?>

                  <div class="d-flex flex-row align-items-center mb-3">
                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <label class="form-label" for="form3Example1c">Your Name</label>
                      <input type="text" name="name" class="form-control" required="required" value="<?php echo htmlspecialchars($name_value); ?>" />
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-3">
                    <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <label class="form-label" for="form3Example3c">Your Email</label>
                      <input type="email" name="email" class="form-control" required="required" value="<?php echo htmlspecialchars($email_value); ?>" />
                      <?php if (!empty($err_email)) : ?>
                        <span style="color: red"><?php echo $err_email; ?></span>
                      <?php endif; ?>
                    </div>
                  </div>
                    
                  <div class="d-flex flex-row align-items-center mb-3">
                    <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <label class="form-label" for="form3Example3c">Your Phone</label>
                      <input type="phone" name="phone" class="form-control" required="required" value="<?php echo htmlspecialchars($phone_value); ?>" />
                      <?php if (!empty($err_phone)) : ?>
                        <span style="color: red"><?php echo $err_phone; ?></span>
                      <?php endif; ?>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-3">
                    <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <label class="form-label" for="form3Example4c">Password</label>
                      <input type="password" name="password" class="form-control" required="required" />
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-3">
                    <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <label class="form-label" for="form3Example4cd">Repeat your password</label>
                      <input type="password" name="repassword" class="form-control" required="required" />
                      <?php if (!empty($err_repassword)) : ?>
                        <span style="color: red"><?php echo $err_repassword; ?></span>
                      <?php endif; ?>
                    </div>
                  </div>

                  <div class="form-check d-flex justify-content-center mb-3">
                    <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3c" />
                    <label class="form-check-label" for="form2Example3">
                      I agree all statements in <a href="#!">Terms of service</a>
                    </label>
                  </div>

                  <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                    <button type="submit" class="btn btn-primary btn-lg">Register</button>
                  </div>

                </form>

              </div>
              <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/draw1.webp"
                  class="img-fluid" alt="Sample image">

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php
// Xóa giá trị từ session sau khi sử dụng để tránh hiển thị lỗi không mong muốn
unset($_SESSION['error_register']);
unset($_SESSION['err_email']);
unset($_SESSION['err_phone']);
unset($_SESSION['err_repassword']);
unset($_SESSION['name_value']);
unset($_SESSION['email_value']);
unset($_SESSION['phone_value']);
include_once "../../Controller/handleRegister.php"; ?>
