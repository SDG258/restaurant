<?php
include 'header.php';
$id = !empty($_GET['id']) ? (int)($_GET['id']) : 0;
$query = $conn->query("SELECT * FROM product WHERE id = $id");
$pro = $query->fetch_object();
$errors = [];
$image = $pro->image;
$cats = $conn->query("SELECT id, name FROM category ORDER BY name ASC");

if (!empty($_FILES['img']['name'])) {
    $image = time() . '-' . $_FILES['img']['name'];
    $tmp_name = $_FILES['img']['tmp_name'];

    move_uploaded_file($tmp_name, '../uploads/' . $image);
}
if (isset($_POST['name'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $sale = !empty($_POST['sale']) ? $_POST['sale'] : 0;
    $category_id = $_POST['category_id'];
    $desciption = $_POST['desciption'];
    $status = $_POST['status'];

    if ($name == '') {
        $errors['name'] = 'Name product can be empty';
    }
    if ($price == '') {
        $errors['price'] = 'Price can be empty';
    } elseif (!is_numeric($price)) {
        $errors['price'] = 'Price can be number';
    }
    if ($sale != '' && !is_numeric($sale)) {
        $errors['sale'] = 'Sale can be number';
    } elseif ($sale < 0 || $sale > 100) {
        $errors['sale'] = 'Sale rate must be between 1 and 100';
    }
    if ($desciption == '') {
        $errors['desciption'] = 'Description can be empty';
    }
    if ($category_id == '') {
        $errors['category_id'] = 'Category can be empty';
    }
    if ($image == '') {
        $errors['image'] = 'Image can be empty';
    }
    $query = $conn->query("SELECT * FROM product WHERE name = '$name' AND id != $id");
    if ($query->num_rows > 0) {
        $errors['name'] = 'Name product can be used';
    }

    if (!$errors) {
        $sql = "UPDATE product SET name = '$name', price = '$price', sale = '$sale', image = '$image', category_id = '$category_id', desciption = '$desciption', status = '$status' WHERE id =$id";
        if ($conn->query($sql)) {
            header('location: product.php');
            exit();
        } else {
            $errors['failed'] = 'Adding a new name product failed';
        }
    }
}
?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Create Product
        </h1>
    </section>
    <section class="content">
        <div class="box">

            <div class="box-body">
                <?php if ($errors) : ?>
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <?php foreach ($errors as $error) : ?>
                            <li><?php echo $error; ?></li>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-8">

                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label for="">Name Product</label>
                                        <input type="text" value="<?php echo $pro->name; ?>" class="form-control" name="name" placeholder="Input Name">
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label for="">Desciption Product</label>
                                        <textarea name="desciption" class="form-control desciption" rows="8" placeholder="Input desciption Product"><?php echo $pro->desciption; ?></textarea>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-4">

                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label for="">Choose Category</label>
                                        <select name="category_id" class="form-control">
                                            <option value="">choose value</option>
                                            <?php while ($cat = $cats->fetch_object()) : ?>
                                                <option <?php echo $cat->id == $pro->category_id ? 'selected' : ''; ?> value="<?php echo $cat->id; ?>"><?php echo $cat->name; ?></option>
                                            <?php endwhile; ?>
                                        </select>

                                    </div>
                                    <div class="form-group">
                                        <label for="">Price</label>
                                        <input type="number" class="form-control" value="<?php echo $pro->price; ?>" name="price" placeholder="Input Price">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Sale</label>
                                        <input type="number" class="form-control" value="<?php echo $pro->sale; ?>" name="sale" placeholder="Input Sale">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Status</label>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="status" value="1" <?php echo $pro->status == 1 ? 'checked' : ''; ?>>
                                                Show
                                            </label>
                                            <label>
                                                <input type="radio" name="status" value="0" <?php echo $pro->status == 0 ? 'checked' : ''; ?>>
                                                Hiddent
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Image</label>
                                        <input type="file" class="form-control" name="img" id="input_img" onchange="SHOW_IMG()">
                                        <img src="../uploads/<?php echo $pro->image; ?>" width="100%" id="img">
                                    </div>
                                    <a href="product.php" type="submit" class="btn btn-success"><i class="fa fa-arrow-left">Back</i></a>
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                                </div>
                            </div>

                        </div>
                    </div>



                </form>

            </div>
        </div>

    </section>
</div>
<?php include "footer.php" ?>
<script>
    function SHOW_IMG() {
        let imgInput = document.getElementById('input_img')
        let img = document.getElementById('img')
        const [file] = imgInput.files
        if (file) {
            img.src = URL.createObjectURL(file)
        }
    }
</script>