<?php


header ("content-type: application/json");

include '../config/conn.php';

// user registration API with image
function user_reg($conn) {
    // Extract POST data
    extract( $_POST);
    $data = array();
    $error_array = array();
    $new_id = generate($conn);

    // Check if image was uploaded
    if (!isset($_FILES['image']) || empty($_FILES['image']['name'])) {
        $error_array[] = "No image file uploaded";
    } else {
        $file_name = $_FILES['image']['name'];
        $file_type = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $file_size = $_FILES['image']['size'];
        $save_name = $new_id . "." . $file_type; // Generate unique filename

        $allowedImages = ["png", "jpg", "jpeg"];
        $max_size = 8 * 1024 * 1024;
        
        if (!in_array($file_type, $allowedImages)) {
            $error_array[] = "This file type is not allowed";
        }

        if ($file_size > $max_size) {
            $error_array[] = "The file size must be less than " . ($max_size / 1024 / 1024) . "MB";
        }
    }

    if(count($error_array) <= 0 ){

        
    $query = "INSERT INTO `users`(`id`, `username`, `password`, `image`) VALUES ('$new_id','$username',MD5('$password'),'$save_name')";
    $result = $conn->query($query);

    if($result){

        move_uploaded_file($_FILES['image']['tmp_name'], "../uploads/". $save_name);
        $data = array("status" => true, "data" => "User  successfully registered");
    }else{
        $data = array("status" => false, "data" => $conn->error);
    }

    }else{
        $data = array("status" => false, "data" => $error_array);
    }

 
    // Return response
    echo json_encode($data);
}


// new id Generator
function generate($conn){

    $new_id = '';
    $data = array();
    $array_data = array();
    $query = "SELECT * FROM `users` order by users.id DESC limit 1";
    $result = $conn->query($query);
    if($result){
        $num_rows = $result->num_rows;
        if($num_rows > 0){

            $row = $result->fetch_assoc();
            $new_id = ++$row['id'];
        }else{
            $new_id = "USR001";
        }
    }else{
        $data = array("status" => false, "data" => $conn->error);

    }

    return $new_id;
}

//update users API
function update_users($conn){

    extract($_POST);
    $data = array();
    if(!empty($_FILES['image']['tmp_name'])){
        $error_array = array();


        if(!isset($_FILES['image']['name']) || empty($_FILES['image']['name'])){
            $error_array[] = "there is no file uploaded";
        }else{

            $file_name = $_FILES['image']['name'];
            $file_type = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
            $file_size = $_FILES['image']['size'];
            $save_name = $id . "." . $file_type;

            $allowed_images = ["png","jpg","jpeg"];
            $max_size = 15 * 1025 * 1024;

            if(!in_array($file_type,$allowed_images)){
                $error_array[] = "the file type is not allowed";
            }
            if($file_size > $max_size){
                $error_array[] = "the file size must be less than" . ($max_size / 1024 / 1024) . "MB";
            }
        }

        if(count($error_array) <= 0){

            $query = "UPDATE `users` SET `username`='$username',`password`=MD5('$password') where users.id = '$id'";
            $result = $conn->query($query);
            if($result){
                move_uploaded_file($_FILES['image']['tmp_name'], "../uploads/". $save_name);
                $data = array("status" => true, "data" => "Successfully Updated...😎");
            }else{
                $data = array("status" => false, "data" => $conn->error);
            }
        }else{
            $data = array("'status" => false, "data" => $error_array);
        }

    
    }else{

        $query = "UPDATE `users` SET `username`='$username',`password`=MD5('$password') where users.id = '$id'";
        $result = $conn->query($query);
        if($result){
            $data = array("status" => true, "data" => "Successfully Updated...😎");
        }else{
            $data = array("status" => false, "data" => $conn->error);
        }
    }


    echo json_encode($data);
}

function delete_user($conn){
    extract($_POST);
    $data = array();
    $array_data = array();
    $query = ("DELETE FROM `users` WHERE id = '$id'");
    $result = $conn->query($query);
    if($result){
        $data = array("status" => true, "data" => "Successfully Deleted...😍");
    }else{
        $data = array("status" => false, "data" => $conn->error);
    }

    echo json_encode($data);
}





// Load data API
function load_all_users($conn){


    $data = array();
    $array_data = array();
    $query = "SELECT `id`, `username`, `image`, `date` FROM `users`";
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



//fetch user info 
function get_user_info($conn){

    extract($_POST);
    $data = array();
    $array_data = array();
    $query = ("SELECT * FROM `users` where id = '$id' ");
    $result = $conn->query($query);

    if($result){
        $row = $result->fetch_assoc();

        $data = array("status" => true,  "data" => $row);
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