<?php include 'header.php';?>
<?php include 'aside.php';?>
<?php 
$id = $_GET['id'];
$sql = "DELETE FROM product WHERE id = ". $id;

?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Xóa sản phẩm: <?php echo $sql ;?></h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box">

        <div class="box-body">
          <?php 
          if ($conn->query($sql)) {
            header('location: product.php');
          } else {
            echo $conn->error();
          }
          
          ?>

      
        </div>
        <!-- /.box-body -->
        
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

 <?php include 'footer.php'; ?>