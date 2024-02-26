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

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered" id="myTable">
                    <thead>
                        <?php
                        $stm = $conn->prepare("SELECT * FROM teachers ORDER BY id DESC");
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
                        foreach ($allData as $singleData) : ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $singleData['name'] ?></td>
                                <td><?php echo $singleData['email'] ?></td>
                                <td><?php echo $singleData['mobile'] ?></td>
                                <td><?php echo $singleData['gender'] ?></td>
                                <td><?php echo date("Y-m-d", strtotime($singleData['created_at'])); ?></td>
                                <td><a href="" class="btn btn-sm btn-warning">Edit</a> <a href="" class="btn btn-sm btn-danger">Delete</a></td>
                            </tr>
                        <?php $i++;
                        endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <?php require_once("footer.php") ?>