<?php
require_once("header.php");
$id = $_REQUEST['id'];

if (isset($_POST['update_assign_teacher'])) {
    $t_name = $_POST['teacher_name'];
    $assign_subject = $_POST['subject'];

    $subject_count = tRowCount('assign_teacher', 'subject_id', $assign_subject);

    if ($subject_count != 0) {
        $error = "Already Assign Teacher For This Subject";
    } else {

        $stm = $conn->prepare("UPDATE assign_teacher SET teacher_id=?,subject_id=? WHERE id=?");
        $stm->execute(array($t_name, $assign_subject, $id));

        $success = "Teacher Assign Data Updated Successfully!";
    }
}


?>
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-account"></i>
        </span>
        New Teacher Assign
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
                        <label for="teacher_name">Teacher Name</label>
                        <?php
                        $teachers = AlltableData('teachers');
                        $getTeacherAsId = getTableData('assign_teacher', 'teacher_id', $id);
                        // print_r($teacher);
                        ?>
                        <select name="teacher_name" id="teacher_name" class="form-control">
                            <?php foreach ($teachers as $teacher) : ?>
                                <option <?php if ($getTeacherAsId['teacher_id'] == $teacher['id']) {
                                            echo "selected";
                                        }  ?> value="<?php echo $teacher['id'] ?>"><?php echo $teacher['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <select name="subject" id="subject" class="form-control">
                            <?php
                            $subjects = AlltableData('subject');
                            $getSubjectAsId = getTableData('assign_teacher', 'subject_id', $id);

                            foreach ($subjects as $subject) :
                            ?>
                                <option <?php if ($getSubjectAsId['subject_id'] == $subject['id']) {
                                            echo 'selected';
                                        } ?> value="<?php echo $subject['id'] ?>"><?php echo $subject['sub_name'] . "-" . $subject['sub_code'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <button type="submit" name="update_assign_teacher" class="btn btn-gradient-primary mr-2">Update Assign Subject</button>
                </form>
            </div>
        </div>
    </div>


    <?php require_once("footer.php") ?>