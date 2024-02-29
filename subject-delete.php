<?php
require_once('config.php');
$id = $_REQUEST['id'];

DeleteData('subject', $id);

header("location:subject-all.php?success='Data Delete Successfully'");
