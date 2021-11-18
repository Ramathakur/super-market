
<?php
 require('../model/dbConnect.php');
  $dbObj = new Database();

  $id = $_GET['id'];
  $row = $dbObj->getRecordById($id);
 
  // Update Record in customer table
  if(isset($_POST['update'])) {
    $dbObj->adminUpdateRecord($_POST);
  }  
  
  
 
?>
<!DOCTYPE html>
<html>
<title>User Update</title>
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
            <h1 class="m-0 text-dark">User Update</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <!-- <li class="breadcrumb-item"><a href="#">Home</a></li> -->
              <a href="userList.php" class="but btn-secondry">Back</a>
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
              <form action="userEdit.php" method="post" enctype="multipart/form-data">
              <input name="id"  type="hidden" value="<?php echo $row['id'];?>" />
                <div class="card-body">
                <div class="form-group">
                    <label for="username">First Name</label>
                    <input type="text" name="first_name" class="form-control" id="first_name" value="<?php echo  $row['first_name']; ?>"  placeholder="Enter email">
                  </div>
                  <div class="form-group">
                    <label for="username">Last Name</label>
                    <input type="text" name="last_name" class="form-control" id="last_name" value="<?php echo  $row['last_name']; ?>"  placeholder="Enter email">
                  </div>
                  <div class="form-group">
                    <label for="username">User Name</label>
                    <input type="text" name="username" class="form-control" id="username" value="<?php echo  $row['username']; ?>"  placeholder="Enter email">
                  </div>
                  <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="text" name="email" class="form-control" id="email" value="<?php echo  $row['email']; ?>"  placeholder="Enter email">
                    <?php if($_SESSION['email_err_msg']){echo $_SESSION['email_err_msg'] ;  unset($_SESSION['email_err_msg'] );}?>  
                </div>
                  <div class="form-group">
                    <label for="pass">Password</label>
                    <input type="password" name="pass" class="form-control" id="pass" value="<?php echo  $row['pass']; ?>"  placeholder="Password">
                  </div>
                  <div class="form-group">
                    <label for="phone">Mobile No</label>
                    <input type="text" name="phone" class="form-control" id="phone" value="<?php echo  $row['phone']; ?>"  placeholder="Enter email">
                    <?php if($_SESSION['phone_err_msg']){echo $_SESSION['phone_err_msg'] ;  unset($_SESSION['phone_err_msg'] );}?> 
                </div>
                 
                  <div class="col-sm-3">
                      <h6 class="mb-0" style="font-weight:bold;">Gender</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <!-- <input  style="border:none" type="text" name=""  value=""> -->
                    <input type="radio" name="gender" value="male" <?php echo ($row['gender']==  'male') ? ' checked="checked"' : '';?>> Male  
                    <input type="radio" name="gender" value="female" <?php echo ($row['gender']==  'female') ? ' checked="checked"' : '';?>> Female  
                    <input type="radio" name="gender" value="other" <?php echo ($row['gender']==  'other') ? ' checked="checked"' : '';?>> Other 
                    </div>
                    <br>
                    <div class="col-sm-3">
                      <h6 class="mb-0" style="font-weight:bold;">Hobbiess</h6>
                      </div>
                    <div class="col-sm-9 text-secondary">
                      <input type="checkbox" name="hobbiess[]" value="sports" <?php echo ($row['hobbiess']==  'sports') ? ' checked="checked"' : '';?>> Sports
                      <input type="checkbox" name="hobbiess[]" value="music"  <?php echo ($row['hobbiess']==  'music') ? ' checked="checked"' : '';?>> Music
                      <input type="checkbox" name="hobbiess[]" value="reading"  <?php echo ($row['hobbiess']==  'reading') ? ' checked="checked"' : '';?>> Reading 
                      <input type="checkbox" name="hobbiess[]" value="travelling"  <?php echo ($row['hobbiess']==  'travelling') ? ' checked="checked"' : '';?>> Travelling 
                      <input type="checkbox" name="hobbiess[]" value="other"  <?php echo ($row['hobbiess']==  'other') ? ' checked="checked"' : '';?>> Other  
                    
                    </div>
                    <div class="form-group"> <!-- Date input -->
                    <label class="control-label" for="date">Dob</label>
                    <input class="form-control" id="date" name="dob" placeholder="MM/DD/YYY" value="<?php echo  $row['dob']; ?>" type="text"/>
                  </div>
                  <div class="form-group">
                    <label for="education">Education</label>
                    <input type="text" name="education" class="form-control" id="education" value="<?php echo  $row['education']; ?>"  placeholder="Password">
                  </div>
                  <div class="form-group">
                    <label for="bio">bio</label>
                    <textarea name="bio" id="bio" cols="30"  class="form-control" rows="10"><?php echo  $row['bio']; ?></textarea>
                  
                  </div>
                    <div class="form-group">
                    <label for="exampleInputEmail1">Image</label>
                    <input type="file" name="avatar" value="<?php echo  $row['avatar']; ?>"  class="form-control" id="exampleInputEmail1" >
                  </div>
                  </div>
                 
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" name="update" class="btn btn-primary">Submit</button>
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

<script>
    $(document).ready(function(){
        var date_input=$('input[name="dob"]'); //our date input has the name "date"
        var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
        date_input.datepicker({
            format: 'mm/dd/yyyy',
            container: container,
            todayHighlight: true,
            autoclose: true,
        })
    })
</script>
</body>
</html>
