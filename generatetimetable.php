<?php
include "dbconnect.php";
$msg = "";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <label class="navbar-brand" href="#">Automatic TimeTable Generator</label>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Add Details
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="course.php">Add Course</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="department.php">Add Department</a>
                        <div class="dropdown-divider "></div>
                        <a class="dropdown-item " href="staff.php">Add Staff</a>
                        <div class="dropdown-divider "></div>
                        <a class="dropdown-item " href="subject.php">Add subject</a>
                        <div class="dropdown-divider "></div>
                        <a class="dropdown-item " href="classroom.php">Add Classroom</a>
                    </div>
                </li>
                <li class="nav-item ">
                    <a class="nav-link " href="timetableallocation.php">Timetable Allocation</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link " href="generatetimetable.php">Generate Timetable</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link " href="login.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
    <style>
        body,
        html {
            background-image: url("back1.jpg ");
            background-repeat: repeat-y;
            background-size: cover;
            width: 100%;
            height: 100%;
        }

        .wrapper {
            margin-top: 50px;
            margin-bottom: 80px;
            width: 1010px;
            height: auto;
            border: 2px solid gray;
            border-radius: 10px;
            background-image: url(wood1.jpg);
            padding: 20px;
        }

        #tab tr td {
            font-family: 'Times New Roman', Times, serif;
            font-size: 15px;
            font-weight: bold;
            background-color: bisque;
        }

        #tab tr td:hover {
            background-color: grey;
            color: whitesmoke;
        }

        #tab tr th {
            font-weight: bold;
            background-color: chocolate;
        }
    </style>
    <script>
        function set_department() {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (xhttp.readyState == 4 && xhttp.status == 200) {
                    document.getElementById("deptname").innerHTML = xhttp.responseText;
                }
            };
            xhttp.open("GET", "set_department.php?cid=" + document.getElementById("coursename").value, true);
            xhttp.send();
        }
    </script>
</head>

<body>
    <center>
        <div class="wrapper border border-dark">
            <form method="POST" action="generatetimetable.php">
                <div class="container">
                    <table cellpadding="10">
                        <tr>
                            <div class="form-group">
                                <td>
                                    <label for="classid"><b>Select Course</b></label>
                                </td>
                                <td>
                                    <select name="coursename" id="coursename" class="form-control" onchange="set_department()">
                                        <option value="" disabled selected>select a course</option>
                                        <?php
                                        $sql = "select * from course;";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                $id = $row['courseid'];
                                                $name = $row['coursename'];
                                                if($_POST['coursename'] && $id == $_POST['coursename']) {
                                                    echo "<option value='$id' selected>$name</option>";
                                                } else {
                                                    echo "<option value='$id'>$name</option>";
                                                }
                                            }
                                        }
                                        ?>
                                    </select>
                                </td>
                            </div>
                        </tr>
                        <tr>
                            <div class=" form-group ">
                                <td>
                                    <label for=" deptname "><b>Select Department</b></label>
                                </td>
                                <td>
                                    <select name="deptname" id="deptname" class="form-control">
                                        <option value="" disabled selected>select a Department</option>
                                    </select>
                                </td>
                            </div>
                        </tr>
                    </table>
                    <div class="container">
                        <center>
                            <button type="submit" class=" btn btn-primary" name="generate" value="generate">Generate TimeTable</button>
                        </center>
                    </div>
                </div>
    </center>
    </form>
    <?php
    if (isset($_POST["generate"]) && isset($_POST["deptname"])) {
        $dept = $_POST["deptname"];
        $sql = "SELECT  `deptname` FROM `department` WHERE deptid = '$dept'";
        $result = $conn->query($sql);
        if($result->num_rows > 0) {
            while($row=$result->fetch_assoc()) {
                $dname = $row['deptname'];
            }
        }
        $dname = strtoupper($dname);
       
        $sql = "SELECT s.staffname,b.subjectname from staff as s,subject as b ,allocation as a where s.staffid = a.staffid and b.subjectid = a.subjectid and a.deptid = '$dept'";
        $arr = array();
        $result = $conn->query($sql);
        if ($result->num_rows > 0 && $result->num_rows >= 5) {
            while ($row = $result->fetch_assoc()) {
                $staff = $row['staffname'];
                $sub = $row['subjectname'];
                if (key_exists($staff, $arr)) {
                    $arr[$staff][] = $sub;
                } else {
                    $arr[$staff] = array($sub);
                }
            }

            $class = array();
            $result = $conn->query("select * from classroom where deptid='$dept'");
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $cname = $row['classname'];
                    $class[] = $cname;
                }
            }
            function get_pair($arr, $keys)
            {
                $ind = rand(0, count($arr) - 1);
                $val = $keys[$ind] . "-" . $arr[$keys[$ind]][rand(0, count($arr[$keys[$ind]]) - 1)];
                return $val;
            }
            function exists($val, $timetables, $tab, $i, $j)
            {
                if ($tab == 0) {
                    return true;
                }
                $val = explode("-", $val)[0];
                for ($p = $tab - 1; $p >= 0; $p--) {
                    if ($val == explode("-", $timetables[$p][$i][$j])[0]) {
                        return false;
                    }
                }
                return true;
            }
            $keys =  array_keys($arr);
            $timetables = array();
            $single_table = array();
            $days = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");

            for ($tab = 0; $tab < count($class); $tab++) {
                $single_table = array();
                for ($i = 0; $i < 6; $i++) {
                    $temp = array();
                    for ($j = 0; $j < 7;) {
                        $val = get_pair($arr, $keys);
                        if (exists($val, $timetables, $tab, $i, $j)) {
                            $temp[] = $val;
                            $j++;
                        }
                    }
                    $single_table[] = $temp;
                }
                $timetables[] = $single_table;
            }
            $classind = 0;
        echo "<div class='container wrapper border border-dark'><center><h1>The Time Tables For $dname Department</h1></center></div>";
            foreach ($timetables as $timetable) {
                echo "<div class='container wrapper border border-dark'><table class='border border-dark' id='tab'>";
                echo "<center><h3>TimeTable for $class[$classind]</h3></center>";
                $k = 0;
                foreach ($timetable as $vals) {
                    echo "<tr><th class='border border-dark'>$days[$k]</th>";
                    foreach ($vals as $i) {
                        echo "<td class='border border-dark'>$i</td>";
                    }
                    echo "</tr>";
                    $k++;
                }
                $classind++;
                echo "</table></div>";
            }
        } else {
            $msg = "insert more data about staff and subjects";
        }
    }
    ?>
    </div>
    </center>

    <script src=" https://code.jquery.com/jquery-3.3.1.slim.min.js " integrity=" sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo " crossorigin=" anonymous "></script>
    <script src=" https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js " integrity=" sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1 " crossorigin=" anonymous "></script>
    <script src=" https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js " integrity=" sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM " crossorigin=" anonymous "></script>
    <script>
        var c = 0;

        function check() {
            var msg = <?php echo json_encode($msg); ?>;
            if (msg != "" && c == 0) {
                alert(msg);
                c = 1;
            }
        }
        setInterval(check, 100);
    </script>
</body>

</html>