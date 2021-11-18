
<?php
  

  require('../model/admin-model.php');
 $dbObj = new Database1();

 $id = $_GET['id'];
 $row = $dbObj->getCatById('categories',$id);
//print_r($row );die;
 // Update Record in customer table

 
?>

<!DOCTYPE html>
<html>
<title>Category Update</title>
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
           <h1 class="m-0 text-dark">Category Update</h1>
         </div><!-- /.col -->
         <div class="col-sm-6">
           <ol class="breadcrumb float-sm-right">
             <!-- <li class="breadcrumb-item"><a href="#">Home</a></li> -->
             <a href="category.php" class="but btn-secondry">Back</a>
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
             <form  id="updateCategory" method="post">
             <input name="cat_id"  type="hidden" value="<?php echo $row['cat_id'];?>" />
               <div class="card-body">
               <div class="form-group">
                   <label for="cat_title">Category Name</label>
                   <input type="text" name="cat_name" class="form-control"  value="<?php echo $row['cat_title']; ?>"  placeholder="Enter email">
                  
               </div>
                
               <!-- /.card-body -->
               <div class="card-footer">
              
                   <button type="submit" name="submit" id="submit" class="btn btn-primary">Submit</button>
                 
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
