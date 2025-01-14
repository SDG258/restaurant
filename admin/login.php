<?php include '../connect.php';
session_start();
$errors = [];
if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($email ==  '') {
        $errors['email'] = 'Email cannot be empty';
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Email is not in correct format';
    }
    if ($password == '') {
        $errors['password'] = 'Password cannot be empty';
    }
    if (!$errors) {
        $sqlCheck = "SELECT id, name, email, role FROM admin WHERE email = '$email' AND password = '$password'";

        $query = $conn->query($sqlCheck);

        if ($query->num_rows == 1) {
            $admin = $query->fetch_object();
            if ($admin->role != 'admin') {
                $errors['failed'] = 'Your account does not have access';
            } else {
                $_SESSION['admin_login'] = $admin;
                header('location: index.php');
            }
        } else {
            $errors['failed'] = 'Incorrect account or password';
        }
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Log in</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">

</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href=""><b>Admin</b> cPanel</a>
        </div>
        <div class="login-box-body">
            <p class="login-box-msg">Sign in to start your session</p>
            <?php if ($errors) : ?>
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <?php foreach ($errors as $error) : ?>
                        <li> <?php echo $error; ?></li>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <form action="" method="post">
                <div class="form-group has-feedback">
                    <input type="email" name="email" class="form-control" placeholder="Email">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" name="password" class="form-control" placeholder="Password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-8">
                    </div>
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                    </div>
                </div>
            </form>

            <a href="#">I forgot my password</a><br>
            <a href="register.html" class="text-center">Register a new membership</a>

        </div>
    </div>

</body>

</html>