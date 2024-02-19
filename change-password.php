<?php
require_once("header.php");


if (isset($_POST['changepassword'])) {
    $currentPassword = $_POST['currentpassword'];
    $newPassword = $_POST['newpassword'];
    $ConfirmnewPassword = $_POST['confirmnewpassword'];

    $dbPassword = $_SESSION['admin']['password'];
    $admin_id = $_SESSION['admin']['id'];

    if (empty($currentPassword)) {
        $error = "Enter Your Current Password";
    } elseif (empty($newPassword)) {
        $error = "Enter Your New Password";
    } elseif ($newPassword != $ConfirmnewPassword) {
        $error = "New Password Does Not Match!";
    } elseif (SHA1($currentPassword) != $dbPassword) {
        $error = "Current Password Is Wrong!";
    } elseif (strlen($newPassword) < 6 || strlen($newPassword) > 15) {
        $error = "Password Must Be Used 6 to 15 Digit";
    } else {
        $newPassword=SHA1($newPassword);
        $stm=$conn->prepare("UPDATE admin SET password=? WHERE id=?");
        $stm->execute(array($newPassword,$admin_id));
        $success="Password Change Successfully!";

        ?>
            <script>
                setTimeout(function(){
                    window.location="logout.php";
                },2000)
            </script>
        <?php 
    }
}

?>
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
            <div class="row w-100">
                <div class="col-lg-6 mx-auto">
                    <div class="auth-form-light text-left p-5">
                        <div class="brand-logo">
                            <img src="images/logo.svg">
                        </div>
                        <h2 class="text-center">Change Password</h2>
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
                                <input type="password" name="currentpassword" class="form-control form-control-lg" id="currentpassword" placeholder="Current Password">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control form-control-lg" id="newpassword" placeholder="Enter New Password" name="newpassword">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control form-control-lg" id="confirmnewpassword" placeholder="Confimrm New Password" name="confirmnewpassword">
                            </div>
                            <div class="mt-3">
                                <button class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" type="submit" name="changepassword">Change Password</button>
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
<?php require_once("footer.php") ?>