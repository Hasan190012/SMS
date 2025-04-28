<?php


$conn = new mysqli ("localhost","root","","modernschools");

if($conn->connect_error){

   echo $conn->error;
}

?>