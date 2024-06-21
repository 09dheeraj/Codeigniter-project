<?php  $CI     = &get_instance(); ?>
<div class="row  mt-5">
<?php  

foreach ($purchases_painting as $data) {
  
    $painting_data = $CI->painting_data($data->painting_id);
    $artist_name = $CI->artist_name($data->artist_id);
    $getRating_review_painting = $CI->getRating_review_painting($data->painting_id);
   

    if ($getRating_review_painting['totalreview'] > 0) {
        $totalreviewDisplay = $getRating_review_painting['totalreview'];
    } else {
        $totalreviewDisplay = "0";
    }
    

    $stars = round($getRating_review_painting['avgrat']);
    $remstar = 5 - $stars;
  

    if (!empty($painting_data) && isset($painting_data[0]->painting_name)) {
    
        

?> 
            <div class="col-sm-12 mb-4">
 

                <div class=" Purchase-card "> 



                    <div class="row align-items-center">
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-5">
                            <?php $images = explode(',', $painting_data[0]->painting_image); 
                foreach($images as $img){
                ?>
                <img class="rounded-0" src="<?php echo base_url('/assets/artist_paintings/') . trim($img); ?>" alt="">
                        <?php break;} ?>
                            
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-7  ps-xl-5">
                                <div class="request-text d-flex align-items-start justify-content-between">
                              
                          
                                    <div class="review-info ">
                                     <h5><?php $fullname= $painting_data[0]->painting_name;  $maxLength = 30; if (strlen($fullname) > $maxLength) {  $shortenedText = substr($fullname, 0, $maxLength) . "..."; } else {  $shortenedText = $fullname; }  echo $shortenedText;   ?></h5>
                                     <p class="py-2"><?php for ($i = 1; $i <= $stars; $i++) { ?><i class="bi bi-star-fill pe-2"></i><?php  } ?> <?php for ($i = 1; $i <= $remstar; $i++) { ?><i class="bi bi-star pe-2"></i><?php  } ?></i>(<?php echo $totalreviewDisplay;  ?> Reviews)</p> 
                                   
                                  </div>
                                  <div class="button-sec  ">
                                    <a href="<?php echo base_url();?>individual_purchase/<?php echo $data->painting_id ;?>" class="btn btn-primary">View Details</a>
                                </div>
                                 </div>
                                 <p><?php $full_description= $painting_data[0]->painting_description;  $maxLength = 75; if (strlen($full_description) > $maxLength) {  $shortenedText = substr($full_description, 0, $maxLength) . "..."; } else {  $shortenedText = $full_description; }  echo $shortenedText;   ?></p>
                                 <div class="row">
                                    <div class="col-6 text-start">
                                        <p> Painting size</p>
                                        <p>Painting Type</p>
                                        <p>Artist Name</p>
                                        <p>Purchase Date</p>
                                    </div>
                                    <div class="col-6 text-start">
                                        <p><?php echo $painting_data[0]->painting_size; ?></p> 
                                        <p><?php
                                            $cat_array = explode(",", $painting_data[0]->painting_category);
                                          $i = 1;
                                          foreach ($cat_array as $cate_ID) {
                                              $category_title = $CI->getpaintingcategorynamebyid($cate_ID);
                                              echo " ".$category_title[0]->title;
                                              if (count($cat_array) != 1 && count($cat_array) != $i) {
                                                  echo ',';
                                              }
                                              $i++;
                                          }
                                          ?></p> 
                                        <p><?php echo $artist_name[0]->artist_fname; ?><?php echo $artist_name[0]->artist_lname; ?></p> 
                                        <p><?php echo date('d, F, Y', strtotime($data->created_at)); ?></p> 
                                    </div>
                                </div>
                                <h4 class="text-start p-0"><?php echo "$".$data->price; ?></h4>
                                </div>
                    </div>
                   
                    </div>
                    
                </div>
               
              
                <?php }} ?> 
            </div>
               
               
                      
    </div>
</div>
</div>
