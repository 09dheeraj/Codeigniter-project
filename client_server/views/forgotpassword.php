<!doctype html>
<html lang="en">
   <head>
      <link rel="icon"  href="<?php  echo base_url();?>assets/images/logo.png">
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title><?php echo $page_title;?></title>
      <link rel="stylesheet" href="<?php  echo base_url();?>assets/css/bootstrap.css">
      <link rel="stylesheet" href="<?php  echo base_url();?>assets/css/style.css">
      <link rel="stylesheet" href="<?php  echo base_url();?>assets/css/responsive.css">
      <!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" /> -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
      </head>
<body>
<div class="data">
    <div class="content">
        <div class="sign-up-banner">
            <div class="logo-sec text-center ">
                <img src="<?php  echo base_url();?>assets/images/logo-3.png" alt="">
            </div>
            <div class="Sign-up-form sign-in-form forgot-form">
               

            <form action="<?php  echo base_url();?>resetPasswordUser" method="post">
                  <h2><?php echo $title; ?></h2>
                  <p>You can reset your password here.</p>
                    <div class="tab" id="login_div">
                    <div class="row p-3">
                        <div class="col-12">
                            <input type="email" class="form-control" placeholder="Email" name="email">
                        </div>
                    </div>
                    
                   
                  
                    <div class="row p-3">
                        <div class=" col-12">
                            <!-- <a class=" text-decoration-none" href="./reset-password.html"> -->
                            <div class="button-sec ">
                            <button type="submit" class="sign-in-btn ">Submit</button>
                             <!-- <a href="./reset-password.html" class="sign-in-btn text-decoration-none"> Continue</a> -->
                            </div>
                    
                       
                        </div>
                        
                   
                    </div>
                   
                    </div>
                    <?php
                        $success = $this->session->flashdata('success');
                            if($success)
                   {
                  ?>
                  <div class="alert alert-success alert-dismissable mx-3">
                 <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> -->
                  <?php echo $success; ?>
                   </div>
                  <?php } ?>
                   
                </form>
            </div>

        </div>
    </div>
</div>
<script>
        var timeout = 3000; // in miliseconds (3*1000)

        $('.alert').delay(timeout).fadeOut(300);
        </script>

         </body>
         </html>
         