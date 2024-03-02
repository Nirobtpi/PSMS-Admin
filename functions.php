<?php
function get_values($value)
{
    if (isset($_POST[$value])) {
        echo $_POST[$value];
    }
}

function tRowCount($tbl, $col, $val)
{
    global $conn;
    $stm = $conn->prepare("SELECT $col FROM $tbl WHERE $col=?");
    $stm->execute(array($val));
    $res = $stm->rowCount();
    return $res;
}
function getTableData($tbl, $col, $id)
{
    global $conn;

    $stm = $conn->prepare("SELECT $col FROM $tbl WHERE id=?");
    $stm->execute(array($id));
    $res = $stm->fetch(PDO::FETCH_ASSOC);
    return $res;
}
function getAllTableData($tbl, $id)
{
    global $conn;

    $stm = $conn->prepare("SELECT * FROM $tbl WHERE id=?");
    $stm->execute(array($id));
    $res = $stm->fetch(PDO::FETCH_ASSOC);
    return $res;
}

function DeleteData($tbl, $id)
{
    global $conn;

    $stm = $conn->prepare("DELETE FROM $tbl WHERE id=? ");
    $res = $stm->execute(array($id));
    return $res;
}
function GetAllData($tbl)
{
    global $conn;
    $stm = $conn->prepare("SELECT * FROM $tbl ORDER BY id DESC");
    $stm->execute(array());
    $allData = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $allData;
}
function AlltableData($tbl)
{
    global $conn;
    $stm = $conn->prepare("SELECT * FROM $tbl");
    $stm->execute(array());
    $allData = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $allData;
}

function getSubjectName($id)
{
    global $conn;
    $stm = $conn->prepare("SELECT sub_name,sub_code FROM subject WHERE id=?");
    $stm->execute(array($id));
    $res = $stm->fetch(PDO::FETCH_ASSOC);

    return $res;
}
