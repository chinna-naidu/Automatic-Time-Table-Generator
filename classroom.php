<?php
include "dbconnect.php";
$msg = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cid = $_POST['classid'];
    $cname = $_POST['classname'];
    $deptid = $_POST["deptname"];
    $sql = "insert into classroom values('$cid','$cname','$deptid')";
    if ($conn->query($sql) == TRUE) {
        $msg = "data inserted";
    } else {
        $msg = $conn->error;
    }
}

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
                <li class="nav-item ">
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
        center {
            padding-top: 30px;
        }

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
</head>

<body>
    <center>
        <div class="container">
        <div class="wrapper">
            <h2>Enter Classroom Details</h2>
            <form method="POST" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="container">
                    <table cellpadding="10">
                        <tr>
                            <div class="form-group">
                                <td>
                                    <label for="classid">Classroom Id</label>
                                </td>
                                <td>
                                    <input type="text" class="form-control" id="classid" placeholder="Classroom Id" name="classid" required="" autofocus>
                                </td>
                            </div>
                        </tr>
                        <tr>
                            <div class=" form-group ">
                                <td>
                                    <label for=" classname ">Classroom Name</label>
                                </td>
                                <td>
                                    <input type=" text " class=" form-control " id="classname" placeholder=" Classroom Name " name="classname" required="" autofocus>
                                </td>
                            </div>
                        </tr>
                        </tr>
                        <div class="form-group">
                            <td>
                                <label for="deptname">Department Name</label>
                            </td>
                            <td>
                                <select name="deptname" id="deptname" class="form-control">
                                    <?php
                                    $sql = "select deptid,deptname from department;";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $id = $row['deptid'];
                                            $name = $row['deptname'];
                                            echo "<option value='$id'>$name</option>";
                                        }
                                    }

                                    ?>
                                </select>
                            </td>
                        </div>
                        <tr>
                            <td>
                                <button type=" submit " class=" btn btn-primary ">Submit</button>
                            </td>
                            <td>
                                <button type=" reset " class=" btn btn-primary ">Reset</button>
                            </td>
                        </tr>

                    </table>
                </div>
            </form>
        </div>
        </div>
    </center>

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
    <script src=" https://code.jquery.com/jquery-3.3.1.slim.min.js " integrity=" sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo " crossorigin=" anonymous "></script>
    <script src=" https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js " integrity=" sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1 " crossorigin=" anonymous "></script>
    <script src=" https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js " integrity=" sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM " crossorigin=" anonymous "></script>
</body>

</html>