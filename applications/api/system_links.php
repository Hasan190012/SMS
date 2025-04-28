<?php


header ("Conten-type: application/json");

include  '../config/conn.php';

function  read_all_system_links(){
    $data = array();
    $array_data = array();
    $search_result = glob('../view/*.php');
    foreach($search_result as $sr){
        $pure_link = explode("/",$sr);
        $array_data[] = $pure_link[2];
    }

    if(count($search_result) > 0){
        $data = array("status" => true, "data" => $array_data);
    }else{
        $data = array("status" => false, "data" => "not found");
    }

    echo json_encode($data);
}


function register_link($conn){
    extract($_POST);
    $data = array();
    $array_data = array();
    $query = "INSERT INTO `system_links` (`name`,`link`,`category_id`) VALUES('$name','$link','$category_id')";
    $result = $conn->query($query);
    if($result){

        $data = array("status" => true, "data" => "successfully Registered..");
    }
    else{
        $data = array("status" => false, "data" => $conn->errror);
    }
    echo json_encode($data);
}

function load_system_db_links($conn){
    $data =  array();
    $array_data = array();
    $query = "SELECT * FROM `system_links` WHERE 1";
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
function update_link($conn){
    extract($_POST);
    $data = array();
    $array_data = array();
    $query = ("UPDATE `system_links` SET `name`='$name',`link`='$link',`category_id`='$category_id' WHERE `id` = '$id'");
    $result =  $conn->query($query);
    if($result){
        $data = array("status" => true, "data" =>  "Successfully Updated...✅");
    }else{
        $data = array("status" => false, "data" => $conn->error);
    }
    echo json_encode($data);
}

function fetch_link_info($conn){
    extract($_POST);
    $data = array();
    $array_data = array();
    $query = "SELECT * FROM `system_links` where `id` = '$id'";
    $result = $conn->query($query);
    if($result){
        $row = $result->fetch_assoc();
        $data = array("status" => true, "data" => $row);
    }else{
        $data = array("status" => false, "data" => $conn->error);
    }

    echo json_encode($data);
}

function delete_link($conn){
    extract($_POST);
    $data = array();
    $query = "DELETE FROM `system_links` where `id` = '$id'";
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

    $action ($conn);
}else{
    echo json_encode(array("status" => false, "data" => "action required..."));
}
?>