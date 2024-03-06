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
        Assigend Class
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
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $stm = $conn->prepare("SELECT DISTINCT class_name FROM class_routine WHERE teacher_id=?");
                        $stm->execute(array($t_id));
                        $class_list = $stm->fetchAll(PDO::FETCH_ASSOC);

                        // print_r($class_list);
                        ?>
                        <?php $i = 1;
                        foreach ($class_list as $class) :
                            $get_class_name = getTableData('class', 'class_name', $class['class_name']);
                        ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $get_class_name['class_name'] ?></td>
                                <td><a href="class-details.php?id=<?php echo $class['class_name'] ?>" class="btn btn-sm btn-success">View Class Details</a>
                            </tr>
                        <?php $i++;
                        endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php require_once('footer.php') ?>