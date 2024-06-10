<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $admin->name;?></p>
          <a href="logout.php"><i class="fa fa-circle text-success"></i> Logout</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
    
        <li>
          <a href="index.php">
            <i class="fa fa-th"></i> <span>Dashboard</span>
            <small class="label pull-right bg-green">Hot</small>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Categories</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="category.php"><i class="fa fa-circle-o"></i> Categories List</a></li>

          </ul>
        </li>
      
        <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Products</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="product.php"><i class="fa fa-circle-o"></i> Products List</a></li>

          </ul>
        </li>
      
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->