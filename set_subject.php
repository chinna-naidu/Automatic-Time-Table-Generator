<?php
include "dbconnect.php";
$id = $_GET["id"];
$sql = "select subjectid,subjectname from subject where deptid='$id';";
$result = $conn->query($sql);
echo " <option  disabled selected>select a subject</option>";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $id = $row['subjectid'];
        $name = $row['subjectname'];
        echo "<option value='$id'>$name</option>";
    }
}
