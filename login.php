<?php
require_once("config.php");
session_start();
if (isset($_POST['adminlogin'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  // $stm = $conn->prepare("SELECT * FROM admin WHERE user_name=?");
  // $stm->execute(array($username));
  // $res = $stm->fetch(PDO::FETCH_ASSOC);
  // print_r($res);

  // $dbnusername = $res['user_name'];
  // $dbPassword = $res['password'];
  // echo $dnusername;

  // print_r($res);

  if (empty($username)) {
    $error = "Please Enter Your User Name";
  } elseif (empty($password)) {
    $error = "Please Enter Your Password";
  } else {
    $stm = $conn->prepare("SELECT id,name,user_name,password FROM admin WHERE user_name=? and password=?");
    $stm->execute(array($username, SHA1($password)));
    $adminCount = $stm->rowCount();

    if ($adminCount == true) {
      $admin = $stm->fetch(PDO::FETCH_ASSOC);
      $_SESSION['admin'] = $admin;
      $success = "Admin Login Successfully!";

?>
      <script>
        setTimeout(function() {
          window.location.href = "index.php";
        }, 2000);
      </script>
<?php
    } else {
      $error = "Your User Name Or Password Wrong!";
    }
  }
}
if (isset($_SESSION['admin'])) {
  header("location:index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Admin Login</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/iconfonts/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth">
        <div class="row w-100">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left p-5">
              <div class="brand-logo">
                <img src="images/logo.svg">
              </div>
              <h2 class="text-center">Admin Login</h2>
              <?php if (isset($error)) : ?>
                <div class="alert alert-danger">
                  <?php echo $error; ?>
                </div>
              <?php endif; ?>
              <?php if (isset($success)) : ?>
                <div class="alert alert-success">
                  <?php echo $success; ?>
                </div>
              <?php endif; ?>
              <form class="pt-3" method="POST">
                <div class="form-group">
                  <input type="text" name="username" class="form-control form-control-lg" id="admin" placeholder="Username">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" id="password" placeholder="Password" name="password">
                </div>
                <div class="mt-3">
                  <button class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" type="submit" name="adminlogin">SIGN IN</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="vendors/js/vendor.bundle.base.js"></script>
  <script src="/vendors/js/vendor.bundle.addons.js"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/misc.js"></script>
  <!-- endinject -->
</body>

</html>