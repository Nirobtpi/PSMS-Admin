<?php
require_once("header.php");

if (isset($_POST['assign_teacher'])) {
    $t_name = $_POST['teacher_name'];
    $assign_subject = $_POST['subject'];

    $subject_count = tRowCount('assign_teacher', 'subject_id', $assign_subject);

    if ($subject_count != 0) {
        $error = "Already Assign Teacher For This Subject";
    } else {
        $created_at = date("Y-d-m H:i s");

        $stm = $conn->prepare("INSERT INTO assign_teacher (teacher_id,subject_id,created_at) VALUES (?,?,?)");
        $stm->execute(array($t_name, $assign_subject, $created_at));

        $success = "Teacher Assign Successfully!";
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
                        // print_r($teacher);
                        ?>
                        <select name="teacher_name" id="teacher_name" class="form-control">
                            <?php foreach ($teachers as $teacher) : ?>
                                <option value="<?php echo $teacher['id'] ?>"><?php echo $teacher['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <select name="subject" id="subject" class="form-control">
                            <?php
                            $subjects = AlltableData('subject');

                            foreach ($subjects as $subject) :
                            ?>
                                <option value="<?php echo $subject['id'] ?>"><?php echo $subject['sub_name'] . "-" . $subject['sub_code'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <button type="submit" name="assign_teacher" class="btn btn-gradient-primary mr-2">Assign Subject</button>
                </form>
            </div>
        </div>
    </div>


    <?php require_once("footer.php") ?>