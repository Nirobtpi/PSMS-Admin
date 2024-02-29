<?php
require_once("header.php");
?>
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-account-multiple"></i>
        </span>
        All Class
    </h3>
</div>
<?php if (isset($_REQUEST['success'])) : ?>
    <div class="alert alert-success">
        <?php echo $_REQUEST['success']; ?>
    </div>
<?php endif; ?>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">

        <div class="card">
            <div class="card-body">
                <table class="table table-bordered" id="myTable">
                    <thead>
                        <?php
                        $getData = GetAllData('class');
                        ?>
                        <tr>
                            <th>
                                #
                            </th>
                            <th>
                                Class Name
                            </th>
                            <th>
                                Start Date
                            </th>
                            <th>
                                End Date
                            </th>
                            <th>
                                Subjects
                            </th>
                            <th>
                                Created Date
                            </th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($getData as $singleData) : ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $singleData['class_name'] ?></td>
                                <td><?php echo $singleData['start_date'] ?></td>
                                <td><?php echo $singleData['end_date'] ?></td>
                                <td><?php echo $singleData['subjects'] ?></td>
                                <td><?php echo date("Y-m-d", strtotime($singleData['created_at'])); ?></td>
                                <td><a href="subject-edit.php?id=<?php echo $singleData['id'] ?>" class="btn btn-sm btn-warning">Edit</a> <a href="subject-delete.php?id=<?php echo $singleData['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are You Sure?')">Delete</a></td>
                            </tr>
                        <?php $i++;
                        endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <?php require_once("footer.php") ?>