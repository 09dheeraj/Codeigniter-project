 <!-- my-profile about-->
 <div class="profile-card  border-0 edit-card">
 <div class="row ">
    <div class="col-12">
    <div class="edit-profile  d-flex justify-content-end">
                    <a href="<?php echo base_url(); ?>editcustomer_profile"  class="btn btn-primary text-decoration-none">
                      
                            <span class="btn-label"><i class="bi bi-pencil-fill"></i></span>
                            Edit Profile
                    </a>
                </div>
</div>
</div>


    <div class="row align-items-center">
        <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4 col-xxl-3">
            <div class="my-profile">
                <?php $sessionData = $this->session->userdata('profile_image'); ?>
                <img src="<?php echo base_url('/assets/customer_image/');
                echo $sessionData; ?>" alt="">
            </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-8 col-xl-8 col-xxl-9">
                
            <div class="customer-information"> 
                <div class="row">
                    <div class="col-6 col-sm-4  col-md-5 col-lg-5  col-xl-2"><p> Name :</p> </div>
                    <div class="col-6 col-sm-5  col-md-5 col-lg-5  col-xl-3"> <p><span><?php if (isset($custInfo[0]->first_name)) {
                        echo $custInfo[0]->first_name;
                    } ?>
                <?php if (isset($custInfo[0]->last_name)) {
                    echo $custInfo[0]->last_name;
                } ?></span></p> </div>
                     <div class="col-6 col-sm-4  col-md-5 col-lg-5  col-xl-2"> <p> Email :</p> </div>
                    <div class="col-6 col-sm-5  col-md-5 col-lg-5  col-xl-5"><p><span><?php echo $this->session->userdata('email'); ?></span></p></div>
                 </div>
                 <div class="row">
                    <div class="col-6 col-sm-4  col-md-5 col-lg-5  col-xl-2"><p> Username :</p> </div>
                    <div class="col-6 col-sm-5  col-md-5 col-lg-5  col-xl-3"> <p><span><?php echo $this->session->userdata('user_name'); ?></span></p> </div>
                     <div class="col-6 col-sm-4  col-md-5 col-lg-5  col-xl-2"> <p> Address  :</p> </div>
                    <div class="col-6 col-sm-5 col-md-5 col-lg-6  col-xl-5"><p><span><?php if (isset($custInfo[0]->address1)) {
                                        echo $custInfo[0]->address1;
                                    } ?></span></p></div>
                 </div>
                 <div class="row">
                    <div class="col-6 col-sm-4  col-md-5 col-lg-5  col-xl-2"><p> Phone no  :</p> </div>
                    <div class="col-6 col-sm-5  col-md-5 col-lg-5  col-xl-3"> <p><span><?php if (!empty($custInfo[0]->mobile)) {
                                        echo $custInfo[0]->mobile;
                                    } else {
                                        echo "<br>";
                                    } ?></span></p> </div>
                     <div class="col-6 col-sm-4  col-md-5 col-lg-5 col-xl-2 "> <p> Country  :</p> </div>
                    <div class="col-6 col-sm-5  col-md-5 col-lg-5 col-xl-5 "><p><span><?php if (isset($custInfo[0]->country)) {
                                        echo $custInfo[0]->country;
                                    } ?></span></p></div>
                 </div>
                 <div class="row">
                    <div class="col-6 col-sm-4  col-md-5 col-lg-5  col-xl-2"><p>City  :</p> </div>
                    <div class="col-6 col-sm-5  col-md-5 col-lg-5  col-xl-3"> <p><span><?php if (isset($custInfo[0]->city)) {
                                        echo $custInfo[0]->city;
                                    } ?></span></p> </div>
                     <div class="col-6 col-sm-4  col-md-5 col-lg-5 col-xl-2 "> <p> Zip  :</p> </div>
                    <div class="col-6 col-sm-5  col-md-5 col-lg-5  col-xl-5"><p><span><?php if (!empty($custInfo[0]->zip)) {
                                        echo $custInfo[0]->zip;
                                    } else {
                                        echo " ";
                                    } ?></span></p></div>
                 </div>
            </div>
                       
        </div>
                </div>                         
                </div>
   
<div class="about-myprofile  mb-5">
        <h1  class=" section-heading"><b>About Me</b></h1> 
       <div class="row">
        <div class="col-12">
            <p><?php if (isset($custInfo[0]->about_me)) {
                        echo $custInfo[0]->about_me;
                    } ?></p>
        </div>
       </div>
        </div>

</div>
 </div>
 </div>
