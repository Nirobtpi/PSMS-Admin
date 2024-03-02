<?php
require_once('config.php');
$id = $_REQUEST['id'];

DeleteData('assign_teacher', $id);

header("location:teacher-assign-subject.php?success='Data Delete Successfully'");
