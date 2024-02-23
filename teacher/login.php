<?php
require_once("../config.php");
session_start();
if (isset($_POST['adminlogin'])) {
  $t_username = $_POST['username'];
  $t_password = $_POST['password'];

  if (empty($t_username)) {
    $error = "Please Enter Your User Name";
  } elseif (empty($t_password)) {
    $error = "Please Enter Your Password";
  } else {
    $stm = $conn->prepare("SELECT id,name,mobile,password FROM teachers WHERE mobile=? and password=?");
    $stm->execute(array($t_username, SHA1($t_password)));
    $teacherCount = $stm->rowCount();

    if ($teacherCount == true) {
      $teacher = $stm->fetch(PDO::FETCH_ASSOC);
      $_SESSION['teacher_login'] = $teacher;
      $success = "Teacher Login Successfully!";

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
if (isset($_SESSION['teacher_login'])) {
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
  <link rel="stylesheet" href="../vendors/iconfonts/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="../images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth">
        <div class="row w-100">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left p-5">
              <div class="brand-logo">
                <img src="../images/logo.svg">
              </div>
              <h2 class="text-center">Teacher Login</h2>
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
  <script src="../vendors/js/vendor.bundle.base.js"></script>
  <script src="../vendors/js/vendor.bundle.addons.js"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="../js/off-canvas.js"></script>
  <script src="../js/misc.js"></script>
  <!-- endinject -->
</body>

</html>