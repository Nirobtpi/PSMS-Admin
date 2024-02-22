<?php 
function get_values($value){
    if(isset($_POST[$value])){
        echo $_POST[$value];
    }
}

function tRowCount($tbl,$col,$val){
    global $conn;
    $stm=$conn->prepare("SELECT $col FROM $tbl WHERE $col=?");
    $stm->execute(array($val));
    $res=$stm->rowCount();
    return $res;
}
function getTableData($tbl,$col,$id){
    global $conn;

    $stm=$conn->prepare("SELECT $col FROM $tbl WHERE id=?");
    $stm->execute(array($id));
    $res=$stm->fetch(PDO::FETCH_ASSOC);
    return $res;

}
?>