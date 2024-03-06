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
        <?php echo $sub['class_name'] ?> : Class Detais
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

                    <tbody>
                        <?php

                        $stm = $conn->prepare("SELECT * FROM class WHERE id=?");
                        $stm->execute(array($_REQUEST['id']));
                        $alldata = $stm->fetch(PDO::FETCH_ASSOC);
                        // print_r($alldata);
                        ?>
                        <tr>
                            <td><b>Class Name</b></td>
                            <td><?php echo $alldata['class_name'] ?></td>
                        </tr>
                        <tr>
                            <td><b>Subjects Name</b></td>
                            <td><?php
                                $all_sub = json_decode($alldata['subjects']);
                                foreach ($all_sub as $sin_sub) {
                                    $get_sub_name = getTableData('subject', 'sub_name', $sin_sub);
                                    echo $get_sub_name['sub_name'] ."<br>". "<br>";
                                }

                                ?></td>
                        </tr>
                        <tr>
                            <td><b>Start Date</b></td>
                            <td><?php echo $alldata['start_date'] ?></td>
                        </tr>
                        <tr>
                            <td><b>End Date</b></td>
                            <td><?php echo $alldata['end_date'] ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <?php require_once("footer.php") ?>