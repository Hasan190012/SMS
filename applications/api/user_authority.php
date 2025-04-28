<?php


header("Content-type: application/json");

include '../config/conn.php';

function read_system_permissons($conn){

    extract($_POST);
    $data = array();
    $array_data = array();
    $query = "SELECT * FROM `system_authority_view`";
    $result = $conn->query($query);
    if($result){
    while($row = $result->fetch_assoc()){
        $array_data [] = $row;
    }
    $data = array("status" => true, "data" => $array_data);
    }else{
        $data = array("status" => false, "data" => $conn->error);
    }

    echo json_encode($data);
}


if(isset($_POST['action'])){
    $action = $_POST['action'];

    $action($conn);
}else{
    echo json_encode(array("status" => false, "data" => "action requires..."));
}
?>