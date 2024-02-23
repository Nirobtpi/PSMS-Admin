<?php
require_once("header.php");

$id = $_REQUEST['id'];

$editTeacherData = getAllTableData('teachers', $id);

// print_r($editTeacherData);
// echo $id;
if (isset($_POST['update_teacher'])) {
    $t_name = $_POST['t_name'];
    $t_gender = $_POST['gender'];
    $t_photo = $_FILES['t_photo']['name'];

    $terget_dir = "../uploads/";
    $terget_file = $terget_dir . basename($t_photo);
    $fileExtention = strtolower(pathinfo($terget_file, PATHINFO_EXTENSION));

    if (empty($t_name)) {
        $error = "Name Is Required!";
    } elseif (empty($t_gender)) {
        $error = "Gender Is Required!";
    } else {
        unset($_POST);
        if (!empty($t_photo)) {
            if ($fileExtention != 'jpg' and $fileExtention != "png" and $fileExtention != 'jpeg') {
                $error = "File Must Be Used Jpg Png And Jpeg Version";
            } else {
                $newPname =$terget_dir.$t_name . rand(1111, 9999) . "." . $fileExtention;

                move_uploaded_file($_FILES['t_photo']['tmp_name'], $newPname);
            }
        } else {
            $newPname = $editTeacherData['photo'];
            // echo $newname;
        }

        $stm = $conn->prepare("UPDATE teachers SET name=?,gender=?,photo=? WHERE id=?");
        $stm->execute(array($t_name, $t_gender, $newPname, $id));

        $success = "Data Update Successfully!";

?>
        <script>
            setTimeout(function() {
                window.location = 'teacher-profile.php';
            }, 1000);
        </script>
<?php
    }
}


?>

<div class="row">
    <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Teacher Data</h4>

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
                        <label for="exampleInputUsername1">Teacher Name</label>
                        <input type="text" name="t_name" value="<?php echo $editTeacherData['name'] ?>" class="form-control" id="t_name" placeholder="Teacher Name">
                    </div>
                    <div class="form-group">
                        <label for="t_email">Email Address</label>
                        <input type="email" value="<?php echo $editTeacherData['email'] ?>" class="form-control" readonly id="t_email">
                    </div>
                    <div class="form-group">
                        <label for="number">Phone Number</label>
                        <input type="text" class="form-control" value="<?php echo $editTeacherData['mobile'] ?>" id="number" readonly>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" <?php if ($editTeacherData['gender'] == 'Male') {
                                                    echo "Checked";
                                                } ?> class="form-check-input" name="gender" id="optionsRadios1" value="Male">
                            Male
                            <i class="input-helper"></i></label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" <?php if ($editTeacherData['gender'] == 'Female') {
                                                    echo "Checked";
                                                } ?> class="form-check-input" name="gender" id="optionsRadios1" value="Female">
                            Female
                            <i class="input-helper"></i></label>
                    </div>
                    <div class="form-group mt-3">
                        <!-- <label for="number">Teacher Photo</label> -->
                        <input type="file" id="number" name="t_photo">
                        <br>
                        <br>
                        <?php if ($editTeacherData['photo'] != '') : ?>
                            <img style="width: 50px; height:50px" src="../<?php echo $editTeacherData['photo'] ?>" alt="">
                        <?php else : ?>
                            <h5 class="mt-2">Please Upload Your Photo</h5>
                        <?php endif; ?>
                    </div>

                    <button type="submit" name="update_teacher" class="btn btn-gradient-primary mt-3 mr-2">Update Teacher Data</button>
                    <!-- <button class="btn btn-light">Cancel</button> -->
                </form>
            </div>
        </div>
    </div>
</div>


<?php require_once("footer.php"); ?>