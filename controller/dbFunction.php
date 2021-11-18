<?php
   session_start();
?>
<?php
   // Include config.php file
   include_once('../model/dbConnect.php');
   $dbObj = new Database();



//-------------------------Login-------------------------------------------------

   
if (isset($_POST['page']) && $_POST['page'] == "login") {
    //echo "hii";die;
       $emailMSG=  $passwordMSG =  "";
    
        $emailid =  $password = "";
       
        /* EMAIL */
        if (empty($_POST["email"])) {
            $emailMSG .= "Email is required";
        } else if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            $emailMSG .= "Invalid email format";
        }else {
            $emailid = $_POST["email"];
        }
        
        
        /* PASSWORD */
        if (empty($_POST["password"])) {
            $passwordMSG .= "Password is required";
        } else {
            $password = $_POST["password"];
        }
        
        
           $record =  $dbObj->getloginRecord( $emailid, $password);
           $_SESSION['id'] = $record['id'];
            $type = $record['user_type'];
            $_SESSION['username']=$record['username'];
        // print_r ($_SESSION['user_type']);die;
       if($record['email']!= $emailid){
         $emailMSG .= "Invalid EmailId ";
       }elseif($record['pass']!= $password){
         $passwordMSG .= "Invalid Password";
       }
         if(empty($emailMSG) && empty($passwordMSG)){
             $mssg = "email: ".$email.", password: ".$password ;
             echo json_encode(['code'=>200, 'mssg'=>$mssg, "user_type"=>$type]);
             exit;
             }
       
          
            $arry = array(
           
            "emailMSG"=>$emailMSG,
            "passwordMSG"=>$passwordMSG,
          
            );
    
    
        echo json_encode( $arry);
        
        
    
        
        }


//--------------------------------------------------Registration---------------------------------------------------------------------------------------------        

   // Insert Record   
   if (isset($_POST['action']) && $_POST['action'] == "insert") {
   
     $nameMSG =  $emailMSG=  $passwordMSG = $password_confirmMSG = "";

    $username =  $emailid =   $password = $password_confirm ="";
    /* NAME */
    if (empty($_POST["username"])) {
        
        $nameMSG = "Username is required";
    } else {
        $username = $_POST["username"];
    }
    
    
    /* EMAIL */
    if (empty($_POST["email"])) {
        $emailMSG .= "Email is required";
    } else if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $emailMSG .= "Invalid email format";
    }else {
        $emailid = $_POST["email"];
    }
    
    
    /* PASSWORD */
    if (empty($_POST["password"])) {
        $passwordMSG .= "Password is required";
    } else {
        $password = $_POST["password"];
    }
    
    
    /* COINFIRM PASSWORD */
    if (empty($_POST["password_confirm"])) {
        $password_confirmMSG .= "Confirm Password is required";
    } else {
        $password_confirm = $_POST["password_confirm"];
    }
    if($password ==  $password_confirm){
        $email = $dbObj->isUserExist($emailid); 
        if(!$email){ 
             $dbObj->insertRecond($username, $emailid, $password);

         }else{
             $emailMSG .= "Email Already Exist";
         }
        
       }else{
        
         $password_confirmMSG .= "Password Not Match";
       }
    
    
 
    if(empty($nameMSG) && empty($emailMSG) && empty($passwordMSG) &&empty($password_confirmMSG)){
        $msg = "username: ".$username.", email: ".$email.", password: ".$password.", password_confirm:".$password_confirm;
        echo json_encode(['code'=>200, 'msg'=>$msg]);
        exit;
    }
   $arr = array(
    
    "emailMSG"=>$emailMSG,
    "passwordMSG"=>$passwordMSG,
    "password_confirmMSG"=>$password_confirmMSG,
    "nameMSG " => $nameMSG
   );


    echo json_encode( $arr);
    
    
}



         
      

?>
