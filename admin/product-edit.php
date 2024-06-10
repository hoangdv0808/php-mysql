<?php include 'header.php'; ?>
<?php include 'aside.php'; ?>
<?php
$id = $_GET['id'];
$row = null; // Khởi tạo biến $row

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $sale_price = $_POST['sale_price'];
    $category_id = $_POST['category_id'];
    $image = $_FILES['image']['name'];
    $content = $_POST['content'];

    if ($image) {
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($image);
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
        $sql = "UPDATE product SET name='$name', price='$price', sale_price='$sale_price', image='$image', content='$content', category_id='$category_id' WHERE id=$id";
    } else {
        $sql = "UPDATE product SET name='$name', price='$price', sale_price='$sale_price', content='$content', category_id='$category_id' WHERE id=$id";
    }

    if ($conn->query($sql) === TRUE) {
        echo "Cập nhật sản phẩm thành công";
        header("Location: product.php"); 
        exit(); 
    } else {
        echo "Lỗi: " . $sql . "<br>" . $conn->error;
    }
} else {
    $result = $conn->query("SELECT * FROM product WHERE id=$id");
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Không tìm thấy sản phẩm với ID: $id";
        exit;
    }
}
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Chỉnh sửa sản phẩm</h1>
    </section>
    <section class="content">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Tên sản phẩm</label>
                <input type="text" class="form-control" name="name" value="<?php echo isset($row['name']) ? $row['name'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="price">Giá</label>
                <input type="number" class="form-control" name="price" value="<?php echo isset($row['price']) ? $row['price'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="sale_price">Giá khuyến mãi</label>
                <input type="number" class="form-control" name="sale_price" value="<?php echo isset($row['sale_price']) ? $row['sale_price'] : ''; ?>">
            </div>
            <div class="form-group">
                <label for="category_id">Danh mục</label>
                <select class="form-control" name="category_id" required>
                    <?php
                    $result = $conn->query("SELECT * FROM category");
                    while ($cat = $result->fetch_assoc()) {
                        $selected = isset($row['category_id']) && $cat['id'] == $row['category_id'] ? 'selected' : '';
                        echo "<option value='{$cat['id']}' $selected>{$cat['name']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="image">Hình ảnh</label>
                <input type="file" class="form-control" name="image">
                <img src="../uploads/<?php echo isset($row['image']) ? $row['image'] : ''; ?>" width="100">
            </div>
            <div class="form-group">
                <label for="content">Nội dung</label>
                <textarea class="form-control" name="content"><?php echo isset($row['content']) ? $row['content'] : ''; ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </form>
    </section>
</div>
<?php include 'footer.php'; ?>