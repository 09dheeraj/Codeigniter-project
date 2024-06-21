<?php $CI  = &get_instance(); 
$artistInfo = $CI->getartist_details($this->uri->segment(3));

?>

<div class="row">
        <div class="col-12 text-end">
            <a href="<?php echo base_url('artists_list');?>" class="text-Browse">Browse More Artists</a>
        </div>
    </div>
 <!-- my-profile edit-->
 <div class="profile-card  border-0  mt-5 Painting-req">
    <h1  class=" edit-heading"><b>Assigned Painting Request</b><small class="float-end"><b><?php if (isset($artistdata[0]->date)) { $d = $artistdata[0]->date;
        $newdate = date("d M, Y", strtotime($d));
             echo $newdate;  } ?></b></small></h1> 
    <div class="profile-card  border-0  mt-4">
        <div class="review-box d-flex justify-content-between">
<div class="d-flex">
            <div class="review-img">
            <img src="<?php echo base_url('/assets/artist_image/');echo $artistInfo[0]->profile_image; ?>" alt="">
                </div>
            <div class="review-info ps-3">
                <h4><?php if (isset($artistInfo[0]->artist_fname)) {echo $artistInfo[0]->artist_fname; } ?> <?php if (isset($artistInfo[0]->artist_lname)) { echo $artistInfo[0]->artist_lname; } ?></h4>
                <small><?php if (isset($artistInfo[0]->country)) {echo $artistInfo[0]->country; } ?></small><br>
                <span class="star-icons "><small class="pe-2"><?php 
                if (isset($artistInfo[0]->category))   {                                                                                                                        

                    $cat_array = explode(",", $artistInfo[0]->category);
                    $i = 1;
                    foreach ($cat_array as $cate_ID) {
                    $category_title = $CI->getcategorynamebyid($cate_ID);
                    if(isset($category_title[0]->title)){
                    echo $category_title[0]->title;
                    if (count($cat_array) != 1  && count($cat_array) != $i) {
                        echo ',';
                    }
                    $i++;
                    }}
                    }
                    ?></small>
    <?php
$getartist_review =  $CI->getartist_review($this->uri->segment(3));
  if ($getartist_review['totalreview'] > 0) {
      $totalartistreviewDisplay = $getartist_review['totalreview'];
      
  } else {
      $totalartistreviewDisplay = "0";
  }


  $artiststars = round($getartist_review['avgrat']);
  $remartiststar = 5 - $artiststars;


for ($i = 0; $i < $artiststars; $i++) {

  echo '<i class="bi bi-star-fill "></i>';
}

for ($i = 0; $i < $remartiststar; $i++) {


  echo '<i class="bi bi-star"></i>';
}
?></span><br>
                <span class="request-accept">Accepted</span>
              
            </div>
        </div>
            <div class="detail-btn p-0">
                <a href="<?php echo base_url();?>customer_chatwithartist/<?php echo  $this->uri->segment(2); ?>/<?php echo  $this->uri->segment(3); ?>" class="btn btn-primary contact-me">Chat with Artist</a>
            </div>
           
        </div>
</div> 

</div>
    <div class="profile-card  border-0 mt-5 ">
        <h1  class=" edit-heading"><b>Painting Details</b></h1>
        <p class="description-details"><b>Title :</b><?php if (isset($artistdata[0]->painting_title)) {
                                        echo $artistdata[0]->painting_title;
                                      } ?></p>
        <p class="description-details d-flex p-0"><b>Description :</b><span><?php if (isset($artistdata[0]->description)) {
              echo $artistdata[0]->description;
            
            } ?></span></p>
       
 
        <div class="profile-card  border-0 painting-details mt-5">
            <p class="p-details"><b>Rough Sketches</b></p>
                <div class="select-images">
            <?php foreach($artistdata as $sketches)
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
                    <?php foreach($artistdata as $refimg)
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


                        <iframe width="1400" height="450" src="<?php echo $artistdata[0]->reference_video;  ?>" title="YouTube video player" frameborder="0" allow="accelerometer;  clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen=""></iframe>
                           

                        </div>
                    </div>
            </div>
            <div class="profile-card  border-0 painting-details mt-5 mb-5">
                <p  class="p-details"><b>Submitted by Artist</b></p>
                    <div class="select-images ">

                    <?php foreach($artistdata as $submit)
            { 
                $image_arr = explode(",", $submit->sub_by_artist); 
                foreach($image_arr as $submit_img) 
                {
              
                
                ?>
                        <img src="<?php echo base_url('assets/images/'.$submit_img);?>" alt="">   
                        <?php
                }
            }
                        ?>
                        
                    </div>
                </div>
    </div>