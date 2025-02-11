<?php
include 'header.php';
$errors = [];
$id = $admin->id;

if (isset($_POST['old_password'])) {
    $old_password = $_POST['old_password'];
    $email = $_POST['email'];
    $name = $_POST['name'];

    if ($email ==  '') {
        $errors['email'] = 'Email cannot be empty';
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Email is not in correct format';
    }

    if ($name == '') {
        $errors['old_password'] = 'You must enter your name.';
    }

    if ($old_password == '') {
        $errors['old_password'] = 'You must enter your old password.';
    }

    if (!$errors) {
        $sqlCheck = "SELECT email FROM admin WHERE email = '$email' AND id != '$id'";

        $query = $conn->query($sqlCheck);

        if ($query->num_rows == 1) {
            $errors['email'] = 'This email is already in use, please choose another email';
        } else {
            $sqlUpdate = "UPDATE admin SET name = '$name', email = '$email' WHERE id = '$id'";
            if ($conn->query($sqlUpdate)) {
                unset($_SESSION['admin_login']);
                header('location: login.php');
                exit;
            } else {
                $errors['failed'] = 'Error, please try again';
            }
        }
    }
}
?>

?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Update Profile
        </h1>
    </section>
    <section class="content">
        <div class="box">

            <div class="box-body">
                <?php if ($errors) : ?>
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <?php foreach ($errors as $error) : ?>
                            <li> <?php echo $error; ?></li>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                <form action="" method="POST" role="form">
                    <div class="form-group">
                        <label for="">Full Name</label>
                        <input type="text" class="form-control" name="name" value="<?php echo $admin->name; ?>" placeholder="Full Name">
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" class="form-control" name="email" value="<?php echo $admin->email; ?>" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for="">Current Password</label>
                        <input type="password" class="form-control" name="old_password" placeholder="Current Password">
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-user"></i> Change Profile</button>
                </form>

            </div>
        </div>
    </section>
</div>
<?php include "footer.php" ?>