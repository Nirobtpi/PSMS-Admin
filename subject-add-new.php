<?php
require_once("header.php");

if (isset($_POST['create_subject'])) {
    $sub_name = $_POST['sub_name'];
    $sub_code = $_POST['sub_code'];
    $sub_type = $_POST['sub_type'];

    $teacherEmaileCount = tRowCount('teachers', 'email', $t_email);

    if (empty($t_name)) {
        $error = "Please Enter Your Name";
    } elseif (empty($t_email)) {
        $error = "Please Enter Your Email";
    } elseif (empty($t_mobile)) {
        $error = "Please Enter Your Mobile Number";
    } else {
        unset($_POST);
        $created_At = date("Y-m-d H:i:s");
        $stm = $conn->prepare("INSERT INTO teachers (name,email,mobile,address,gender,password,created_at) VALUES(?,?,?,?,?,?,?)");
        $stm->execute(array($t_name, $t_email, $t_mobile, $t_address, $t_gender, $t_password, $created_At));

        $success = "Subject Create Success!";
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
                <form class="forms-sample" method="POST">
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
                        <label for="male"><input type="radio" checked name="sub_type" value="Theroy" id="male">&nbsp; Theroy</label>&nbsp;&nbsp;
                        <label for="female"><input type="radio" name="sub_type" value="Practical" id="female"> &nbsp; Practical</label>
                    </div>
                    <button type="submit" name="create_subject" class="btn btn-gradient-primary mr-2">Create Subject</button>
                </form>
            </div>
        </div>
    </div>


    <?php require_once("footer.php") ?>