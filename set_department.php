<?php
include "dbconnect.php";
$cid = $_GET["cid"];
$sql = "select deptid,deptname from department where courseid='$cid';";
$result = $conn->query($sql);
echo " <option  disabled selected>select a department</option>";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $id = $row['deptid'];
        $name = $row['deptname'];
        echo "<option value='$id'>$name</option>";
        }
    }
?>