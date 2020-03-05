<?php
    $host= "localhost";
    $user= "root";
    $pass="";
    $db= "timetable";
    $conn = new mysqli($host,$user,$pass,$db);
    if($conn->connect_error) {
        die("connection failed: " . $conn->connect_error);
    } else {
        #echo "<script>alert('database connected')</script>";
    } 
?>