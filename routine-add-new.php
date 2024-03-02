<?php
require_once("header.php");

if (isset($_POST['create_routine'])) {
    $class_name = $_POST['class_name'];
    $sub_name = $_POST['sub_name_id'];
    $time_from = $_POST['time_from'];
    $time_to = $_POST['time_to'];
    $room_number = $_POST['room_number'];

    $teacher_id = getTableData('assign_teacher', 'teacher_id', $sub_name);
    $teacher_id=$teacher_id['teacher_id'];

    if (empty($class_name)) {
        $error = "Please Enter Class Name";
    } elseif (empty($sub_name)) {
        $error = "Please Enter Subject Name";
    } elseif (empty($time_from)) {
        $error = "Time From Is Required!";
    } elseif (empty($time_to)) {
        $error = "Time To Is Required!";
    } else {
       
        $created_At = date("Y-m-d H:i:s");
        $stm = $conn->prepare("INSERT INTO class_routine (class_name,subject_id,teacher_id,time_from,time_to,room_number,created_at) VALUES(?,?,?,?,?,?,?)");
        $stm->execute(array($class_name, $sub_name, $teacher_id, $time_from, $time_to, $room_number, $created_At));

        $success = "Class Routine Create Success!";
    }
}


?>
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-airballoon"></i>
        </span>
        Add New Routine
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
                        <label for="class_name">Class Name</label>
                        <select name="class_name" class="form-control" id="class_name">
                            <option value="">Select Class</option>
                            <?php
                            $get_all_class = GetAllData('class');

                            foreach ($get_all_class as $single_class) :
                            ?>
                                <option value="<?php echo $single_class['id'] ?>"><?php echo $single_class['class_name'] ?></option>
                            <?php endforeach; ?>

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="sub_name">Select Subjects</label>
                        <select name="sub_name_id" class="form-control" id="sub_name"></select>
                    </div>
                    <div class="form-group">
                        <label for="time_from">Time From</label>
                        <input type="time" name="time_from" class="form-control" id="time_from" placeholder="Time From" value="<?php echo get_values('time_from') ?>">
                    </div>
                    <div class="form-group">
                        <label for="time_to">Time To</label>
                        <input type="time" name="time_to" class="form-control" id="time_to" placeholder="Time To" value="<?php echo get_values('time_to') ?>">
                    </div>
                    <div class="form-group">
                        <label for="room_number">Room Number</label>
                        <input type="text" name="room_number" class="form-control" id="room_number" placeholder="Room Number" value="<?php echo get_values('room_number') ?>">
                    </div>
                    <button type="submit" name="create_routine" class="btn btn-gradient-primary mr-2">Create Routine</button>
                </form>
            </div>
        </div>
    </div>


    <?php require_once("footer.php") ?>

    <!-- ajax  -->

    <script>
        $('#class_name').change(function() {
            let class_id = $(this).val();

            $.ajax({
                type: 'POST',
                url: "ajax.php",
                data: {
                    class_id: class_id,
                },
                success: function(response) {
                    let data = response;
                    $('#sub_name').html(data);
                    console.log(response);
                }
            });
        })
    </script>