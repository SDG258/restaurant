<?php
include 'header.php';
$error = '';
if (isset($_POST['name'])) {
    $name = $_POST['name'];
    $status = $_POST['status'];

    if ($name == '') {
        $error = 'Name category can be empty';
    }

    $query = $conn->query("SELECT * FROM category WHERE name = '$name'");
    if ($query->num_rows > 0) {
        $error = 'Name category can be used';
    }

    if (!$error) {
        $sql = "INSERT INTO category(name, status) VALUE ('$name', '$status')";

        if ($conn->query($sql)) {
            header('location: category.php');
            exit();
        } else {
            $error = 'Adding a new name category failed';
        }
    }
}
?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Create Category
        </h1>
    </section>
    <section class="content">
        <div class="box">

            <div class="box-body">
                <?php if ($error) : ?>
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>Error!</strong> <?php echo $error; ?>
                    </div>
                <?php endif; ?>
                <form action="" method="POST" role="form">
                    <div class="form-group">
                        <label for="">Name Category</label>
                        <input type="text" class="form-control" name="name" placeholder="Input Name">
                    </div>

                    <div class="form-group">
                        <label for="">Name Category</label>

                        <div class="radio">
                            <label>
                                <input type="radio" name="status" value="1" checked>
                                Show
                            </label>
                            <label>
                                <input type="radio" name="status" value="0">
                                Hiddent
                            </label>
                        </div>
                    </div>

                    <a href="category.php" type="submit" class="btn btn-success"><i class="fa fa-arrow-left">Back</i></a>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>

                </form>

            </div>
        </div>

    </section>
</div>
<?php include "footer.php" ?>