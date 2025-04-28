<?php

header ("Content-type: application/json");
include '../config/conn.php';


function cotegory_Regsitration($conn){
    extract($_POST);
    $data = array();
    $array_data = array();
    $query = "INSERT INTO `category`(`name`, `icon`, `role`) VALUES ('$name','$icon','$role')";
    $result = $conn->query($query);
    if($result){
        $data = array("status" => true, "data" => "Successfully Registred..😍");
    }else{
        $data = array("status" => false, "data" => $conn->error);
    }

    echo json_encode($data);
}


function load_category($conn){
    $data =  array();
    $array_data = array();
    $query = "SELECT `id`, `name`, `icon`, `role`, `date` FROM `category` WHERE 1";
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

function fetch_category_info($conn){
    extract($_POST);
    $data = array();
    $array_data = array();
    $query = "SELECT * FROM `category` where `id` = '$id'";
    $result = $conn->query($query);
    if($result){
        $row = $result->fetch_assoc();
        $data = array("status" => true, "data" => $row);
    }else{
        $data = array("status" => false, "data" => $conn->error);
    }

    echo json_encode($data);
}

function update_category($conn){
    extract($_POST);
    $data = array();
    $array_data = array();
    $query = ("UPDATE `category` SET `name`='$name',`icon`='$icon',`role`='$role' WHERE `id` = '$id'");
    $result =  $conn->query($query);
    if($result){
        $data = array("status" => true, "data" =>  "Successfully Updated...✅");
    }else{
        $data = array("status" => false, "data" => $conn->error);
    }
    echo json_encode($data);
}

function delete_category($conn){
    extract($_POST);
    $data = array();
    $query = "DELETE FROM `category` where `id` = '$id'";
    $result = $conn->query($query);
    if($result ){
        $data = array("status" => true, "data" => "Successfully Deleted...🗑");
    }else{
        $data = array("status" => false, "data" => $conn->error);
    }

    echo json_encode($data);
    
}


if(isset($_POST['action'])){
    $action = $_POST['action'];

    $action($conn);
}else{
    echo json_encode(array("status" => false, "data" => "action required..."));
}

?>