<?php if($this->session->flashdata('success')){?>
<!-- <p style="color:green"><?php // echo $this->session->flashdata('success');?></p>	 -->
<p class=" text-success alert-dismissable"><?php  echo $this->session->flashdata('success');?></p>
<?php } ?>

<!--error message -->
<?php if($this->session->flashdata('error')){?>
<p class=" text-danger alert-dismissable"><?php  echo $this->session->flashdata('error');?></p>
<?php } ?>


<?php $CI  = &get_instance(); 
$customerInfo = $CI->getartist_details($this->uri->segment(2));
// echo "<pre>";
// print_r($paintingdata);
?>

 <!-- my-profile edit-->
 <div class="profile-card  border-0 edit-myprofile mt-5 painting-description">
    <h1  class=" edit-heading"><b>Customer Details</b></h1> 
    <div class="profile-card  border-0 edit-myprofile mt-5 ">
        <div class="review-box d-flex justify-content-between">
<div class="d-flex  align-items-center">
            <div class="review-img">
            <img  style="width: 80px;height: 80px;border-radius: 50%;" src="<?php echo base_url('/assets/customer_image/');echo $customerInfo[0]->profile_image; ?>" alt="">
                </div>
            <div class="review-info ps-3">
                <h4><?php if (isset($customerInfo[0]->first_name)) {echo $customerInfo[0]->first_name; } ?> <?php if (isset($customerInfo[0]->last_name)) { echo $customerInfo[0]->last_name; } ?></h4>
                <small><?php if (isset($customerInfo[0]->country)) {echo $customerInfo[0]->country; } ?></small><br>
               
              
            </div>
        </div>
        <?php
    $req_id = $this->uri->segment(3);
    
        ?>
            <div class="detail-btn">
                <a href="<?php echo base_url() ?>artist_chatwithCustomer/<?php echo $req_id; ?>" class="btn btn-primary">Chat With Customer</a>
                
            </div>
           
        </div>
</div> 

</div>
    <div class="profile-card  border-0 mt-5 ms-4">
        <div class="d-flex justify-content-between description-details align-items-center">
        <h1  class=" edit-heading"><b>Painting Details</b></h1>
        <div class="detail-btn pt-0">
            <a href="#" class="btn btn-primary ">Accept Request</a>
            <a href="<?php echo base_url(); ?>cancel_custreq/<?php echo $this->uri->segment(2); ?>" class="btn btn-primary">Reject Request</a>
        </div>
    </div>
        <p class="p-details"><b>Title :</b><?php if (isset($paintingdata[0]->painting_title)) {
                                        echo $paintingdata[0]->painting_title;
                                      } ?></p>
        <p class="description-details d-flex p-0"><b>Description :</b><span><?php if (isset($paintingdata[0]->description)) {
              echo $paintingdata[0]->description;
            
            } ?></span></p>
       
 
        <div class="profile-card  border-0 painting-details mt-5">
            <p class="p-details"><b>Rough Sketches</b></p>
                <div class="select-images">
                <?php foreach($paintingdata as $sketches)
            { 
                $image_arr = explode(",", $sketches->scketch); 
                foreach($image_arr as $image_name) 
                {
              
                
                ?>

                    <img src="<?php echo base_url('assets/images/'.$image_name) ;?>" alt="">   
                    <?php
                 }  
        }
                    ?>
                </div>
            </div>
            <div class="profile-card  border-0 painting-details mt-5">
                <p class="p-details"><b>Reference Images</b></p>
                    <div class="select-images">
                    <?php foreach($paintingdata as $refimg)
            { 
                $image_arr = explode(",", $refimg->referance_image); 
                foreach($image_arr as $ref_image) 
                {
              
                
                ?>
                        <img src="<?php echo base_url('assets/images/'.$ref_image);?>" alt="">   
                        <?php
                }
            }
                        ?>
                    </div>
                </div>
                <div class="profile-card  border-0 painting-details mt-5">
                    <p class="p-details"><b>Reference Video</b></p>
                        <div class="select-images text-center">
                            <iframe width="1400" height="450" src="<?php echo $paintingdata[0]->reference_video;  ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                        </div>
                    </div>
