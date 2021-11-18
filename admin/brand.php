
<?php
   session_start();
   require('../model/admin-model.php');
   $dbObj = new Database1();

   
?>
<!DOCTYPE html>
<html>
<title>Brand List</title>
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
            <h1 class="m-0 text-dark">All Brands</h1>
         
          </div><!-- /.col -->
          
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <a class="btn btn-primary" href="brand-add.php">Add New</a>
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
              Brand added successfully
            </div>";
      } 
    if (isset($_GET['msg2']) == "update") {
      echo "<div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert'>&times;</button>
              Brand updated successfully
            </div>";
    }
    if (isset($_GET['msg3']) == "delete") {
      echo "<div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert'>&times;</button>
              Delete successfully
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
              </div> -->
              
         <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
              <table id="brandTable" class="table table-striped table-hover table-bordered">
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
                    $count=1; $brands = $dbObj->displayBrand(); 
                    // print_r($product);die;
                    foreach ($brands as $row) {
                  ?>
                    
                    <tr>
                    <td><b><?php echo 'PDR00'.$row['brand_id']; ?></b></td>
                        <td><?php echo $row['brand_title']; ?></td>
                        <td><?php echo $row['cat_title']; ?></td>
                        <td>
                            <a href="brand-edit.php?id=<?php echo $row['brand_id'];  ?>"><i class="fa fa-edit"></i></a>
                            <a class="delete_brand" href="javascript:void()" data-id="<?php echo $row['brand_id'] ?>" data-subcat="<?php echo $row['brand_id'] ?>"><i class="fa fa-trash"></i></a>
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
