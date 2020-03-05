<?php
include "dbconnect.php";
$id = $_GET["id"];
$sql = "select staffid,staffname from staff where deptid='$id';";
$result = $conn->query($sql);
echo " <option  disabled selected>select a staff</option>";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $id = $row['staffid'];
        $name = $row['staffname'];
        echo "<option value='$id'>$name</option>";
        }
    }
