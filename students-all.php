<?php
require_once("header.php");
?>
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-account-multiple"></i>
        </span>
        All Students
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
                        <?php
                        $stm = $conn->prepare("SELECT * FROM student ORDER BY id DESC");
                        $stm->execute(array());
                        $allStData = $stm->fetchAll(PDO::FETCH_ASSOC);

                        // print_r($allStData);

                        ?>
                        <tr>
                            <th>
                                #
                            </th>
                            <th>
                                Name
                            </th>
                            <th>
                                Roll
                            </th>
                            <th>
                                Class
                            </th>
                            <th>
                                Mobile
                            </th>
                            <th>
                                Gender
                            </th>

                            <th>
                                Date
                            </th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($allStData as $singleData) : ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $singleData['name'] ?></td>
                                <td><?php echo $singleData['roll'] ?></td>
                                <td><?php echo $singleData['current_class'] ?></td>
                                <td><?php echo $singleData['mobile'] ?></td>
                                <td><?php echo $singleData['gender'] ?></td>
                                <td><?php echo date("Y-m-d", strtotime($singleData['registration_date'])); ?></td>
                                <td><a href="student-edit.php" class="btn btn-sm btn-success">Edit</a> <a href="student-edit.php" class="btn btn-sm btn-warning">View</a> <a href="delete.php" class="btn btn-sm btn-danger">Delete</a></td>
                            </tr>
                        <?php $i++;
                        endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <?php require_once("footer.php") ?>