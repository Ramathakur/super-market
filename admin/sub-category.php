<?php


   require('../model/admin-model.php');
   $dbObj = new Database1();

  
?>
<!DOCTYPE html>
<html>
<title>Sub Category List</title>
<body>
    

<?php 
require('layout/header.php');
require('layout/sidebar.php');
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">All Sub Categories</h1>
         
          </div><!-- /.col -->
          
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <a class="btn btn-primary" href="sub-category-add.php">Add New</a>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <?php
    if (isset($_GET['msg1']) == "insert") {
      echo "<div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert'>&times;</button>
              Sub-category added successfully
            </div>";
      } 
    if (isset($_GET['msg2']) == "update") {
      echo "<div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert'>&times;</button>
              Sub-category updated successfully
            </div>";
    }
    if (isset($_GET['msg3']) == "delete") {
      echo "<div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert'>&times;</button>
              Sub-category deleted successfully
            </div>";
    }
  ?>
    <!-- Main content -->
    <section class="content">
    <div class="row">
          <div class="col-12">
            <div class="card">
              <!-- <div class="card-header">
                <h3 class="card-title">Users List Table</h3>

                <div class="card-tools">
                <form class="form-inline" ctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> "  method="GET">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text"  name="search" name="search" type="search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
                </form>
                  </div>
                </div>
              </div>
               -->
         <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
              <table id="subCtegoryTable" class="table table-striped table-hover table-bordered">
                  <thead>
                    <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th width="100px">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                      
                  <?php 
                    $count=1; $sub_categories = $dbObj->displaySubcate(); 
                  //print_r($sub_categories);die;
                    foreach ($sub_categories as $row) {
                  ?>
                    
                    <tr>
                    <td><b><?php echo 'PDR00'.$row['sub_cat_id']; ?></b></td>
                        <td><?php echo $row['sub_cat_title']; ?></td>
                        <td><?php echo $row['cat_title']; ?></td>
                        <td>
                            <a href="sub-category-edit.php?id=<?php echo $row['sub_cat_id'];  ?>"><i class="fa fa-edit"></i></a>
                            <a class="delete_subCategory" href="javascript:void()" data-id="<?php echo $row['sub_cat_id'] ?>" data-subcat="<?php echo $row['sub_cat_id'] ?>"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php $count++; }?>
                  </tbody>


                </table>
 
              </div>
                                               
              
            </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php 
require('layout/footer.php');
?>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<?php 
require('layout/script.php');
?>


<script src="../js/admin.js"></script>
</body>
</html>
