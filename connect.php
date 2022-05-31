<?php
$conn = mysqli_connect('localhost','root','','cse236');
if($conn==false){
    die('ERROR : Could not connect.'.mysqli_connect_error());
}
?>