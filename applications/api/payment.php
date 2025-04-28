<?php

header ("Content-type: application/json");

include '../config/conn.php';


function register_payment($conn){
    extract($_POST);
    $data = array();
    $array_data = array();
    $query = "CALL payment_reg ('$id','$feeType','$amountPaid','$paymentStatus')";
    $result = $conn->query($query);
    if($result){
        $row = $result->fetch_assoc();
        if($row['Message'] == 'Registered'){
            $data = array("status" => true, "data" => "Payment Registered..💸😊");
        }
    }else{
        $data = array("status" => false, "data" => $conn->errror);
    }
    echo json_encode($data);
}

function load_payments($conn){
    $data = array();
    $array_data = array();
    $query = "SELECT `paymentId`,`student_id`,`feeType`,`amountPaid`,`paymentStatus`,`BlanceRemain` FROM `payment` WHERE 1";
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

function fecth_payment_Data($conn){
    extract($_POST);
    $data = array();
    $array_data = array();
    $query = "SELECT * FROM `payment` where `paymentId` = '$paymentId'";
    $result = $conn->query($query);
    if($result){
        $row = $result->fetch_assoc();
        $data = array("status" => true, "data" => $row);
    }else{
        $data = array("status" => false, "data" => $conn->error);
    }

    echo json_encode($data);
}

function update_payment($conn){
    extract($_POST);
    $data = array();
    $array_data = array();
    $query = "UPDATE `payment` SET `student_id`='$id',`feeType`='$feeType',`amountPaid`='$amountPaid',`paymentStatus`='$paymentStatus' where `paymentId` = '$paymentId'";
    $result = $conn->query($query);
    if($result){
        $data = array("status" => true, "data" => "Successfully Updated...✅💲");

    }else{
        $data = array("status" => true, "data" => $conn->error);
    }
    echo json_encode($data);
}

function delete_payment($conn){
    extract($_POST);
    $data = array();
    $query = "DELETE FROM `payment` where `paymentId` = '$paymentId'";
    $result = $conn->query($query);
    if($result ){
        $data = array("status" => true, "data" => "Successfully Deleted");
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