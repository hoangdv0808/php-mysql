<?php include 'header.php';?>
<?php include 'aside.php';?>
<?php 
$sqlT = "SELECT * FROM category";


$sql = "SELECT * FROM category ";
if (!empty($_GET['key'])) {
  $key = $_GET['key'];
  $sql .= " WHERE name LIKE '%$key%'";
  $sqlT .= " WHERE name LIKE '%$key%'";
}
//--- TÍNH TỔNG-------------
$queryT = $conn->query($sqlT);
$total = $queryT->num_rows;
$limit = 5;
$totalPage = ceil($total/$limit);
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$page = $page < $totalPage ? $page : $totalPage;
$page = $page > 0 ? $page : 1;
$start = ($page-1) * $limit;
//-------------------------
$sql .= " Order By id DESC LIMIT $start, $limit";
$query = $conn->query($sql);

?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Quản lý danh mục: <?php echo $total;?></h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box">

        <div class="box-body">
          
          <form action="" method="GET" class="form-inline" role="form">
          
            <div class="form-group">
              <label class="sr-only" for="">label</label>
              <input class="form-control" name="key" placeholder="Input field">
            </div>
          
            
          
            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
            <a href="category-add.php" class="btn btn-success"><i class="fa fa-plus"></i> Thêm mới</a>
          </form>
          
          <table class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>Id</th>
                <th>Name</th>
                <th></th>
              </tr>
            </thead> 
            <tbody>
              <?php while($row = $query->fetch_object()) : ?>
              <tr>
                <td><?php echo $row->id;?></td>
                <td><?php echo $row->name;?></td>
                <td class="text-right">
                  <a href="category-edit.php?id=<?php echo $row->id;?>" class="btn btn-primary"><i class="fa fa-edit"></i> Sửa</a>
                  <a href="category-delete.php?id=<?php echo $row->id;?>" class="btn btn-danger"  onclick="return confirmDelete();" ><i class="fa fa-trash"></i> Xóa</a>
                </td>
              </tr>
              <?php endwhile;?>
            </tbody>
          </table>
          

          <hr>
          
          <ul class="pagination">
            <li><a href="?page=<?php echo $page > 1 ? $page - 1: 1;?>">&laquo;</a></li>
            <?php for($i = 1; $i <= $totalPage; $i++) : ?>
            <li <?php echo $page == $i ? 'class="active"' : '';?>><a href="?page=<?php echo $i;?>"><?php echo $i;?></a></li>
          <?php endfor;?>
            <li><a href="?page=<?php echo $page < $totalPage ? $page + 1 : $totalPage;?>">&raquo;</a></li>
          </ul>
          
        </div>
        <!-- /.box-body -->
        
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

 <?php include 'footer.php'; ?>