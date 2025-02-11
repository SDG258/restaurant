<?php
include 'header.php';
$errors = [];
$id = $admin->id;

if (isset($_POST['old_password'])) {
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_new_password = $_POST['confirm_new_password'];

    // Kiểm tra mật khẩu cũ
    if ($old_password == '') {
        $errors['old_password'] = 'You must enter your old password.';
    }

    // Kiểm tra mật khẩu mới
    if ($new_password == '') {
        $errors['new_password'] = 'You must enter your new password.';
    }

    // Kiểm tra xác nhận mật khẩu mới
    if ($confirm_new_password == '') {
        $errors['confirm_new_password'] = 'You must confirm your new password.';
    } elseif ($new_password != $confirm_new_password) {
        $errors['confirm_new_password'] = 'Confirm incorrect password!';
    }

    // Nếu không có lỗi, kiểm tra mật khẩu cũ trong cơ sở dữ liệu
    if (count($errors) == 0) {
        $sqlCheck = "SELECT password FROM admin WHERE id = '$id'";
        $query = $conn->query($sqlCheck);

        if ($query->num_rows == 0) {
            $errors['failed'] = 'Old password is incorrect';
        } else {
            $row = $query->fetch_assoc();
            // So sánh mật khẩu cũ
            if ($row['password'] != $old_password) {
                $errors['failed'] = 'Old password is incorrect';
            }
        }
    }

    // Nếu không có lỗi, tiến hành cập nhật mật khẩu mới
    if (count($errors) == 0) {
        // Kiểm tra lại nếu mật khẩu mới không trống
        if ($new_password != '') {
            $sqlUpdate = "UPDATE admin SET password = '$new_password' WHERE id = '$id'";
            if ($conn->query($sqlUpdate)) {
                unset($_SESSION['admin_login']);
                header('location: login.php');
                exit;
            } else {
                $errors['failed'] = 'Error, please try again';
            }
        } else {
            $errors['failed'] = 'New password cannot be empty.';
        }
    }
}
?>

?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Change Your Password
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
                        <label for="">Current Password</label>
                        <input type="password" class="form-control" name="old_password" id="" placeholder="Current Password">
                    </div>
                    <div class="form-group">
                        <label for="">New Password</label>
                        <input type="password" class="form-control" name="new_password" id="" placeholder="New Password">
                    </div>
                    <div class="form-group">
                        <label for="">Confirm New Password</label>
                        <input type="password" class="form-control" name="confirm_new_password" id="" placeholder="Confirm New Password">
                    </div>



                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Change Password</button>
                </form>

            </div>
        </div>
    </section>
</div>
<?php include "footer.php" ?>