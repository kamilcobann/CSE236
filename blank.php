<?php

session_start();
require_once('connect.php');

 $sql = "SELECT UID,firstname,lastname,email,licence,gender,birthday,phone,isactive FROM users";
 $result = $conn->query($sql);
 if($result-> num_rows > 0){
   while($row = $result->fetch_assoc()){
    echo $row['UID'];
    echo '<br>';
    echo $row['firstname'];
    echo '<br>';
    echo $row['lastname'];
    echo '<br>';
    echo $row['email'];
    echo '<br>';
    echo $row['gender'];
    echo '<br>';
    echo $row['birthday'];
    echo '<br>';
    echo $row['phone'];
    echo '<br>';
    echo $row['isactive'];
    echo '<br>';



   }
 }
 
 ?>