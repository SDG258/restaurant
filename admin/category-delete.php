<?php
include 'header.php';
$id = !empty($_GET['id']) ? (int)$_GET['id'] : 0;
$error = '';
if ($id) {
    $query = $conn->query("SELECT * FROM product WHERE category_id = '$id'");
    if ($query->num_rows > 0) {
        $error = 'Category has Product. Can not delete!';
    } else {
        if ($conn->query("DELETE FROM category WHERE id = $id")) {
            header('location: category.php');
        } else {
            $error = 'Delete category fail';
        }
    }
} else {
    $error = 'You do choose category to delete';
}
?>


<div class="content-wrapper">
    <section class="content-header">
        <h1>Delete Catagory</h1>
    </section>
    <section class="content">
        <div class="box">
            <div class="borrx-body">
                <?php if ($eor) : ?>
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>Error!</strong> <?php echo $error; ?>
                    </div>
                <?php endif; ?>
                <a href="product.php" type="submit" class="btn btn-warning"><i class="fa fa-arrow-left">Back</i></a>
            </div>
        </div>
    </section>
</div>
<?php include "footer.php" ?>