<?php
require_once("header.php");
$id = $_REQUEST['id'];

if (isset($_POST['create_class'])) {
    $class_name = $_POST['class_name'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    if (isset($_POST['subject'])) {
        $subject = $_POST['subject'];
    } else {
        $subject = "";
    }

    if (empty($class_name)) {
        $error = "Please Enter Class Name";
    } elseif (empty($start_date)) {
        $error = "Please Enter Start Date";
    } elseif (empty($end_date)) {
        $error = "Please Enter Your End Date";
    } elseif (empty($subject)) {
        $error = "Please Enter Your Subject";
    } else {
        $subject = json_encode($subject);
        $stm = $conn->prepare("UPDATE class SET  class_name=?,start_date=?,end_date=?,subjects=? WHERE id=?");
        $stm->execute(array($class_name, $start_date, $end_date, $subject,$id));

        $success = "Class Update Success!";
        ?>
            <script>
                setTimeout(function(){
                    window.location="class-all.php?success=Data Update Successfully";
                })
            </script>
        <?php
    }
}

$tableData = getAllTableData('class', $id);


?>
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-airballoon"></i>
        </span>
        Edit Class
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
                        <label for="class_name">Class Title</label>
                        <input type="text" name="class_name" class="form-control" id="class_name" placeholder="Class Name" value="<?php echo $tableData['class_name'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="start_date">Start Date</label>
                        <input type="date" name="start_date" class="form-control" id="start_date" placeholder="Start Date" value="<?php echo $tableData['start_date'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="end_date">End Date</label>
                        <input type="date" name="end_date" class="form-control" id="end_date" placeholder="End Date" value="<?php echo $tableData['end_date'] ?>">
                    </div>
                    <div class="form-group">
                        <?php
                        $nirob = json_decode($tableData['subjects']);
                        // print_r($getSub);
                        $stm = $conn->prepare("SELECT * FROM subject");
                        $stm->execute(array());
                        $getSub = $stm->fetchAll(PDO::FETCH_ASSOC);
                        // print_r($getSub);
                        foreach ($getSub as $sub) :
                        ?>
                            <label for="subject<?php echo $sub['id'] ?>"><input type="checkbox" name="subject[]" <?php foreach ($nirob as $nir) {
                                                                                                                        if ($nir == $sub['id']) {
                                                                                                                            echo "checked";
                                                                                                                        }
                                                                                                                    } ?> value="<?php echo $sub['id'] ?>" id="subject<?php echo $sub['id'] ?>">&nbsp; <?php echo $sub['sub_name'] ?> - <?php echo $sub['sub_code']; ?></label><br><br>
                        <?php endforeach; ?>
                    </div>

                    <button type="submit" name="create_class" class="btn btn-gradient-primary mr-2">Edit Class</button>
                </form>
            </div>
        </div>
    </div>


    <?php require_once("footer.php") ?>