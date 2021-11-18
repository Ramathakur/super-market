<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6 lt8"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7 lt8"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8 lt8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="UTF-8" />
        <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">  -->
        <title>Registration</title>
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
                   
                    <a class="hiddenanchor" id="toregister"></a>
                   
                    <div id="wrapper">
                      

                        <div id="register" class="animate form">
                            <form    id="formData"> 
                         
                                <h1> Sign up </h1> 
                                <p> 
                                    <label for="username" class="uname" data-icon="u">Your username</label>
                                    <input id="username" name="username"  type="text" placeholder="mysuperusername690" />
                                    <span id="nameMSG" class="text-danger" style="display: none"></span>
                                </p>
                                <p> 
                                    <label for="email" class="youmail" data-icon="e" > Your email</label>
                                    <input id="email" name="email"  type="text" placeholder="mysupermail@mail.com"/> 
                                    <span id="emailMSG" class="text-danger" style="display: none"></span>
                                </p>
                                <p> 
                                    <label for="password" class="youpasswd" data-icon="p">Your password </label>
                                    <input id="password" name="password"  type="password" placeholder="eg. X8df!90EO"/>
                                    <span id="passwordMSG" class="text-danger" style="display: none"></span>
                                </p>
                                <p> 
                                    <label for="password_confirm" class="youpasswd" data-icon="p">Please confirm your password </label>
                                    <input id="password_confirm" name="password_confirm" type="password" placeholder="eg. X8df!90EO"/>
                                    <span id="password_confirmMSG" class="text-danger" style="display: none"></span>
                                </p>
                                <p class="signin button"> 
                                <input type="submit" value="Sign up" id="submit"/> 
                              </p>
                                              <p class="change_link">  
                                Already a member ?
                                <a href="login.php" class="to_register"> Go and log in </a>
                              </p>
                            </form>
                        </div>
						
                    </div>
                </div>  
            </section>
        </div>


<script type="text/javascript">

     $("#submit").click(function(e){
        if ($("#formData")[0].checkValidity()) {
          e.preventDefault();
          $.ajax({
            url : "controller/dbFunction.php",
            type : "POST",
            dataType: 'json',
            data : $("#formData").serialize()+"&action=insert",

            success:function(response){
            // alert(response);
                if (response.code == "200"){
            //     Swal.fire({
            //     // icon: 'success',
            //     title: 'Registration Successful',
            //   });
           
               $("#formData")[0].reset();
                window.location.href='profile.php?msg1=insert';
                } else {

                
                 
                    $("#emailMSG").html(response.emailMSG);
                    $("#passwordMSG").html(response.passwordMSG);
                    $("#password_confirmMSG").html(response.password_confirmMSG);
                    $("#nameMSG").html(response.nameMSG);
                 
                    $("#emailMSG").css("display","block");
                    $("#passwordMSG").css("display","block");
                    $("#password_confirmMSG").css("display","block");
                    $("#nameMSG").css("display","block");
                }
              
            
            }

          });
        }
    });
</script> 
    </body>
</html>