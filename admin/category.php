<?php
include 'header.php';

// Lấy toàn bộ danh sách danh mục từ cơ sở dữ liệu
$data = $conn->query("SELECT * FROM category ORDER BY id DESC");

// Khởi tạo một mảng chứa tất cả các danh mục
$categories = [];
while ($cat = $data->fetch_object()) {
    $categories[] = $cat; // Thêm danh mục vào mảng
}

// Kiểm tra nếu có từ khóa tìm kiếm
if (!empty($_GET['search_key'])) {
    $key = strtolower($_GET['search_key']); // Chuyển từ khóa tìm kiếm thành chữ thường
    $key = trim($key);
    // Tạo mảng mới để chứa các kết quả tìm kiếm
    $filtered_categories = [];

    // Duyệt qua danh sách các danh mục để tìm kiếm theo tên
    foreach ($categories as $cat) {
        // Chuyển tên danh mục trong cơ sở dữ liệu thành chữ thường và so sánh với từ khóa tìm kiếm
        if (stripos(strtolower($cat->name), $key) !== false) { // stripos không phân biệt chữ hoa, chữ thường
            $filtered_categories[] = $cat;
        }
    }

    // Nếu không có kết quả tìm kiếm
    if (empty($filtered_categories)) {
        $error = 'No matching data found!!!';
    } else {
        $categories = $filtered_categories; // Cập nhật danh sách kết quả tìm kiếm
    }
}
?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Category</h1>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-body">

                <form action=" " method="GET" class="form-inline">
                    <div class="form-group">
                        <input class="form-control" name="search_key" placeholder="Input field">
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                    <a href="category-create.php" type="submit" class="btn btn-success"><i class="fa fa-plus">Add new</i></a>
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
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($categories as $cat) : ?>
                            <tr>
                                <td><?php echo $cat->id; ?> </td>
                                <td><?php echo $cat->name; ?></td>
                                <td><?php echo $cat->status == '1' ? 'Show' : 'Hidden'; ?></td>
                                <td class="text-right">
                                    <a href="category-edit.php?id=<?php echo $cat->id; ?>" class="btn btn-sm btn-primary"> <i class="fa fa-edit"></i>Edit</a>
                                    <a onclick="return confirm('Do you have delete <?php echo $cat->name; ?> ?')" href="category-delete.php?id=<?php echo $cat->id; ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Del</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>

<?php include "footer.php"; ?>