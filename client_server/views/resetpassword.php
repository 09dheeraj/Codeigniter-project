<!doctype html>
<html lang="en">
   <head>
      <link rel="icon"  href="<?php echo base_url();?>assets/images/logo.png">
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title><?php echo $page_title; ?></title>
      <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.css">
      <link rel="stylesheet" href="<?php echo base_url();?>assets/css/style.css">
      <link rel="stylesheet" href="<?php echo base_url();?>assets/css/responsive.css">
      <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
      </head>
<body>
<div class="data">
    <div class="content">
        <div class="sign-up-banner">
            <div class="logo-sec text-center ">
                <img src="<?php echo base_url();?>assets/images/logo-3.png" alt="">
            </div>
            <div class="Sign-up-form sign-in-form  forgot-form">
               
              
                  
                    <div class="tab" id="login_div">
                    <form id="form" action="<?php echo base_url();?>createPasswordUser" method="post">
                       <h2>Reset Password </h2>
                            <div class="row p-3">
                                <div class="col-12">
                              
                                <input type="hidden" class="form-control form-control-lg" name="token" value="<?php echo $resetTok; ?>" >
                                    <input type="password" class="form-control" placeholder="Enter new password" name="pass" id="password" required>
                                </div>
                            </div>
                            <div class="row p-3">
                                <div class="col-12">
                               
                                    <input type="password" class="form-control" placeholder="Confirm Password" name="cpass" id="confirm_password" required>
                                    <span id='message' style="color: brown; important!"></span>
                                </div>
                            </div>
                            <div class="row p-3">
                                <div class="col-12">
                                    <div class="button-sec text-center">
                                    <input type="submit" class="sign-in-btn " ></input>
                                        <!-- <button class="sign-in-btn">Reset Password </button> -->
                                    </div>
                                   
                                </div>
                            </div>
                           
                        </form>
                        </div>
                
            </div>

        </div>
    </div>
</div>
         </body>
         </html>
<!-- <script type="text/javascript">


        $(document).ready(function() {
            
    $("#form").validate({
        rules: {
            ignore: [],
         
            cpass: {
                
                equalTo: "#password",
            },
        },
        messages: {
            cpass: {
                
                equalTo: 'Passwords does not match',
            }
        },
    });
});
</script> -->
<script>
  $(document).ready(function() {
    
    $("#form").submit(function(event) {
     
      var password = $("#password").val();
      console.log(password);
      var confirmPassword = $("#confirm_password").val();
      console.log(confirmPassword);

    
      if (password !== confirmPassword) {
        $("#message").text("Passwords does not match!");
       
        event.preventDefault();
      } else {
       
        this.submit();
      }
    });
  });
</script>


<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/additional-methods.min.js"></script>