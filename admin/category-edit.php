<?php
include 'header.php';
$id = !empty($_GET['id']) ? (int)$_GET['id'] : 0;
$error = '';
if ($id) {
    $sql = $conn->query("SELECT * FROM  category WHERE id = $id");
    $cat = $sql->fetch_object();
    if (isset($_POST['name'])) {
        $name = $_POST['name'];
        $status = $_POST['status'];

        if ($name == '') {
            $error = 'Name category can be empty';
        }

        if (!$error) {
            $sql = "UPDATE category  SET name= '$name', status= '$status' WHERE id = $id";

            if ($conn->query($sql)) {
                header('location: category.php');
                exit();
            } else {
                $error = 'Updating a category failed';
            }
        }
    }
} else {
    $error = 'You do not choose name category with edit?';
}
?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Edit Category
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
                <?php else : ?>
                    <form action="" method="POST" role="form">
                        <div class="form-group">
                            <label for="">Name Category</label>
                            <input type="text" value="<?php echo $cat->name; ?>" class="form-control" name="name" placeholder="Input Name">
                        </div>

                        <div class="form-group">
                            <label for="">Name Category</label>

                            <div class="radio">
                                <label>
                                    <input type="radio" name="status" value="1" <?php echo $cat->status == 1 ? 'checked' : ''; ?>>
                                    Show
                                </label>
                                <label>
                                    <input type="radio" name="status" value="0" <?php echo $cat->status == 0 ? 'checked' : ''; ?>>
                                    Hiddent
                                </label>
                            </div>
                        </div>

                        <a href="category.php" type="submit" class="btn btn-success"><i class="fa fa-arrow-left">Back</i></a>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>

                    </form>
                <?php endif; ?>

            </div>
        </div>

    </section>
</div>
<?php include "footer.php" ?>