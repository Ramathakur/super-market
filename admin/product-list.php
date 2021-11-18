

<?php
   session_start();
   require('../model/admin-model.php');
   $dbObj = new Database1();

   
?>
<!DOCTYPE html>
<html>
<title>Product List</title>
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
            <h1 class="m-0 text-dark">Product List</h1>
         
          </div><!-- /.col -->
          
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <a class="btn btn-primary" href="product-add.php">Add New</a>
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
              Your Registration added successfully
            </div>";
      } 
    if (isset($_GET['msg2']) == "update") {
      echo "<div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert'>&times;</button>
              User Profile updated successfully
            </div>";
    }
    if (isset($_GET['msg3']) == "login") {
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
              <div class="card-header">
                <!-- <h3 class="card-title">Users List Table</h3> -->

               
               
                <div class="card-tools m-1">
                <form class="form-inline" action=" "  method="GET" >
                  <div class="input-group input-group-sm" style="width: 150px;">
                   <select name="cat_title" id="cat_title" class="form-control cat_title" onchange="this.form.submit()">
                     <option value="">Select Category</option>
                     <?php $cate = $dbObj->displayAll('categories');
                           foreach ($cate as $row2) {?>
                       <option <?php if($row2['cat_title'] == $_GET['cat_title']) echo 'selected="selected"';  ?>  value="<?php echo $row2['cat_title']; ?>"><?php echo  $row2['cat_title']; ?></option>
                     
                     <?php } ?>
                   
                   </select>
                </form>
                  </div>
                </div>
                <div class="card-tools m-1 ">
                <form class="form-inline"  action=" "  method="GET">
                  <div class="input-group input-group-sm" style="width: 150px;">
                   <select name="sub_cat_title" id="sub_cat_title" class="form-control sub_cat_title p-1" onchange="this.form.submit()">
                     <option value="">Select Sub Category</option>
                     <?php $Subcate = $dbObj->displaySubcate();
                           foreach ($Subcate as $row2) {?>
                       <option <?php if($row2['sub_cat_title'] == $_GET['sub_cat_title']) echo 'selected="selected"';  ?>  value="<?php echo $row2['sub_cat_title']; ?>"><?php echo  $row2['sub_cat_title']; ?></option>
                     
                     <?php } ?>
                   
                   </select>
                </form>
                  </div>
                </div>

                <div class="card-tools m-1">
                <form class="form-inline" action=" "  method="GET">
                  <div class="input-group input-group-sm" style="width: 150px;">
                   <select name="brand_title" id="brand_title" class="form-control brand_title" onchange="this.form.submit()">
                     <option value="">Select Brand</option>
                     <?php $brand = $dbObj->displayBrand();
                           foreach ($brand as $row2) {?>
                       <option <?php if($row2['brand_title'] == $_GET['brand_title']) echo 'selected="selected"';  ?>  value="<?php echo $row2['brand_title']; ?>"><?php echo  $row2['brand_title']; ?></option>
                     
                     <?php } ?>
                   
                   </select>
                </form>
                  </div>
                </div>


              </div>
              
         <!-- /.card-header -->


         <?php
    $limit =10;
    $result = $dbObj->displayProduct();
      $total_record = mysqli_num_rows($result);
      if(!isset($_GET['page']))
        {
            $page = 1;
        }
        else
        {
            $page = $_GET['page'];
        }
        
        $offset = ($page-1)* $limit;
        
        $total_page=ceil($total_record/$limit);
       // print_r($total_page);die;
      ?>
      <?php
    if(isset($_GET['cat_title'])  || isset($_GET['sub_cat_title']) || isset($_GET['brand_title']) )
    {
      $cat_title =$_GET['cat_title'];
      $sub_cat_title =$_GET['sub_cat_title'];
      $brand_title =$_GET['brand_title'];
      
        $query = "SELECT * FROM products AS p LEFT JOIN categories As c ON p.product_cat =  c.cat_id  LEFT JOIN  sub_categories As s ON p.product_sub_cat =  s.sub_cat_id LEFT JOIN  brands As b ON p.product_brand = b.brand_id  WHERE  c.cat_title  LIKE '%".$cat_title."%'  AND s.sub_cat_title  LIKE '%".$sub_cat_title."%'  AND b.brand_title  LIKE '%".$brand_title."%'  ORDER BY p.product_id DESC ";

        $search_result = filterTable( $query );
    } 

  else
    {
        $query = "SELECT * FROM  products AS p LEFT JOIN categories As c ON p.product_cat =  c.cat_id  LEFT JOIN  sub_categories As s ON p.product_sub_cat =  s.sub_cat_id LEFT JOIN  brands As b ON p.product_brand = b.brand_id ORDER BY p.product_id DESC limit $offset,$limit  ";
        
        $search_result = filterTable($query);
    }

    function filterTable($query)
    {
        $conn = mysqli_connect("localhost", "root", "root", "demo");
        $filter_Result = mysqli_query($conn, $query);
        return $filter_Result;
    }
?>
              <div class="card-body table-responsive p-0">
              <table id="productsTable" class="table table-striped table-hover table-bordered">
                  <thead>
                    <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Sub Category</th>
                    <th>Brand</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Image</th>
                    <th>Status</th>
                    <th width="100px">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                      
                  <?php 
          $count=1; while($row = mysqli_fetch_array($search_result)) {
        ?>
                    
                    <tr>
                    <td><b><?php echo 'PDR00'.$row['product_id']; ?></b></td>
                        <td><?php echo $row['product_title']; ?></td>
                        <td><?php echo $row['cat_title']; ?></td>
                        <td><?php echo $row['sub_cat_title']; ?></td>
                        <td><?php echo $row['brand_title']; ?></td>
                        <td><?php echo $currency_format.$row['product_price']; ?></td>
                        <td><?php echo $row['qty']; ?></td>
                        <td>
                            <?php  if($row['featured_image'] != ''){ ?>
                                <img src="../product-images/<?php echo $row['featured_image']; ?>" alt="<?php echo $row['featured_image']; ?>" width="50px"/>
                            <?php }else{ ?>
                                <img src="images/index.png" alt="" width="50px"/>
                            <?php } ?>
                        </td>
                        <td><?php
                                if($row['product_status'] == '1'){
                                    echo '<span class="label label-success">Active</span>';
                                }else{
                                    echo '<span class="label label-danger">Inactive</span>';
                                }
                            ?>
                        </td>
                        <td>
                            <a href="product-edit.php?id=<?php echo $row['product_id'];  ?>"><i class="fa fa-edit"></i></a>
                            <a class="delete_product" href="javascript:void()" data-id="<?php echo $row['product_id'] ?>" data-subcat="<?php echo $row['product_sub_cat'] ?>"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php $count++; }?>
                  </tbody>


                </table>
 
<?php

  
echo'
<nav aria-label="Page navigation example" style="margin-left:500px">
<ul class="pagination">';
for($page=1;$page<=$total_page;$page++)
{
  echo ' <li class="page-item"><a class="page-link" href="product-list.php?page=' . $page . '">' . $page . '</a></li>';

  
}
echo '</ul>
</nav>';
?>

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
