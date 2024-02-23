<?php
require_once("header.php");
$teacher_id = $_SESSION['teacher_login']['id'];
// echo $teacher_id;


if (isset($_POST['t_change_password'])) {
    $current_password = $_POST['t_c_password'];
    $t_n_password = $_POST['t_n_password'];
    $t_c_n_password = $_POST['t_c_n_password'];

    $dbTpassword = getTableData('teachers', 'password', $teacher_id);
    // echo $dbTpassword['password'];

    if (empty($current_password)) {
        $error = "Please Enter Your Current Password";
    } elseif (empty($t_n_password)) {
        $error = "Please Enter Your New Password";
    } elseif ($dbTpassword['password'] != SHA1($current_password)) {
        $error = "Current Password Does Not Match!";
    } elseif (strlen($t_n_password) < 6 or strlen($t_n_password) > 15) {
        $error = "Password Must Be Used 6 to 15 DIgit";
    } elseif ($t_n_password != $t_c_n_password) {
        $error = "New Password Does Not Match";
    } else {
        $t_n_password = SHA1($t_n_password);

        $stm = $conn->prepare("UPDATE teachers SET password=?  WHERE id=?");
        $stm->execute(array($t_n_password, $teacher_id));

        $success = "Password Change Success!";

?>
        <script>
            setTimeout(function() {
                window.location = "logout.php";
            }, 2000)
        </script>
<?php

    }
}

?>

<div class="col-md-6 grid-margin stretch-card">
    <div class="card">

        <div class="card-body">
            <h4 class="card-title mb-3">Change Password</h4>
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
            <form class="forms-sample" method="POST">
                <div class="form-group">
                    <label for="t_c_password">Current Password</label>
                    <input type="password" class="form-control" name="t_c_password" id="t_c_password" placeholder="Current Password">
                </div>
                <div class="form-group">
                    <label for="t_n_password">New Paasword</label>
                    <input type="password" class="form-control" name="t_n_password" id="t_n_password" placeholder="New Password">
                </div>
                <div class="form-group">
                    <label for="t_c_n_password">Confirm Password</label>
                    <input type="password" class="form-control" name="t_c_n_password" id="t_c_n_password" placeholder="Confirm Password">
                </div>
                <button type="submit" name="t_change_password" class="btn btn-gradient-primary mr-2">Change Password</button>
                <a href="index.php" class="btn btn-light">Cancel</a>
            </form>
        </div>
    </div>
</div>

<?php require_once("footer.php") ?>