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
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
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
                    <form id="form" action="<?php echo base_url();?>artist_auth" method="post">

                    <h2>Artist Register</h2>

                  
                      
                    <div class="row p-3">
                                <div class="col-12">
                               
                                    <input type="text" class="form-control" placeholder="Name" name="name" id="name" required>
                                </div>
                            </div>
                            <div class="row p-3">

                                <div class="col-12">
                               
                                    <input type="email" class="form-control" placeholder="Email" name="email" id="email" required>
                                </div>
                            </div>
                            <div class="row p-3">
                                <div class="col-12">
                               
                                    <input type="password" class="form-control" placeholder="Password" name="password" id="password" required>
                                </div>
                            </div>
                            <div class="row p-3">
                                <div class="col-12">
                                    <div class="button-sec text-center">
                                    <button type="submit" class="sign-in-btn" >SUBMIT</button>
                                        <!-- <button class="sign-in-btn">Reset Password </button> -->
                                    </div>
                                </div>
                            </div>
                            <?php if($this->session->flashdata('error')){?>
                                <div class="alert alert-danger alert-dismissable mx-3"><?php  echo $this->session->flashdata('error');?></div>
                    <?php } ?>
                          
                    <?php if ($this->session->flashdata('success')) { ?>
    <!-- <p style="color:green"><?php // echo $this->session->flashdata('success');
        ?></p>	 -->
    <div class="alert alert-success alert-dismissable mx-3"  style="font-size: 15px; important">
        <?php echo $this->session->flashdata('success'); ?>
    </p>
<?php } ?>
                        </form>

                        </div>
                
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