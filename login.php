<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $logins = array("chinna" => "darknight", "mani" => "redhood", "admin" => "login");
    $msg = "";
    if (array_key_exists($user, $logins)) {
        if ($logins[$user] == $pass) {
            header("refresh:2,url=timetableallocation.php");
        } else {
            $msg = 'Invalid Password';
        }
    } else {
        $msg = 'Invalid Username';
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
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tangerine">
    <style type="text/css">
        @import "bourbon";

        body {
            background-image: url("time.jpg");
            background-repeat: repeat-y;
            background-size: cover;
            width: 100%;
            height: 100%;
        }

        .wrapper {
            margin-top: 30px;
            margin-bottom: 80px;
        }

        .form-signin {
            max-width: 400px;
            padding: 15px 35px 45px;
            margin: 0 auto;
            background-color: lightgray;
            border: 4px solid black;
        }

        .form-signin-heading,
        .checkbox {
            margin-bottom: 30px;
        }

        .checkbox {
            font-weight: normal;
        }

        .form-control {
            position: relative;
            font-size: 16px;
            height: auto;
            padding: 10px;
        }

        input[type="text"] {
            margin-bottom: -1px;
            border-bottom-left-radius: 0;
            border-bottom-right-radius: 0;
        }

        input[type="password"] {
            margin-bottom: 20px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }
    </style>


</head>

<body>
    <h1 style="font-family:  Tangerine , serif;font-size: 100px;text-align: center;font-weight: bold;">Automatic TimeTable Generator</h1>
    <div class="wrapper">
        <form class="form-signin" method="POST" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <h2 class="form-signin-heading">Please login</h2>
            <input type="text" class="form-control" name="username" placeholder="username" required="" autofocus="" />
            <input type="password" class="form-control" name="password" placeholder="Password" required="" autofocus="/>
            <label class="checkbox">
                <input type="checkbox" value="remember-me" id="rememberMe" name="rememberMe"> Remember me
            </label>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
        </form>
    </div>
    <script>
        var c = 0;

        function check() {
            var msg = <?php echo json_encode($msg); ?>;
            if (msg != "" && c == 0) {
                alert(msg);
                c = 1;
            }
        }
        setInterval(check, 100)
    </script>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>