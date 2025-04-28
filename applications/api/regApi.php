<?php

header  ("Content-type: application/json");

include '../config/conn.php';


// registration API

function  Registration($conn){
 
    extract($_POST);
    $data = array();
    $query = "CALL students_procedure  ('','$name','$phone','$class','$motherName')";
    $result = $conn->query($query);

    if($result){   
        $data = array("status" => true,  "data" => "Successfully registered 😊😜");
    }else{
        $data = array("status" => false, "data" =>  $conn->error);
    }
    echo json_encode($data);
}

// update student API
function  Update_student($conn){
 
    extract($_POST);
    $data = array();
    $query = "CALL students_procedure  ('$id','$name','$phone','$class','$motherName')";
    $result = $conn->query($query);

    if($result){   

        $row = $result->fetch_assoc();

        if($row ['Message'] == "Updated"){
            $data = array("status" => true,  "data" => "Updated successfully😊😜");
        }else{
            $data = array("status" => false, "data" =>  $conn->error);
        }

    }else{
        $data = array("status" => false, "data" =>  $conn->error);
    }
    echo json_encode($data);
}

// fetch data updated API
function updated_Students_info($conn){

    extract($_POST);
    $data = array();
    $array_data = array();
    $query = ("SELECT * FROM `s_reg` WHERE id = '$id'");
    $result = $conn->query($query);

    if($result){
        $row = $result->fetch_assoc();

        $data = array("status" => true,  "data" => $row);
    }else{
        $data =array("status" => false, "data" => $conn->error);
    }
 echo json_encode($data);

}

// delete student API
function Delete_Students_info($conn){

    extract($_POST);
    $data = array();
    $array_data = array();
    $query = ("DELETE FROM `s_reg` WHERE id = '$id'");
    $result = $conn->query($query);

    if($result){
       

        $data = array("status" => true,  "data" => "Deleted successfully 😎😊");
    }else{
        $data = array("status" => false, "data" => $conn->error);
    }
 echo json_encode($data);

}


//get students report
function Get_students_report($conn){

    extract($_POST);
    $data = array();
    $array_data = array();
    $query = "CALL   Get_student_report('$from','$to')";
    $result = $conn->query($query);

    if($result){
        while($row = $result->fetch_assoc()){
            $array_data [] = $row;
        }
        $data = array("status" => true, "data" => $array_data);
    }else{
        $data =array("status" => false, "data" => $conn->error);
    }
 echo json_encode($data);

}



// load data API

function Students_info($conn){

    $data = array();
    $array_data = array();
    $query = ("SELECT `id`, `name`, `phone`, `class`, `motherName` FROM `s_reg` WHERE 1");
    $result = $conn->query($query);

    if($result){
        while($row = $result->fetch_assoc()){
            $array_data [] = $row;
        }
        $data = array("status" => true, "data" => $array_data);
    }else{
        $data =array("status" => false, "data" => $conn->error);
    }
 echo json_encode($data);

}



if(isset($_POST['action'])){
    $action = $_POST['action'];

    $action($conn);
}else{
    echo json_encode(array("status"  => false, "data" => "action raquired..."));
}

?>