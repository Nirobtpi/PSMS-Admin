<?php
require_once("header.php");

if (isset($_POST['create_teacher'])) {
    $t_name = $_POST['t_name'];
    $t_email = $_POST['t_email'];
    $t_mobile = $_POST['t_mobile'];
    $t_address = $_POST['t_address'];
    $t_gender = $_POST['t_gender'];
    $t_password = $_POST['t_password'];
    $t_c_password = $_POST['t_c_password'];
    // $t_photo = $_FILES['t_photo']['name'];
    $t_terms = $_POST['t_terms'];
    $patten = '/(^(\+88|0088)?(01){1}[3456789]{1}(\d){8})$/';

    // $terget_dir = 'uploads/';
    // $terget_file = $terget_dir . basename($_FILES['t_photo']['name']);
    // $fileExtention = strtolower(pathinfo($terget_file, PATHINFO_EXTENSION));

    $teacherMobileCount = tRowCount('teachers', 'mobile', $t_mobile);
    $teacherEmaileCount = tRowCount('teachers', 'email', $t_email);

    if (empty($t_name)) {
        $error = "Please Enter Your Name";
    } elseif (empty($t_email)) {
        $error = "Please Enter Your Email";
    } elseif (empty($t_mobile)) {
        $error = "Please Enter Your Mobile Number";
    } elseif (!preg_match($patten, $t_mobile)) {
        $error = "Please Enter A Valid Phone Number";
    } elseif (!filter_var($t_email, FILTER_VALIDATE_EMAIL)) {
        $error = "Please Enter A Valid Email";
    } elseif (empty($t_password)) {
        $error = "Please Enter Your Password";
    } elseif ($t_password != $t_c_password) {
        $error = "Passsword Does Not Match!";
    } elseif (strlen($t_password) < 6 or strlen($t_password) > 15) {
        $error = "Password Must Be Used 6 T0 15 Digit!";
    } elseif ($teacherEmaileCount != 0) {
        $error = "Email Already Used!";
    } elseif ($teacherMobileCount != 0) {
        $error = "Mobile Number Already Used!";
    } else {
        unset($_POST);
        $created_At = date("Y-m-d H:i:s");
        $t_password = SHA1($t_password);
        $stm = $conn->prepare("INSERT INTO teachers (name,email,mobile,address,gender,password,created_at) VALUES(?,?,?,?,?,?,?)");
        $stm->execute(array($t_name, $t_email, $t_mobile, $t_address, $t_gender, $t_password, $created_At));

        $success = "Data Insert Success!";
    }
}


?>
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-airballoon"></i>
        </span>
        Add New Subject
    </h3>
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
                <span></span>Overview
                <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
            </li>
        </ul>
    </nav>
</div>

<div class="row">
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
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
                <form class="forms-sample" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="sub_name">Subject Name</label>
                        <input type="text" name="sub_name" class="form-control" id="sub_name" placeholder="Subject Name" value="<?php echo get_values('sub_name') ?>">
                    </div>
                    <div class="form-group">
                        <label for="sub_code">Subject Code</label>
                        <input type="text" name="sub_code" class="form-control" id="sub_code" placeholder="Subject Code" value="<?php echo get_values('sub_code') ?>">
                    </div>
                    <div class="form-group">
                        <label for="t_gender">Subject Type</label>
                        <br>
                        <label for="male"><input type="radio" checked name="Sub_type" value="Theroy" id="male">&nbsp; Theroy</label>&nbsp;&nbsp;
                        <label for="female"><input type="radio" name="Sub_type" value="Practical" id="female"> &nbsp; Practical</label>
                    </div>
                    <button type="submit" name="create_subject" class="btn btn-gradient-primary mr-2">Create Subject</button>
                </form>
            </div>
        </div>
    </div>


    <?php require_once("footer.php") ?>