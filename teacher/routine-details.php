<?php
require_once("header.php");

$id = $_REQUEST['id'];
$t_id = $_SESSION['teacher_login']['id'];

if (!isset($id)) {

?>
    <script>
        setTimeout(() => {
            window.location = "routine-all.php";
        });
    </script>
<?php
}
$sub = getTableData('class', 'class_name', $id);

?>
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-account-multiple"></i>
        </span>
        <?php echo $sub['class_name'] ?> : Routine Detais
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
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>
                                #
                            </th>
                            <th>
                                Class Name
                            </th>
                            <th>Subject Name</th>
                            <th>Teacher Name</th>
                            <th>Time From</th>
                            <th>Time TO</th>
                            <th>Room Number</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // $stm = $conn->prepare("SELECT DISTINCT class_name FROM class_routine");
                        // $stm->execute(array());
                        // $class_list = $stm->fetchAll(PDO::FETCH_ASSOC);

                        $stm = $conn->prepare("SELECT * FROM class_routine WHERE class_name=? AND teacher_id=?");
                        $stm->execute(array($_REQUEST['id'], $t_id));
                        $alldata = $stm->fetchAll(PDO::FETCH_ASSOC);
                        // print_r($alldata);
                        ?>
                        <?php $i = 1;
                        foreach ($alldata as $singleData) :
                            $get_class_name = getTableData('class', 'class_name', $singleData['class_name']);
                            $get_subject_name = getTableData('subject', 'sub_name', $singleData['subject_id']);
                            $get_teacher_name = getTableData('teachers', 'name', $singleData['teacher_id']);
                        ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $get_class_name['class_name'] ?></td>
                                <td><?php echo $get_subject_name['sub_name'] ?></td>
                                <td><?php echo $get_teacher_name['name'] ?></td>
                                <td><?php echo $singleData['time_from'] ?></td>
                                <td><?php echo $singleData['time_to'] ?></td>
                                <td><?php echo $singleData['room_number'] ?></td>
                            </tr>
                        <?php $i++;
                        endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <?php require_once("footer.php") ?>