
<?php
 
 require('../model/admin-model.php');
  $dbObj = new Database1();



  $id = $_GET['id'];
  $row = $dbObj->getProductById('products',$id);
  //print_r( $row);die;
?>
<!DOCTYPE html>
<html>
<title>Product Update</title>
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
            <h1 class="m-0 text-dark">Product Update</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <!-- <li class="breadcrumb-item"><a href="#">Home</a></li> -->
              <a href="product-list.php" class="but btn-secondry">Back</a>
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
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
              <div class="card-header">
                <!-- <h3 class="card-title">Quick Example <small>jQuery Validation</small></h3> -->
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="updateProduct"  method="post" enctype="multipart/form-data" >
              <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>"/>
                <div class="card-body">
              <div class="row">
              <div class="col-md-9">

                <div class="form-group">
                    <label for="">Product Title</label>
                   
                    <input type="text" class="form-control product_title" name="product_title"   value="<?php echo $row['product_title']; ?>" placeholder="Product Title" requried/>
                </div>

                <div class="row">
                <div class="form-group col-md-4">
                    <label for="">Product Category</label>
                    <select class="form-control product_category" name="product_cat">

                        <option value="">Select Category</option>
                        <?php $cate = $dbObj->displayAll('categories');
                            foreach ($cate as $row2){ 
                            if($row['product_cat'] == $row2['cat_id']){?>
                        <option selected value="<?php echo $row2['cat_id']; ?>"><?php echo $row2['cat_title']; ?></option>
                        <?php }else{ ?>
                            <option value="<?php echo $row2['cat_id']; ?>"><?php echo $row2['cat_title']; ?></option>
                        <?php }} ?>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="">Product Sub-Category</label>
                    <select class="form-control product_sub_category" name="product_sub_cat">
                        <option value="" >Select Sub-Category</option>
                        <?php $sub_categories = $dbObj->displayAll('sub_categories');
                            foreach ($sub_categories as $row2) {
                                  if($row['product_sub_cat'] == $row2['sub_cat_id']){?>
                             <option selected value="<?php echo $row2['sub_cat_id']; ?>"><?php echo $row2['sub_cat_title']; ?></option>
                             <?php }else{ ?>
                                <option value="<?php echo $row2['sub_cat_id']; ?>"><?php echo $row2['sub_cat_title']; ?></option>
                             <?php } }?>
                             
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="">Product Brand</label>
                    <select class="form-control product_brands" name="product_brand">
                        <option value="" >Select Brand</option>
                        <?php $brands = $dbObj->displayAll('brands');
                            foreach ($brands as $row2) {
                                if($row['product_brand'] == $row2['brand_id']){?>
                             <option selected value="<?php echo $row2['brand_id']; ?>"><?php echo $row2['brand_title']; ?></option>
                             <?php }else{ ?>
                                <option value="<?php echo $row2['brand_id']; ?>"><?php echo $row2['brand_title']; ?></option>
                             <?php }} ?>
                    </select>
                </div>
                </div>

                <div class="form-group">
                    <label for="">Product Description</label>
                    <textarea class="form-control product_description" name="product_desc" rows="8" cols="80" requried><?php echo $row['product_desc']; ?></textarea>
                </div>
            </div>
            <div class="col-md-3">

                <div class="form-group">
                    <label for="">Featured Image</label>
                    <input type="file" class="product_image" name="new_image">
                        <input type="hidden" class="old_image" name="old_image" value="<?php echo $row['featured_image']; ?>">
                    <img id="image" src="../product-images/<?php echo $row['featured_image']; ?>" alt="" width="100px"/>
                </div>

                <div class="form-group">
                    <label for="">Product Price</label>
                    <input type="text" class="form-control product_price" name="product_price" requried value="<?php echo $row['product_price']; ?>">
                </div>

                <div class="form-group">
                    <label for="">Available Quantity</label>
                    <input type="number" class="form-control product_qty" name="product_qty" requried value="<?php echo $row['qty']; ?>">
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select class="form-control product_status" name="product_status">
                    <option <?php if($row['product_status'] == '1') echo 'selected'; ?> value="1">Published</option>
                            <option <?php if($row['product_status'] == '0') echo 'selected'; ?> value="0">Draft</option>
                    </select>
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary" name="submit" value="Submit">
                </div>

            </div>
            </div>
                <!-- /.card-body -->
              
              </form>
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
        
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
<script>
  $(function () {
    // Summernote
    $('.product_description').summernote()
  })
</script>
<script src="../js/admin.js"></script> 
</body>
</html>
