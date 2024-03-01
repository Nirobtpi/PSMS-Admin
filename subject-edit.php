<?php
require_once("header.php");

$id = $_REQUEST['id'];

if (isset($_POST['update_subject'])) {
    $sub_name = $_POST['sub_name'];
    $sub_type = $_POST['sub_type'];

    if (empty($sub_name)) {
        $error = "Please Enter Subject Name";
    } else {
        unset($_POST);
        $created_At = date("Y-m-d H:i:s");
        $stm = $conn->prepare("UPDATE subject SET sub_name=?,sub_type=? WHERE id=?");
        $stm->execute(array($sub_name, $sub_type, $id));

        $success = "Subject Updated Success!";

?>
        <script>
            setTimeout(function() {
                window.location = "subject-all.php";
            },2000);
        </script>
<?php
    }
}

$getSubData = getAllTableData('subject', $id);

?>
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-airballoon"></i>
        </span>
        Edit Subject
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
                        <input type="text" name="sub_name" class="form-control" id="sub_name" placeholder="Subject Name" value="<?php echo $getSubData['sub_name'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="sub_code">Subject Code</label>
                        <input type="text" name="sub_code" class="form-control" id="sub_code" placeholder="Subject Code" value="<?php echo $getSubData['sub_code'] ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="t_gender">Subject Type</label>
                        <br>
                        <label for="male"><input type="radio" <?php if ($getSubData['sub_type'] == "Theroy") {
                                                                    echo "checked";
                                                                } ?> name="sub_type" value="Theroy" id="male">&nbsp; Theroy</label>&nbsp;&nbsp;
                        <label for="female"><input type="radio" <?php if ($getSubData['sub_type'] == "Practical") {
                                                                    echo "checked";
                                                                } ?> name="sub_type" value="Practical" id="female"> &nbsp; Practical</label>
                    </div>
                    <button type="submit" name="update_subject" class="btn btn-gradient-primary mr-2">Update Subject</button>
                </form>
            </div>
        </div>
    </div>


    <?php require_once("footer.php") ?>