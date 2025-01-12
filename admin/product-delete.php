<?php
include 'header.php';
$id = !empty($_GET['id']) ? (int)$_GET['id'] : 0;
$error = '';
if ($id) {
    if ($conn->query("DELETE FROM product WHERE id = $id")) {
        header('location: product.php');
    } else {
        $error = 'Delete product fail';
    }
} else {
    $error = 'You do choose product to delete';
}
?>


<div class="content-wrapper">
    <section class="content-header">
        <h1>Delete Product</h1>
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
                <a href="product.php" type="submit" class="btn btn-warning"><i class="fa fa-arrow-left">Back</i></a>
            </div>
        </div>
    </section>
</div>
<?php include "footer.php" ?>