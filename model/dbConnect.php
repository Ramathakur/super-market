<?php
   
   class Database 
   {
      private $servername = "localhost";
      private $username   = "root";
      private $password   = "root";
      private $dbname = "demo";
      public $con;
      public $usersTable = "users";
      public $productsTable = "products";
      
      public function __construct()
      {
         try {
            $this->con = new mysqli($this->servername, $this->username, $this->password, $this->dbname);   
         } catch (Exception $e) {
            echo $e->getMessage();
         }
      }

  //-----------------------------------------Login---------------------------------------------------------------------


      // Fetch single data for login from user table
      public function getloginRecord($email,$pass)
      {
         $query = "SELECT * FROM $this->usersTable WHERE email = '$email' or  pass='$pass'";
         $result = $this->con->query($query);
         if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
         }else{
            return false;
         }
      }

      // Fetch single record data for view profile
      public function getRecordById($id)
      {
         $query = "SELECT * FROM $this->usersTable WHERE id = '$id'";
         $result = $this->con->query($query);
         if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
         }else{
            return false;
         }
      }



   //------------------------------------Registration----------------------------------------------------------------------------   
     
   
   // Insert users data into user  table
      public function insertRecond($username, $email, $password)
      {
         $sql = "INSERT INTO $this->usersTable (username, email, pass) VALUES('$username','$email','$password')";
         $query = $this->con->query($sql);
         if ($query) {
            return true;
         }else{
            return false;
         }
      }

      //check email is already exist or not

      public function isUserExist($emailid){  
        $query = "SELECT * FROM $this->usersTable WHERE email = '$emailid'";
        $result = $this->con->query($query);
        if ($result->num_rows > 0) {
           $row = $result->fetch_assoc();
           return $row;
        }else{
           return false;
        }
    }  

     
   //--------------------------------Profile Update--------------------------------------------------------------

      // Update users data into user table
      public function updateRecord($postData)
      {

         $phone = $email = "";
         if($phone = $this->con->real_escape_string($_POST['phone'])){

         if(!preg_match ("/^[0-9]*$/", $phone) ) {
            $phoneerr.= "Only numeric value is allowed.";  
            $_SESSION['phone_err_msg'] = $phoneerr;
            header("location:profile.php");
            exit;
         }elseif (strlen ($phone) != 10){
            $phoneerr.=  "phone no must contain 10 digits."; 
            $_SESSION['phone_err_msg'] = $phoneerr;
            header("location:profile.php");
            exit;
         }
            
         }
           
        if($email = $this->con->real_escape_string($_POST['email'])){
         $query = "SELECT * FROM $this->usersTable WHERE email = '$email'";
         $result = $this->con->query($query);
         $row = $result->fetch_assoc(); 
         if ($row['id'] !=$_POST['id'] && $result->num_rows > 0) {
            $emailErr.=  "This Email Address is already registered. Please Try another."; 
            $_SESSION['email_err_msg'] = $emailErr;
            header("location:profile.php");
            exit;
         }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL) ) {
            $emailErr = "Invalid Email.";
           $_SESSION['email_err_msg'] = $emailErr;
           header("location:profile.php");
           exit;
         }
            
        }

		    $username = $this->con->real_escape_string($_POST['username']);
          $first_name = $this->con->real_escape_string($_POST['first_name']);
          $last_name = $this->con->real_escape_string($_POST['last_name']);
          $dob = $this->con->real_escape_string($_POST['dob']);
          $education = $this->con->real_escape_string($_POST['education']);
          $bio = $this->con->real_escape_string($_POST['bio']);
		    $email = $this->con->real_escape_string($_POST['email']);
          $phone = $this->con->real_escape_string($_POST['phone']);
          $gender = $this->con->real_escape_string($_POST['gender']);
          $hobbiess = $this->con->real_escape_string(implode(',',$_POST['hobbiess']));
         // $fileName = $this->con->real_escape_string($_FILES['avatar']["name"]);
		    $id = $this->con->real_escape_string($_POST['id']);
		if (!empty($id) && !empty($postData)) {
         if ( !empty($_FILES["avatar"]["name"])) {
            $fileName =  $_FILES['avatar']['name'];
            $target='/var/www/html/Demo/images/' .   $fileName;
         //   echo $_FILES['file']['error']."<br>";die;
           // print_r($_FILES);die;
            if(move_uploaded_file($_FILES['avatar']['tmp_name'],$target)){
              //  print_r($_POST);die;
               $query = "UPDATE $this->usersTable SET  email = '$email', username = '$username', phone= '$phone', gender= '$gender',hobbiess='$hobbiess',first_name='$first_name',last_name='$last_name',bio='$bio',dob='$dob',education='$education',avatar= '$fileName' WHERE id = '$id'";
               $sql = $this->con->query($query);
               if ($sql==true) {
                   header("Location: profile.php?msg2=update");
               }else{
                   echo "Profile updated failed try again!";
               }
            }
         }else{
                // print_r($_POST);die;
               $query = "UPDATE $this->usersTable SET email = '$email', username = '$username',first_name='$first_name',last_name='$last_name',bio='$bio',dob='$dob',education='$education', phone= '$phone', gender= '$gender',hobbiess='$hobbiess' WHERE id = '$id'";
               $sql = $this->con->query($query);
               if ($sql==true) {
                  
                   header("Location: profile.php?msg2=update");
               }else{
                   echo "Profile updated failed try again!";
               }
            }
			
		    }

			
		}

  //-----------------------------------------------------logout---------------------------------------------------------------------------------------------------

      public function Logout()
		{
         session_destroy();
         header('Location: login.php');
      }

    

      public function displayData()
		{
         $query = "SELECT * FROM $this->usersTable ";
         $result = $this->con->query($query);
		if ($result->num_rows > 0) {
		    $data = array();
		    while ($row = $result->fetch_assoc()) {
		           $data[] = $row;
		    }
			 return $data;
		    }else{
			 echo "No found records";
		    }
		}

     // Update customer data into user table
		public function adminUpdateRecord($postData)
		{

      //   print_r($_POST);die;
         $phone = $email = "";
         if($phone = $this->con->real_escape_string($_POST['phone'])){

         if(!preg_match ("/^[0-9]*$/", $phone) ) {
           $phoneerr.= "Only numeric value is allowed.";  
           $_SESSION['phone_err_msg'] = $phoneerr;
           header("location: userEdit.php?id=".$_POST['id']);
           exit;
         }elseif (strlen ($phone) != 10){
           $phoneerr.=  "phone no must contain 10 digits."; 
           $_SESSION['phone_err_msg'] = $phoneerr;
           header("location: userEdit.php?id=".$_POST['id']);
           exit;
         }
            
        }
           
        if($email = $this->con->real_escape_string($_POST['email'])){
         $query = "SELECT * FROM $this->usersTable WHERE email = '$email'";
         $result = $this->con->query($query);
         $row = $result->fetch_assoc(); 
         if ($row['id'] !=$_POST['id'] && $result->num_rows > 0) {
            $emailErr.=  "This Email Address is already registered. Please Try another."; 
            $_SESSION['email_err_msg'] = $emailErr;
            header("location: userEdit.php?id=".$_POST['id']);
            exit;
         }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL) ) {
            $emailErr = "Invalid Email.";
           $_SESSION['email_err_msg'] = $emailErr;
           header("location: userEdit.php?id=".$_POST['id']);
           exit;
         }
            
        }

		    $username = $this->con->real_escape_string($_POST['username']);
          $first_name = $this->con->real_escape_string($_POST['first_name']);
          $last_name = $this->con->real_escape_string($_POST['last_name']);
          $dob = $this->con->real_escape_string($_POST['dob']);
          $education = $this->con->real_escape_string($_POST['education']);
          $bio = $this->con->real_escape_string($_POST['bio']);
		    $email = $this->con->real_escape_string($_POST['email']);
          $pass = $this->con->real_escape_string($_POST['pass']);
          $phone = $this->con->real_escape_string($_POST['phone']);
          $gender = $this->con->real_escape_string($_POST['gender']);
          $hobbiess = $this->con->real_escape_string(implode(',',$_POST['hobbiess']));
         // $fileName = $this->con->real_escape_string($_FILES['avatar']["name"]);
		    $id = $this->con->real_escape_string($_POST['id']);
		if (!empty($id) && !empty($postData)) {
         if ( !empty($_FILES["avatar"]["name"])) {
            $fileName =  $_FILES['avatar']['name'];
            $target='/var/www/html/Demo/images/' .   $fileName;
         //   echo $_FILES['file']['error']."<br>";die;
           // print_r($_FILES);die;
            if(move_uploaded_file($_FILES['avatar']['tmp_name'],$target)){
              //  print_r($_POST);die;
               $query = "UPDATE $this->usersTable SET  email = '$email', username = '$username', first_name='$first_name',last_name='$last_name',bio='$bio',dob='$dob',education='$education',pass= '$pass', phone= '$phone', gender= '$gender',hobbiess='$hobbiess',avatar= '$fileName' WHERE id = '$id'";
               $sql = $this->con->query($query);
               if ($sql==true) {
                   header("Location: usersList.php?msg2=update");
               }else{
                   echo "Profile updated failed try again!";
               }
            }
         }else{
              //   print_r($_POST);die;
               $query = "UPDATE $this->usersTable SET email = '$email', username = '$username', first_name='$first_name',last_name='$last_name',bio='$bio',dob='$dob',education='$education',pass= '$pass', phone= '$phone', gender= '$gender',hobbiess='$hobbiess' WHERE id = '$id'";
               $sql = $this->con->query($query);
               if ($sql==true) {
                  
                   header("Location: usersList.php?msg2=update");
               }else{
                   echo "Profile updated failed try again!";
               }
            }
			
		    }

			
		}



    
   }
?>