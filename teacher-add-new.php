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
    $t_photo = $_FILES['t_photo']['name'];
    $t_terms = $_POST['t_terms'];
    $patten = '/(^(\+88|0088)?(01){1}[3456789]{1}(\d){8})$/';

    $terget_dir='uploades/';
    $terget_file=$terget_dir. basename($t_photo);
    $fileExtention=strtolower(pathinfo($terget_file,PATHINFO_EXTENSION));

    $teacherMobileCount= tRowCount('teachers','mobile',$t_mobile);
    $teacherEmaileCount= tRowCount('teachers','email',$t_email);

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
    }elseif(empty($t_password)){
        $error="Please Enter Your Password";
    }elseif($t_password != $t_c_password){
        $error="Passsword Does Not Match!";
    }elseif(strlen($t_password) < 6 or strlen($t_password) > 15){
        $error="Password Must Be Used 6 T0 15 Digit!";
    }elseif($teacherEmaileCount !=1){
        $error="Email Already Used!";
    }elseif($teacherMobileCount !=1){
        $error="Mobile Number Already Used!";
    }else{
        if(!empty($t_photo)){
            

            if($fileExtention !="png" and $fileExtention !='jpg' and $fileExtention !='jpeg'){
                $error="File Must Be Used Jpeg,Png Or Jpg Verson!";
            }else{
                $newphotoname = $terget_dir . $t_name . rand(1111, 9999) . "." . $fileExtention;
                move_uploaded_file($_FILES['t_photo']['tmp_name'],$terget_dir);

                print_r($_FILES['t_photo']);
            }
        }else{
            // $id= getTableData('teachers','id')
           $newphotoname= "Null";
        }
    }
}


?>
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-account"></i>
        </span>
        Add New Teacher
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
                        <label for="t_name">Teacher Name</label>
                        <input type="text" name="t_name" class="form-control" id="t_name" placeholder="Teacher Name" value="<?php echo get_values('t_name') ?>">
                    </div>
                    <div class="form-group">
                        <label for="t_email">Teacher Email</label>
                        <input type="email" name="t_email" class="form-control" id="t_email" placeholder="Teacher Email" value="<?php echo get_values('t_email') ?>">
                    </div>
                    <div class="form-group">
                        <label for="t_mobile">Teacher Mobile</label>
                        <input type="text" name="t_mobile" class="form-control" id="t_mobile" placeholder="Teacher Mobile" value="<?php echo get_values('t_mobile') ?>">
                    </div>
                    <div class="form-group">
                        <label for="t_address">Address</label>
                        <textarea name="t_address" class="form-control" id="t_address"><?php echo get_values('t_address') ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="t_gender">Gender</label>
                        <br>
                        <label for="male"><input type="radio" checked name="t_gender" value="Male" id="male">&nbsp; Male</label>&nbsp;&nbsp;
                        <label for="female"><input type="radio" name="gender" value="Female" id="female"> &nbsp; Female</label>
                    </div>
                    <div class="form-group">
                        <label for="t_password">Password</label>
                        <input type="password" name="t_password" class="form-control" id="t_password" placeholder="Teacher Password" value="<?php echo get_values('t_password') ?>">
                    </div>
                    <div class="form-group">
                        <label for="t_c_password">Confirm Password</label>
                        <input type="password" name="t_c_password" class="form-control" id="t_c_password" placeholder="Teacher Password" value="<?php echo get_values('t_c_password') ?>">
                    </div>
                    <div class="form-group">
                        <label for="t_photo">Teacher Photo:</label><br>
                        <input type="file" value="<?php echo get_values('t_photo') ?>" name="t_photo" id="t_photo" placeholder="Teacher Photo">
                    </div>
                    <div class="form-check mb-3 form-check-flat form-check-primary">
                        <label class="form-check-label">
                            <input type="checkbox" checked name="t_terms" class="form-check-input">
                            Remember me
                        </label>
                    </div>
                    <button type="submit" name="create_teacher" class="btn btn-gradient-primary mr-2">Create Teacher Profile</button>
                </form>
            </div>
        </div>
    </div>


    <?php require_once("footer.php") ?>