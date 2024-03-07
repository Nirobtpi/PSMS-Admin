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

<div class="col-md-12 grid-margin stretch-card">
    <div class="card">

        <div class="card-body">
            <h4 class="card-title mb-3">New Attendance</h4>
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
                            <select class="form-control" name="class_name" id="class_name">
                                <option value="">Select A Class</option>
                                <?php
                                $stm = $conn->prepare("SELECT DISTINCT class_name FROM class_routine WHERE teacher_id=?");
                                $stm->execute(array($teacher_id));
                                $class_list = $stm->fetchAll(PDO::FETCH_ASSOC);
                                ?>
                                <?php $i = 1;
                                foreach ($class_list as $class) :
                                    $get_class_name = getTableData('class', 'class_name', $class['class_name']);
                                ?>
                                    <option value="<?php echo $get_class_name['class_name'] ?>"><?php echo $get_class_name['class_name'] ?></option>
                                <?php endforeach;  ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="subject">Select Subjects:</label>
                            <select class="form-control" name="subject" id="">
                                <option value=""></option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="att_date">Select Date:</label>
                            <input type="date" class="form-control" name="att_date" id="att_date">
                        </div>
                    </div>
                </div>

                <button type="submit" name="submit" class="btn btn-gradient-primary mr-2">Submit</button>
            </form>
        </div>
    </div>
</div>
<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <form action="" method="POST">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Student Name</th>
                            <th>Student Roll</th>
                            <th>Absent</th>
                            <th>Present</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Nirob</td>
                            <td>1013</td>
                            <td><label for="absent"><input type="radio" value="0" name="attendance" id="absent"> Absent</label></td>
                            <td><label for="present"><input type="radio" value="1" name="attendance" id="present"> Present</label></td>
                        </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <input type="submit" name="attendance" class="btn btn-success mt-3" value="Submit Attendance">
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once("footer.php") ?>

<script>
    $('#class_name').change(function() {
        let class_id = $(this).val();
        let teacher_id = "<?php echo $teacher_id  ?>";

        $.ajax({
            type: 'POST',
            url: "ajax.php",
            data: {
                teacher_id: teacher_id,
                class_id: class_id,
            },
            success: function(response) {
                let data = response;
                console.log(data);
                $('#sub_name').html(data);
                console.log(response);
            }
        });
    })
</script>