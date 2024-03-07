<?php
require_once('../config.php');

if (isset($_POST['class_id'])) {
    echo $_POST['teacher_id'];

    // $stm = $conn->prepare("SELECT subjects FROM class WHERE id=?");
    // $stm->execute(array($_POST['class_id']));
    // $subject_ides = $stm->fetch(PDO::FETCH_ASSOC);
    // $subject_ides = $subject_ides['subjects'];

    // // echo $subject_ides;
    // $single_sub = json_decode($subject_ides);
    

    // $get_subject_option = "";
    // foreach ($single_sub as $subject) {
    //     $sin_sub = getAllTableData('subject', $subject);
    //     $sin_subjects = $sin_sub['sub_name'];
    //     $get_subject_option .= "<option value='$subject'>" . " $sin_subjects" . "</option>";

    //     // $get_sub_list[][$subject]=$sin_sub['sub_name'];

    // }
    // echo ($get_subject_option);
}
