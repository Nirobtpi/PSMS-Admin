<?php
require_once("header.php");
?>
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-account-multiple"></i>
        </span>
        Assign Subject &nbsp;&nbsp;&nbsp; <a href="teacher-new-assign.php" class="btn btn-success">New Assign</a>
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
                <table class="table table-bordered" id="myTable">
                    <thead>
                        <?php
                        $stm = $conn->prepare("SELECT * FROM assign_teacher ORDER BY id DESC");
                        $stm->execute(array());
                        $allData = $stm->fetchAll(PDO::FETCH_ASSOC);

                        // print_r($allData);

                        ?>
                        <tr>
                            <th>
                                #
                            </th>
                            <th>
                                Teacher Name
                            </th>
                            <th>
                                Subject Name
                            </th>
                            <th>
                                Subject Code
                            </th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;

                        foreach ($allData as $singleData) :
                            $subjectData = getAllTableData('subject', $singleData['subject_id']);
                            $teacherName = getAllTableData('teachers', $singleData['teacher_id']);
                        ?>

                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $teacherName['name'] ?></td>
                                <td><?php echo $subjectData['sub_name'] ?></td>
                                <td><?php echo $subjectData['sub_code']  ?></td>
                                <td><a href="teacher-edit-assign.php?id=<?php echo $singleData['id'] ?>" class="btn btn-sm btn-warning">Edit</a> <a href="teacher-assign-delete.php?id=<?php echo $singleData['id'] ?>" class="btn btn-sm btn-danger">Delete</a></td>
                            </tr>
                        <?php $i++;
                        endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <?php require_once("footer.php") ?>