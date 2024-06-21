<div class="row">
       
    </div>

    <div class="profile-card  border-0 mt-5 ">
        <h1  class=" edit-heading"><b>Painting Details</b></h1>
        <p class="description-details"><b>Title :</b><?php if (isset($title[0]->painting_title)) {
                                        echo $title[0]->painting_title;
                                      } ?></p>
        <p class="description-details d-flex p-0"><b>Description :</b><span><?php if (isset($description[0]->description)) {
              echo $description[0]->description;
            
            } ?></span></p>
       
 
        <div class="profile-card  border-0 painting-details mt-5">
            <p class="p-details"><b>Rough Sketches</b></p>
                <div class="select-images">
            <?php foreach($Sketches as $sketches)
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
                    <?php foreach($Images as $refimg)
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


                        <iframe width="1400" height="450" src="<?php echo $Video[0]->reference_video;  ?>" title="YouTube video player" frameborder="0" allow="accelerometer;  clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen=""></iframe>
                           

                        </div>
                    </div>
            </div>
                <br>
                <div class="col-12 ">
                <button type="submit"  style="margin-left: 82%" class="btn btn-primary">Accept Request</button>
                 </div>

                   
                        
                    </div>
                </div>
    </div>
  
 
    