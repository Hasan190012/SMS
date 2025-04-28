<?php


header("Content-type: application/json");
include '../config/conn.php';


function register_action($conn){
    extract($_POST);
    $data = array();
    $array_data = array();
    $query = "INSERT INTO `system_actions` (`name`,`ac`,`link_id`) VALUES('$name','$system_action','$link_id')";
    $result = $conn->query($query);
    if($result){

        $data = array("status" => true, "data" => "successfully Registered..");
    }
    else{
        $data = array("status" => false, "data" => $conn->errror);
    }
    echo json_encode($data);
}

function update_actions($conn){
    extract($_POST);
    $data = array();
    $array_data = array();
    $query = "UPDATE `system_actions` SET `name` = '$name',`ac` = '$system_action',`link_id` = '$link_id' WHERE `id` = '$id'";
    $result = $conn->query($query);
    if($result){

        $data = array("status" => true, "data" => "successfully Updated...");
    }
    else{
        $data = array("status" => false, "data" => $conn->errror);
    }
    echo json_encode($data);
}

function delete_actions($conn){
    extract($_POST);
    $data = array();
    $array_data = array();
    $query = "DELETE FROM `system_actions`  WHERE `id` = '$id'";
    $result = $conn->query($query);
    if($result){

        $data = array("status" => true, "data" => "successfully Deleted...🗑");
    }
    else{
        $data = array("status" => false, "data" => $conn->errror);
    }
    echo json_encode($data);
}

function load_actions($conn){

   
    $data = array();
    $array_data  = array();
    $query = "SELECT * FROM `system_actions` WHERE 1";
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
function fetch_actions($conn){

   
    extract($_POST);
    $data = array();
    $array_data  = array();
    $query = "SELECT * FROM `system_actions` WHERE `id` = '$id'";
    $result = $conn->query($query);
    if($result){
     $row = $result->fetch_assoc();
        $data = array("status" => true, "data" => $row);
    }else{
        $data = array("status" => false, "data" => $conn->error);
    }

    echo json_encode($data);
}




if(isset($_POST['action'])){
    $action = $_POST['action'];

    $action($conn);
}else{
    echo json_encode(array("status" => false, "data" => "action required.."));
}


?>