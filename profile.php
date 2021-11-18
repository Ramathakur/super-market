<?php
   session_start();
   
?>
<?php
  include_once('model/dbConnect.php');
  $dbObj = new Database();

  $id = $_SESSION['id'];
  $row = $dbObj->getRecordById($id);
 
  // Update Record in customer table
  if(isset($_POST['update'])) {
    $dbObj->updateRecord($_POST);
  }  
  
  // logout
  if(isset($_POST['logout'])) {
    $dbObj->Logout();
  }  
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile</title>
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <!-- Bootstrap Date-Picker Plugin -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
  
  <link href="css/style1.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="css/profile.css" rel="stylesheet">
<!-- <link href="css/profile1.css" rel="stylesheet"> -->
<style>
    input:focus{
        outline: none;
    }



.profile-pic {
  border-radius: 50%;
  height: 150px;
  width: 150px;
  background-size: cover;
  background-position: center;
  background-blend-mode: multiply;
  vertical-align: middle;
  text-align: center;
  color: transparent;
  transition: all .3s ease;
  text-decoration: none;
  cursor: pointer;
}

.profile-pic:hover {
  background-color: rgba(0,0,0,.5);
  z-index: 10000;
  color: #fff;
  transition: all .3s ease;
  text-decoration: none;
}

.profile-pic span {
  display: inline-block;
  padding-top: 4.5em;
  padding-bottom: 4.5em;
}

form input[type="file"] {
        display: none;
        cursor: pointer;
}
</style>
</head>
<body>
<nav aria-label="breadcrumb" class="main-breadcrumb " >
            <ol class="breadcrumb"  style="background-color:#2a95a7;">
              <!-- <li class="breadcrumb-item"><a href="index.html">Home</a></li> -->
              <li class="breadcrumb-item"><a href="javascript:void(0)" style="color:#edeff3;">Profile </a></li>
              <!-- <li class="breadcrumb-item active" aria-current="page">User Profile</li> -->
              
            </ol>
            <form action="profile.php" method="post" enctype="multipart/form-data">
            <input type="submit" name="logout" value="logout" class="btn btn-info btn-sm" style="margin-left: 122em;margin-top: -110px;">
              <!-- <span class="glyphicon glyphicon-log-out" ></span> Log out -->
             </form>
          </nav>
<div class="container">

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
              Your Profile updated successfully
            </div>";
    }
    if (isset($_GET['msg3']) == "login") {
      echo "<div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert'>&times;</button>
              Login successfully
            </div>";
    }
  ?>
    <div class="main-body">
    
          <!-- Breadcrumb -->
          
          <!-- /Breadcrumb -->
          <form action="home.php" method="post" enctype="multipart/form-data">
          <input name="id"  type="hidden" value="<?php echo $row['id'];?>" />
          <div class="row gutters-sm">
        
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
             
                  <div class="d-flex flex-column align-items-center text-center">
                  <label for="fileToUpload">
                    <div class="profile-pic" id="imagePreview" style="background-image: url('./images/<?php echo $row['avatar']; ?>')">
                        <span class="glyphicon glyphicon-camera"></span>
                        <span>Change Image</span>
                    </div>
                    </label>
                    <input type="File" name="avatar" id="fileToUpload">
                 
                    <div class="mt-3">
                      <h4><?php echo  $row['username']; ?></h4>
                      
                    </div>
                  </div>
                </div>
              </div>
             
            </div>
         
            <div class="col-md-8">
        
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">User Name</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      
                      <input  style="border:none" type="text" name="username"  value="<?php echo  $row['username']; ?>">
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">First Name</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <input  style="border:none" type="text" name="first_name"  value="<?php echo  $row['first_name']; ?>"><br>
                 
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Last Name</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <input  style="border:none" type="text" name="last_name"  value="<?php echo  $row['last_name']; ?>"><br>
            
                    </div>
                  </div>
                  <hr>
                 
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <input  style="border:none" type="text" name="email"  value="<?php echo  $row['email']; ?>"><br>
                    <?php if($_SESSION['email_err_msg']){echo $_SESSION['email_err_msg'] ;  unset($_SESSION['email_err_msg'] );}?>
                    </div>
                  </div>
                  <hr>

                  
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Mobile</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <input  style="border:none" type="text" name="phone"  value="<?php echo $row['phone']; ?>"><br>
                    <?php if($_SESSION['phone_err_msg']){echo $_SESSION['phone_err_msg'] ;  unset($_SESSION['phone_err_msg'] );}?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Gender</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <!-- <input  style="border:none" type="text" name=""  value=""> -->
                    <input type="radio" name="gender" value="male" <?php echo ($row['gender']==  'male') ? ' checked="checked"' : '';?>> Male  
                    <input type="radio" name="gender" value="female" <?php echo ($row['gender']==  'female') ? ' checked="checked"' : '';?>> Female  
                    <input type="radio" name="gender" value="other" <?php echo ($row['gender']==  'other') ? ' checked="checked"' : '';?>> Other 
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Hobbiess</h6>
                      </div>
                    <div class="col-sm-9 text-secondary">
                      <input type="checkbox" name="hobbiess[]" value="sports" <?php echo ($row['hobbiess']==  'sports') ? ' checked="checked"' : '';?>> Sports
                      <input type="checkbox" name="hobbiess[]" value="music"  <?php echo ($row['hobbiess']==  'music') ? ' checked="checked"' : '';?>> Music
                      <input type="checkbox" name="hobbiess[]" value="reading"  <?php echo ($row['hobbiess']==  'reading') ? ' checked="checked"' : '';?>> Reading 
                      <input type="checkbox" name="hobbiess[]" value="travelling"  <?php echo ($row['hobbiess']==  'travelling') ? ' checked="checked"' : '';?>> Travelling 
                      <input type="checkbox" name="hobbiess[]" value="other"  <?php echo ($row['hobbiess']==  'other') ? ' checked="checked"' : '';?>> Other  
                    
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Dob</h6>
                      </div>
                    <div class="col-sm-9 text-secondary">
                    <input  id="date" style="border:none" name="dob" placeholder="MM/DD/YYY" value="<?php echo $row['dob']; ?>" type="text"/>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Education</h6>
                      </div>
                    <div class="col-sm-9 text-secondary">
                    <input  style="border:none" type="text" name="education"  value="<?php echo $row['education']; ?>"><br>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Bio</h6>
                      </div>
                    <div class="col-sm-9 text-secondary">
                    <input  style="border:none" type="text" name="bio"  value="<?php echo $row['bio']; ?>"><br>
                    </div>
                  </div>
                  <hr>
                  <!-- <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Status</h6>
                    </div>
                    <div class="col-sm-3 text-secondary">
                    <select name="status" class="form-control" id="">
                      <option value="" >Select Status</option>
                      <option value="0" <?php echo ($row['status']==  '0') ? ' selected="selected"' : '';?>>Active</option>
                      <option value="1" <?php echo ($row['status']==  '1') ? ' selected="selected"' : '';?>>Deactive</option>
                    </select>
                    </div>
                  </div>
                  <hr> -->
                  <div class="row">
                    <div class="col-sm-12">
                      <input type="submit" class="btn btn-info "  name="update" value="Edit">
                      <!-- <a  target="__blank" href="https://www.bootdey.com/snippets/view/profile-edit-data-and-skills">Edit</a> -->
                    </div>
                   
                  </div>
                </div>
              </div>

           </form>
             <!-- <a href="controller/account_delete_req.php?id=<?php echo $row["id"]; ?>" class="btn btn-danger btn-sm" style="position:absolute;margin-left: 42em;margin-top: -70px;">
              <span class="glyphicon glyphicon-log-out" ></span> Delete Account
             </a> -->
            </div>
           
          </div>

        </div>
    </div>

    <script>

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#imagePreview').css('background-image', 'url('+e.target.result +')');
            $('#imagePreview').hide();
            $('#imagePreview').fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#fileToUpload").change(function() {
    readURL(this);
});

    </script>
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
