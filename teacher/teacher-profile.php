<?php
require_once('header.php');
$id = $_SESSION['teacher_login']['id'];

$getTeacherData = getAllTableData('teachers', $id);

// print_r($getTeacherData);

?>
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Teacher Profile</h4>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email </th>
                            <th>Mobile</th>
                            <th>Address</th>
                            <th>Gender</th>
                            <th>Photo</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo $getTeacherData["name"] ?></td>
                            <td><?php echo $getTeacherData["email"] ?></td>
                            <td><?php echo $getTeacherData["mobile"] ?></td>
                            <td><?php echo $getTeacherData["address"] ?></td>
                            <td><?php echo $getTeacherData["gender"] ?></td>
                            <td>
                                <?php if($getTeacherData['photo'] !="" ): ?>
                                    <img src="<?php echo $getTeacherData['photo'] ?>" style="width: 50px; height: 50px;" alt="">
                                <?php else: ?>
                                <?php endif; ?>
                            </td>
                            <td><a class="btn btn-sm btn-warning" href="teacher-edit.php?id=<?php echo $getTeacherData['id']; ?>">Edit</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require_once('footer.php') ?>