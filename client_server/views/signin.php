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
      <!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" />
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
      </head>
      <body>
    

      <?php 
       $error = $this->session->flashdata('error');
      $return = $this->session->flashdata('return');
      if(isset($signin_page_name)){

      }
      else {
        $signin_page_name = '';
      }
       unset($_SESSION['error']);
      
       $signinError = $this->session->flashdata('signinError');

       $success = $this->session->flashdata('success');


 

      ?>
<div class="data">
    <div class="content">
        <div class="sign-up-banner">
            <div class="logo-sec text-center p-4">
                <img src="<?php echo base_url();?>assets/images/logo-3.png" alt="">
            </div>
<div class="Sign-up-form sign-in-form">               

                <form  action="<?php echo base_url(); ?>login" method="POST">
                    <div class= "row p-3">
                        <div class="col-12">
                            <div class="button-sec d-flex">
                                <a href="<?php echo base_url(); ?>auth" 
                                <?php if(!empty($signin_page_name)) 
                                {
                                    if($signin_page_name == "signin")
                                    {
                                        echo 'class="btn btn-light active"';
                                    }
                                    
                                 
                                }
                                else { echo ' btn btn-light text-decoration-line: none; "'; }
                                
                                ?>  class="btn btn-light " id="signin">Sign in</a>
                                <a href="<?php echo base_url(); ?>auth"
                                <?php if(!empty($signin_page_name) or !empty($return) ) 
                                {
                                    if($signin_page_name == "signup" or $return == "signup" ) 
                                    
                                    {echo 'class="btn btn-light active"';}
                                }
                                
                             ?> class="btn btn-light" id="signup" >Sign up</a>
                            </div>
                         
                        </div>
                    </div>
                    
                    <div class="tab" id="login_div"  <?php 
                  //  print_r($signin_page_name);
                                    if($signin_page_name == "signup" || $return == "signup" ) 
                                    
                                    { 
                                       
                                        echo  'style="display: none;"';
                                    }
                                 ?>>
                   
                    <div class="row p-3">
                        <div class="col-12">
                            <input type="email" class="form-control" placeholder="Email" name="email" value="" required>
                        </div>
                    </div>
                    <div class="row p-3">
                        <div class="col-12">
                            <input type="password" class="form-control"placeholder="Password" name="password" required >
                        </div>
                    </div>
                    <div class="row p-3">
                        <div class=" col-12">
                            <p class=" forgot-pass"><a class="text-decoration-none" href="<?php echo base_url('forgotpassword'); ?>">Forgot Password ?</a></p>
                            </div>
                        </div>
                    <div class="row p-3">
                        <div class=" col-12">
                            <div class="button-sec ">
                                <button  type="submit" class="sign-in-btn">Sign in</button>
                            </div>
                        </div>
                    </div>
                    <?php
                    $this->load->helper('form');
                    
                    if($signinError)
                    {
                ?>
                <div class="alert alert-danger alert-dismissable mx-3">
                    <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button> -->
                    <?php echo $signinError;
                    unset($_SESSION['signinError']);
                    ?>                    
                </div>
                <?php } ?>
                
            
                   
                    </div>
                  
                    
                     
                </form>
           
                  
                <div class="tab" id="signup_div" style="display:block"  <?php  
                                
                                    if($signin_page_name == "signup" or $return == "signup" ) 
                                    
                                    {echo  'style="display: block!important;"';}
                                 ?> >
                 
                        <form action="<?php echo base_url(); ?>auth" method="POST">

                            <div class="row p-3">
                                <div class="col-12">
                                   
                                    <input type="text" class="form-control" placeholder="Name" name="username"  required  value="<?= set_value('username');?>">
                            
                                </div>
                            </div>
                           
                            <div class="row p-3">
                                <div class="col-12">
                                  
                                    <input type="email" class="form-control" placeholder="Email" name="useremail" value="<?php echo set_value('useremail');?>" required  pattern="^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$" onblur="validateEmail(this);">
                                    <!-- <div class="alert alert-danger alert-dismissable" id="demo"></div> -->
                                    

                                </div>
                            </div>
                            <div class="row p-3">
                                <div class="col-12">
                               
                                    <input type="password" class="form-control" placeholder="Password" name="userpassword" required   >
                                    

                                </div>
                            </div>
                            <div class="row p-3">
                                <div class="col-12">
                                    <div class="button-sec text-center">
                                      <button  type="submit" class="sign-in-btn" value="Submit signup_div">Sign up</button>
                                    </div>
                                </div>
                            </div>
                           
                            <?php
                   
                   
                    
                    if($error)
                    {
                ?>
                <div class="alert alert-danger alert-dismissable mx-3">
                    <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> -->
                    <?php echo $error; ?>                    
                </div>
                <?php } ?>
                <?php  
              
             
                 
                // if($success)
                //    {
                //   ?>
                  <!-- <div class="alert alert-success alert-dismissable mx-3"  style="font-size: 15px; important"> -->
                 <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> -->
              <?php //echo $success; ?>
                  </div>
                  <?php //} ?>
                  <?php if ($this->session->flashdata('success')) { ?>
    <!-- <p style="color:green"><?php // echo $this->session->flashdata('success');
        ?></p>	 -->
    <div class="alert alert-success alert-dismissable mx-3"  style="font-size: 15px; important">
        <?php echo $this->session->flashdata('success'); ?>
    </p>
<?php } ?>

<!--error message -->
<!-- <?php // if ($this->session->flashdata('error')) { ?>
    <p class="alert text-danger alert-dismissable">
        <?php// echo $this->session->flashdata('error'); ?>
    </p> -->
<?php //} ?>

                        </form>
                        
                        </div>
            </div>
            </div>
    </div>
</div>


<script>
    $(document).ready(function(){
<?php 
        if($signin_page_name == "signup" or $return == "signup" )
        {
            
        }
        else {?>
            $('#signup_div').hide();
        <?php }?>

        

        $('#signin').click(function(e) {
   e.preventDefault();
   $(this).addClass('active');
   $('#signup').removeClass('active');
   $('#login_div').show();
   $('#signup_div').hide();
  //Should appear after $('.login__form').show(); because if it's before that, the register form doesn't exist in the DOM
 });
 $('#signup').click(function(e) {
   e.preventDefault();
   $(this).addClass('active');
   $('#signin').removeClass('active');
   $('#signup_div').show();
   $('#login_div').hide();
  //Should appear after $('.register__form').show(); because if it's before that, the register form doesn't exist in the DOM
 });
    });





    </script>
    <script>
        var timeout = 3000; // in miliseconds (3*1000)

        $('.alert').delay(timeout).fadeOut(300);
        </script>



         </body>
         </html>
           