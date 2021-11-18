
<?php
   session_start();

   require('../model/dbConnect.php');
   $dbObj = new Database();

   if(isset($_GET['logout'])) {
    $dbObj->adminLogout();
  }  
?>
<!DOCTYPE html>
<html>
<title>Users List</title>
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
            <h1 class="m-0 text-dark">Users</h1>
            
          </div><!-- /.col -->
          
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <!-- <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard </li> -->
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
              Login successfully
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
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>S.No</th>
                      <th>Full Name</th>
                      <th>User Name</th>
                      <th>Email</th>
                      <th>Contact No</th>
                      <th>Gender</th>
                      <th>Dob</th>
                      <th>Education</th>
                      <th>Hobbiess</th>
                      <th>Bio</th>
                      <th>Picture</th>
                     
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                      
                  <?php 
          $count=1; $user = $dbObj->displayData(); 
          foreach ($user as $row) {
        ?>
                    <?php if($row['user_type']!=0){  ?>
                    <tr>
                    <th scope="row"><?php echo $count; ?></th>
                    <td><?php echo $row['first_name'] ." ". $row['last_name']; ?></td>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['phone']; ?></td>
                    <td><?php echo $row['gender']; ?></td>
                    <td><?php echo $row['dob']; ?></td>
                    <td><?php echo $row['education']; ?></td>
                    <td><?php echo $row['hobbiess']; ?></td>
                    <td><?php echo $row['bio']; ?></td>
                    <td>  <img src="../images/<?php echo $row['avatar']; ?>" alt="Img"  class="avatar" style="width: 50px; height: 50px;"></td>
                   
                    <!-- <td >
                            <a class="btn btn-outline-success" href="update.php?id=<?php echo $row["id"];?>"> edit</a>
                        </td> -->
                        <td>
                            <a class="btn btn-outline-danger" href="userEdit.php?id=<?php echo $row["id"]; ?>">Edit</a>
                        </td>
                    </tr>
                    <?php $count++; }}?>
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
</body>
</html>
