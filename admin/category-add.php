<?php include 'header.php';?>
<?php include 'aside.php';?>
<?php 
$err_msg = '';
if (isset($_POST['name'])) {
  $name = $_POST['name'];
  $query = $conn->query("INSERT INTO category SET name = '$name'");
  if ($query) {
    header('location: category.php');
  } else {
    $err_msg =  $conn->error();
  }
}


?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Thêm mới danh mục</h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box">

        <div class="box-body">
          <?php if ($err_msg) : ?>
            
            <div class="alert alert-danger">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <?php echo $err_msg;?>
            </div>
            

          <?php endif;?>
          <form action="" method="POST" role="form">
          
            <div class="form-group">
              <label for="">Tên danh mục</label>
              <input type="text" class="form-control" name="name" placeholder="Tên danh mục">
            </div>

            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Lưu lại</button>
            <a href="category.php" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Quay lại</a>
          </form>
          
        </div>
        <!-- /.box-body -->
        
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

 <?php include 'footer.php'; ?>