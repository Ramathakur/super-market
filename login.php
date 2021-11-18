<?php
   session_start();
   //echo $_SESSION['user_type'];die;
?>
 <!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6 lt8"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7 lt8"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8 lt8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="UTF-8" />
        <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">  -->
        <title>Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <meta name="description" content="Login and Registration Form with HTML5 and CSS3" />
        <meta name="keywords" content="html5, css3, form, switch, animation, :target, pseudo-class" />
        <meta name="author" content="Codrops" />
        <link rel="shortcut icon" href="../favicon.ico"> 
        <link rel="stylesheet" type="text/css" href="css/demo.css" />
        <link rel="stylesheet" type="text/css" href="css/style.css" />
		<link rel="stylesheet" type="text/css" href="css/animate-custom.css" />
        <script type="text/javascript" src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    </head>
    <body>
        <div class="container">
            <!-- Codrops top bar -->
            <div class="codrops-top">
                
                <div class="clr"></div>
            </div>
            <header>
              
            </header>
            <section>				
                <div id="container_demo" >
                   
                   
                    <a class="hiddenanchor" id="tologin"></a>
                    <div id="wrapper">
                        <div id="login" class="animate form">
                            <form id="loginFormData" > 
                                <h1>Log in</h1> 
                                <p> 
                                    <label for="email" class="uname" data-icon="u" > Your email  </label>
                                    <input id="email" name="email"  type="text" placeholder="mymail@mail.com"/>
                                    <span id="emailMSG" class="text-danger" style="display: none"></span>
                                </p>
                                <p> 
                                    <label for="password" class="youpasswd" data-icon="p"> Your password </label>
                                    <input id="password" name="password"  type="password" placeholder="eg. X8df!90EO" /> 
                                    <span id="passwordMSG" class="text-danger" style="display: none"></span>
                                </p>
                                <p class="keeplogin"> 
									<input type="checkbox" name="loginkeeping" id="loginkeeping" value="loginkeeping" /> 
									<label for="loginkeeping">Keep me logged in</label>
								</p>
                                <p class="login button"> 
                                    <input type="submit" id="submit1" value="Login" /> 
								</p>
                                <p class="change_link">
									Not a member yet ?
									<a href="registration.php#toregister" class="to_register">Join us</a>
								</p>
                            </form>
                        </div>

                       
						
                    </div>
                </div>  
            </section>
        </div>


<script type="text/javascript">
    
$("#submit1").click(function(e){
   if ($("#loginFormData")[0].checkValidity()) {
     e.preventDefault();
     $.ajax({
       url : "controller/dbFunction.php",
       type : "POST",
       dataType: 'json',
       data : $("#loginFormData").serialize()+"&page=login",

       success:function(response){
      //  alert(response.user_type);
         if (response.code == "200"){
        //    Swal.fire({
        //     icon: 'success',
        //    title: 'Login successfull',
     
        //  });
    
        if(response.user_type ==0){
            $("#loginFormData")[0].reset();
       window.location.href='admin/index.php';
        }else{
            $("#loginFormData")[0].reset();
       window.location.href='profile.php?msg3=login';
        }
           } else {
           
               $("#emailMSG").html(response.emailMSG);
               $("#passwordMSG").html(response.passwordMSG);
               $("#emailMSG").css("display","block");
               $("#passwordMSG").css("display","block");
              
           }
         
       
       }

     });
   }
});
</script> 
    </body>
</html>