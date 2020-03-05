<?php
include "dbconnect.php";
$msg = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['coursename']) && isset($_POST['deptname']) && isset($_POST["staffname"]) && isset($_POST["subname"])) {
        $cid = $_POST['coursename'];
        $deptid = $_POST['deptname'];
        $staffid = $_POST["staffname"];
        $subid =  $_POST["subname"];

        $sql = "INSERT INTO `allocation` (`cid`, `deptid`, `staffid`, `subjectid`) VALUES ('$cid', '$deptid', '$staffid', '$subid');";
        if ($conn->query($sql) == TRUE) {
            $msg = "data inserted";
        } else {
            $msg = $conn->error;
        }
    } else {
        $msg = "please select all field's";
    }
}
?>
<!doctype html>

<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <label class="navbar-brand" href="#">Automatic TimeTable Generator</label>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item dropdown active">
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
                <li class="nav-item active">
                    <a class="nav-link " href="timetableallocation.php">Timetable Allocation</a>
                </li>
                <li class="nav-item ">
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
            background-image: url("back.jpg ");
            background-repeat: repeat-y;
            background-size: cover;
            width: 100%;
            height: 100%;
        }

        .wrapper {
            margin-top: 50px;
            margin-bottom: 80px;
            width: 600px;
            height: auto;
            border-radius: 10px;
            background-image: url('divback.jpg');
            padding:20px;
            float:right;
            font-weight:bold;
            color: whitesmoke;
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

        function setdetails() {
            set_subjects();
            set_staff();
        }

        function set_subjects() {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (xhttp.readyState == 4 && xhttp.status == 200) {
                    document.getElementById("subname").innerHTML = xhttp.responseText;
                }
            };
            xhttp.open("GET", "set_subject.php?id=" + document.getElementById("deptname").value, true);
            xhttp.send();
        }

        function set_staff() {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (xhttp.readyState == 4 && xhttp.status == 200) {
                    document.getElementById("staffname").innerHTML = xhttp.responseText;
                }
            };
            xhttp.open("GET", "set_staff.php?id=" + document.getElementById("deptname").value, true);
            xhttp.send();
        }
    </script>
</head>

<body>
    <center>
        <div class="container">

        <div class="wrapper">
            <h2>Enter TimeTable Allocation Details</h2>
            <form method="POST" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <div class="container">
                    <table cellpadding="10">
                        <tr>
                            <div class="form-group">
                                <td>
                                    <label for="classid">Select Course</label>
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
                                                echo "<option value='$id'>$name</option>";
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
                                    <label for=" deptname ">Select Department</label>
                                </td>
                                <td>
                                    <select name="deptname" id="deptname" class="form-control" onchange="setdetails()">
                                        <option value="" disabled selected>select a Department</option>
                                    </select>
                                </td>
                            </div>
                        </tr>
                        <tr>
                        <tr>
                            <div class=" form-group ">
                                <td>
                                    <label for=" staffname ">Select Staff</label>
                                </td>
                                <td>
                                    <select name="staffname" id="staffname" class="form-control" on>
                                        <option value="" disabled selected>select a staff</option>
                                    </select>
                                </td>
                            </div>
                        </tr>
                        <tr>
                        <tr>
                            <div class=" form-group ">
                                <td>
                                    <label for=" subname ">Select Subject</label>
                                </td>
                                <td>
                                    <select name="subname" id="subname" class="form-control" on>
                                        <option value="" disabled selected>select a subject</option>
                                    </select>
                                </td>
                            </div>
                        </tr>
                        <tr>
                            <td>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </td>
                            <td>
                                <button type=" reset " class="btn btn-primary ">Reset</button>
                            </td>
                        </tr>

                    </table>
                </div>
        
    
    </form>
        </div>        
    </div>
    </center>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js " integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo " crossorigin="anonymous "></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js " integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1 " crossorigin="anonymous "></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js " integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM " crossorigin="anonymous "></script>
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