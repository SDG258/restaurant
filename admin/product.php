<?php
include 'header.php';
$cats = $conn->query("SELECT id, name FROM category ORDER BY name ASC");

$data = $conn->query("SELECT product.*, category.name AS cat_name FROM product JOIN category ON category.id = category_id ORDER BY product.id DESC");
$key = isset($_GET['search_key']) ? $_GET['search_key'] : '';
$cat = isset($_GET['cat']) ? $_GET['cat'] : '';

if (!empty($key) && empty($cat)) {
    $key = $_GET['search_key'];
    $data = $conn->query("SELECT product.*, category.name AS cat_name FROM product JOIN category ON 
    category.id = category_id WHERE product.name LIKE '%$key%' ORDER BY product.id DESC");
} else if (empty($key) && !empty($cat)) {
    $key = $_GET['search_key'];
    $data = $conn->query("SELECT product.*, category.name AS cat_name FROM product JOIN category ON 
    category.id = category_id WHERE product.category_id = $cat ORDER BY product.id DESC");
} else if (!empty($key) && !empty($cat)) {
    $key = $_GET['search_key'];
    $data = $conn->query("SELECT product.*, category.name AS cat_name FROM product JOIN category ON 
    category.id = category_id WHERE product.name LIKE '%$key%' AND product.category_id = $cat ORDER BY product.id DESC");
}
?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Product</h1>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-body">

                <form action=" " method="GET" class="form-inline">
                    <div class="form-group">
                        <input class="form-control" name="search_key" placeholder="Input field">
                    </div>
                    <div class="form-group">
                        <select name="cat" class="form-control">
                            <option value="">choose value</option>
                            <?php while ($cat = $cats->fetch_object()) : ?>
                                <option value="<?php echo $cat->id; ?>"><?php echo $cat->name; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                    <a href="product-create.php" type="submit" class="btn btn-success"><i class="fa fa-plus">Add new</i></a>
                </form>

                <!-- Hiển thị thông báo lỗi nếu không tìm thấy kết quả -->
                <?php if (isset($error)) : ?>
                    <div class="alert alert-danger">
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Price/Sale</th>
                            <th>Status</th>
                            <th>Image</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($pro = $data->fetch_object()) : ?>
                            <tr>
                                <td><?php echo $pro->id; ?> </td>
                                <td><?php echo $pro->name; ?></td>
                                <td><?php echo $pro->cat_name; ?></td>
                                <td>
                                    <?php echo $pro->price; ?>
                                    <span class="badge"><?php echo $pro->sale; ?>%</span>

                                </td>
                                <td><?php echo $pro->status == '1' ? 'Show' : 'Hidden'; ?></td>
                                <td>
                                    <img src="../uploads/<?php echo $pro->image; ?>" width="40">
                                </td>
                                <td class="text-right">
                                    <a href="product-edit.php?id=<?php echo $pro->id; ?>" class="btn btn-sm btn-primary"> <i class="fa fa-edit"></i>Edit</a>
                                    <a onclick="return confirm('Do you have delete <?php echo $pro->name; ?> ?')" href="product-delete.php?id=<?php echo $pro->id; ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Del</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>

<?php include "footer.php"; ?>