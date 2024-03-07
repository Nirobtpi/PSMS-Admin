<?php
require_once("header.php");
$teacher_id = $_SESSION['teacher_login']['id'];
// echo $teacher_id;


if (isset($_POST['filter_student'])) {
    $class_id = $_POST['class_id'];

    $stm = $conn->prepare("SELECT * FROM student WHERE current_class=?");
    $stm->execute(array($class_id));
    $filter_student = $stm->fetchAll(PDO::FETCH_ASSOC);
    // print_r($res);
}

?>

<div class="col-md-12 grid-margin stretch-card">
    <div class="card">

        <div class="card-body">
            <h4 class="card-title mb-3">Students</h4>
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
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="class">Select Class:</label>
                            <select class="form-control" name="class_id" id="class">
                                <?php
                                $all_class = GetAllData('class');
                                foreach ($all_class as $class) :
                                ?>
                                    <option <?php if (isset($_POST['filter_student']) and $_POST['class_id'] == $class['id']) {
                                                echo "selected";
                                            } ?> value="<?php echo $class['id'] ?>"><?php echo $class['class_name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <button type="submit" name="filter_student" class="btn btn-gradient-primary mr-2">Filter Student</button>
                        </div>
                    </div>
                </div>


            </form>
        </div>
    </div>
</div>
<?php if (isset($_POST['filter_student'])) : ?>
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <h2 class="text-center pt-2">Filter Students</h2>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Student Name</th>
                            <th>Class Name</th>
                            <th>Mobile</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($filter_student as $student) :
                        ?>
                            <tr>
                                <td><?php echo $i;
                                    $i++; ?></td>
                                <td><?php echo $student['name'] ?></td>
                                <td>
                                    <?php
                                    if ($student['current_class'] != "") {
                                        $class_name = getTableData('class', 'class_name', $student['current_class']);
                                        echo $class_name['class_name'];
                                    } else {
                                        echo "Not Register";
                                    }
                                    ?>
                                </td>
                                <td><?php echo $student['mobile'] ?></td>
                                <td><?php echo $student['email'] ?></td>

                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php else : ?>
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <h2 class="text-center pt-2">All Students</h2>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Student Name</th>
                            <th>Class Name</th>
                            <th>Mobile</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $all_students = GetAllData('student');
                        // print_r($all_students);
                        $i = 1;
                        foreach ($all_students as $student) :
                        ?>
                            <tr>
                                <td><?php echo $i;
                                    $i++; ?></td>
                                <td><?php echo $student['name'] ?></td>
                                <td>
                                    <?php
                                    if ($student['current_class'] != "") {
                                        $class_name = getTableData('class', 'class_name', $student['current_class']);
                                        echo $class_name['class_name'];
                                    } else {
                                        echo "Not Register";
                                    }
                                    ?>
                                </td>
                                <td><?php echo $student['mobile'] ?></td>
                                <td><?php echo $student['email'] ?></td>

                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php require_once("footer.php") ?>