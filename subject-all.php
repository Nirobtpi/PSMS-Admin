<?php
require_once("header.php");
?>
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-account-multiple"></i>
        </span>
        All Subject
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
                        $stm = $conn->prepare("SELECT * FROM subject ORDER BY id DESC");
                        $stm->execute(array());
                        $allData = $stm->fetchAll(PDO::FETCH_ASSOC);

                        // print_r($allData);

                        ?>
                        <tr>
                            <th>
                                #
                            </th>
                            <th>
                                Subject Name
                            </th>
                            <th>
                                Subject Code
                            </th>
                            <th>
                                Subject Type
                            </th>
                            <th>
                                Date
                            </th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($allData as $singleData) : ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $singleData['sub_name'] ?></td>
                                <td><?php echo $singleData['sub_code'] ?></td>
                                <td><?php echo $singleData['sub_type'] ?></td>
                                <td><?php echo date("Y-m-d", strtotime($singleData['created_at'])); ?></td>
                                <td><a href="subject-edit.php?id=<?php echo $singleData['id'] ?>" class="btn btn-sm btn-warning">Edit</a> <a href="subject-delete.php?id=<?php echo $singleData['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are You Sure?')" >Delete</a></td>
                            </tr>
                        <?php $i++;
                        endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <?php require_once("footer.php") ?>