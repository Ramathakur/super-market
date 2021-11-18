
<?php
 
 require('../model/admin-model.php');
  $dbObj = new Database1();

  $id = $_GET['id'];
  $row = $dbObj->getBrandById('brands',$id);
  //print_r($row);die;
?>
<!DOCTYPE html>
<html>
<title>Brand Update</title>
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
           <h1 class="m-0 text-dark">Brand Update</h1>
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
             <form id="updateBrand" method="post">
             <input type="hidden" name="brand_id" value="<?php echo $row['brand_id']; ?>" />
               <div class="card-body">
               <div class="form-group">
                   <label >Sub Category Name</label>
                   <input type="text" name="brand_name" class="form-control brand_name" value="<?php echo $row['brand_title']; ?>"  placeholder="Brand Name" required />
                   
                 </div>
                
                 <div class="form-group">
                   <label>Category Name</label>
                   <select name="brand_cat" class="form-control brand_category">
                     <option value="">Select Category</option>
                     <?php $cate = $dbObj->displayAll('categories');
                           foreach ($cate as $row2) {?>
                         <option <?php if($row2['cat_id'] == $row['brand_cat']) echo 'selected="selected"';  ?> value="<?php echo $row2['cat_id']; ?>"><?php echo $row2['cat_title']; ?></option>
                     
                     <?php } ?>
                   
                   </select>
                
                 </div>
                 
               <!-- /.card-body -->
               <div class="card-footer">
                 <button type="submit" name="submit2" id="submit2" class="btn btn-primary">Submit</button>
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
