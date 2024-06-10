<?php include 'header.php'; ?>
<?php include 'aside.php'; ?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $sale_price = $_POST['sale_price'];
    $category_id = $_POST['category_id'];
    $image = $_FILES['image']['name'];
    $content = $_POST['content'];

    // Upload the image
    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($image);
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

    $sql = "INSERT INTO product (name, price, sale_price, image, content, category_id) VALUES ('$name', '$price', '$sale_price', '$image', '$content', '$category_id')";
    if ($conn->query($sql) === TRUE) {
        echo "New product created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Thêm mới sản phẩm</h1>
    </section>
    <section class="content">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" required>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" class="form-control" name="price" required>
            </div>
            <div class="form-group">
                <label for="sale_price">Sale Price</label>
                <input type="number" class="form-control" name="sale_price">
            </div>
            <div class="form-group">
                <label for="category_id">Category</label>
                <select class="form-control" name="category_id" required>
                    <?php
                    $result = $conn->query("SELECT * FROM category");
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='{$row['id']}'>{$row['name']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control" name="image" required>
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <textarea class="form-control" name="content"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Thêm mới</button>
        </form>
    </section>
</div>
<?php include 'footer.php'; ?>
