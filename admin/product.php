
<?php include 'header.php';?>
<?php include 'aside.php';?>
<?php 
$sqlT = "SELECT * FROM product";

$sql = "SELECT p.*, c.name as a_name FROM product p JOIN category c ON p.category_id = c.id";
if (!empty($_GET['key'])) {
    $key = $_GET['key'];
    $sql .= " WHERE p.name LIKE '%$key%'"; // Sử dụng 'p.name' để chỉ rõ cột 'name' thuộc bảng 'product'
    $sqlT .= " WHERE p.name LIKE '%$key%'"; // Cũng sử dụng 'p.name' ở đây
}
$queryT = $conn->query($sqlT);

// Kiểm tra xem truy vấn SQL có thành công không
if($queryT === false) {
    echo "Lỗi truy vấn: " . $conn->error;
} else {
    $total = $queryT->num_rows;
    $limit = 5;
    $totalPage = ceil($total/$limit);
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $page = $page < $totalPage ? $page : $totalPage;
    $page = $page > 0 ? $page : 1;
    $start = ($page-1) * $limit;

    $sql .= " ORDER BY id DESC LIMIT $start, $limit";
    $query = $conn->query($sql);

    if($query === false) {
        echo "Lỗi truy vấn: " . $conn->error;
    } else {
        ?>
        <div class="content-wrapper">
            <section class="content-header">
                <h1>Quản lý danh mục: <?php echo $total;?></h1>
            </section>
            <section class="content">
                <div class="box">
                    <div class="box-body">
                        <form action="" method="GET" class="form-inline" role="form">
                            <div class="form-group">
                                <label class="sr-only" for="">Từ khóa</label>
                                <input class="form-control" name="key" placeholder="Nhập từ khóa tìm kiếm">
                            </div>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                            <a href="product-add.php" class="btn btn-success"><i class="fa fa-plus"></i> Thêm mới</a>
                        </form>
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Sale Price</th>
                                    <th>Image</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                while($row = $query->fetch_object()) :
                                    ?>
                                    <tr>
                                        <td><?php echo $row->id;?></td>
                                        <td><?php echo $row->name;?></td>
                                        <td><?php echo $row->a_name;?></td>
                                        <td><?php echo $row->price;?></td>
                                        <td><?php echo $row->sale_price;?></td>
                                        <td>
                                            <img src="../uploads/<?php echo $row->image;?>" alt="" width="60">
                                        </td>
                                        <td class="text-right">
                                            <a href="product-edit.php?id=<?php echo $row->id;?>" class="btn btn-primary"><i class="fa fa-edit"></i> Sửa</a>
                                            <a href="product-delete.php?id=<?php echo $row->id;?>" class="btn btn-danger"  onclick="return confirmDelete();" ><i class="fa fa-trash"></i> Xóa</a>
                                        </td>
                                    </tr>
                                    <?php 
                                endwhile;
                                ?>
                            </tbody>
                        </table>
                        <hr>
                        <ul class="pagination">
                            <li><a href="?page=<?php echo $page > 1 ? $page - 1: 1;?>">&laquo;</a></li>
                            <?php 
                            for($i = 1; $i <= $totalPage; $i++) : 
                                ?>
                                <li <?php echo $page == $i ? 'class="active"' : '';?>><a href="?page=<?php echo $i;?>"><?php echo $i;?></a></li>
                                <?php 
                            endfor;
                            ?>
                            <li><a href="?page=<?php echo $page < $totalPage ? $page + 1 : $totalPage;?>">&raquo;</a></li>
                        </ul>
                    </div>
                </div>
            </section>
        </div>
        <?php 
    }
}
include 'footer.php'; 
?>