<?php
 
  require('../model/admin-model.php');
   $dbObj = new Database1();
 
?>
<!DOCTYPE html>
<html>
<title> Brand Add</title>
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
            <h1 class="m-0 text-dark">Brand Add</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <!-- <li class="breadcrumb-item"><a href="#">Home</a></li> -->
              <a href="brand.php" class="but btn-secondry">Back</a>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- jquery validation -->
            <div class="card card-primary">
              <div class="card-header">
                <!-- <h3 class="card-title">Quick Example <small>jQuery Validation</small></h3> -->
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="brandData"  >
              <!-- <input name="id"  type="hidden" value="<?php echo $row['id'];?>" /> -->
                <div class="card-body">
                <div class="form-group">
                    <label for="brand_title">Brand Name</label>
                    <input type="text" name="brand_title" class="form-control" id="brand_title" value="<?php echo  $row['brand_title']; ?>"  placeholder="Enter email">
                    <span id="brandMsg" class="text-danger" style="display: none"></span> 
                  </div>
                  <div class="form-group">
                    <label>Category Name</label>
                    <select name="brand_cat" id="brand_cat" class="form-control">
                      <option value="">Select Category</option>
                      <?php $cate = $dbObj->displayAll('categories');
                            foreach ($cate as $row) {?>
                        <option value="<?php echo $row['cat_id']; ?>"><?php echo  $row['cat_title']; ?></option>
                      
                      <?php } ?>
                    
                    </select>
                    <span id="catTitleMsg" class="text-danger" style="display: none"></span> 
                  </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" name="brandSubmit" id="brandSubmit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
      <!-- /.container-fluid -->

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
