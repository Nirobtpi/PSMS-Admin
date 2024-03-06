<?php
require_once("header.php");

$t_id = $_SESSION['teacher_login']['id'];


?>
<!--Main container start -->
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-account-multiple"></i>
        </span>
        Assigend Subjects
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
                            <th>Subject Code</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $stm = $conn->prepare("SELECT * FROM assign_teacher WHERE teacher_id=?");
                        $stm->execute(array($t_id));
                        $subject_list = $stm->fetchAll(PDO::FETCH_ASSOC);
                        ?>
                        <?php $i = 1;
                        foreach ($subject_list as $subject) :
                            $get_sub_name = getTableData('subject', 'sub_name', $subject['subject_id']);
                            $get_sub_code = getTableData('subject', 'sub_code', $subject['subject_id']);
                        ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $get_sub_name['sub_name'] ?></td>
                                <td><?php echo $get_sub_code['sub_code'] ?></td>
                            </tr>
                        <?php $i++;
                        endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php require_once('footer.php') ?>