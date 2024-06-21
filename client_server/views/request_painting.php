<?php $CI  = &get_instance(); ?>
<div class="row mb-5">

  <?php 
  
  foreach ($artist_request_painting as $row) {
    $gettoken = $CI->getrandomtoken($row->tem_paint_id);
    //  echo "<pre>";print_r($row);
    //  $artistInfo = $CI->getartist_details($row->artist_Id);


  ?>

    <?php if ($this->session->flashdata('success')) { ?>
      <p class=" time text-success alert-dismissable">
        <?php echo $this->session->flashdata('success'); ?>
      </p>
    <?php } ?>
    <?php if ($this->session->flashdata('error')) { ?>
      <p class=" time text-danger alert-dismissable">
        <?php echo $this->session->flashdata('error'); ?>
      </p>
    <?php } ?>
    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
      <div class="profile-card  border-0   request-card pt-4 requested-painting">
        <?php if (isset($row->req_status)) {
          if ($row->req_status == 1) { ?>

            <div class="complete-text text-end"><span> <?php echo "Complete"; ?></span></div>
          <?php } elseif ($row->req_status == 2) { ?>
            <div class="complete-text text-end Cancelled-text"><span><?php echo "Cancelled"; ?></span></div>
          <?php } else { ?>
            <!-- <div class="complete-text text-end Pending-text"><span><?php echo "Pending"; ?></span></div> -->
        <?php }
        } ?>
        <small class="float-end"><?php if (isset($row->date)) {
                                    $d = $row->date;
                                    $newdate = date("d M, Y", strtotime($d));
                                    echo $newdate;
                                  } ?></small>
        <h1 class=" edit-heading"><b><?php if (isset($row->painting_title)) {
                                        echo ucfirst($row->painting_title);
                                      } ?></b></h1>
        <h4>Tags : <?php if (isset($row->tag)) {
                      echo ucfirst($row->tag);
                    } ?></h4>
        <!-- <p><?php //if (isset($row->description)) {
                // $descriptionWords = explode(' ', $row->description);
                // $maxWords = 7;
                // $limitedDescription = implode(' ', array_slice($descriptionWords, 0, $maxWords));
                // echo $limitedDescription . '....';
                // } 
                ?></p> -->
        <div class="row align-items-center">
          <div class="col-sm-8 col-md-8 col-lg-12 col-xl-12 col-xxl-8">



            <!-- <div class="request-text d-flex "> -->
            <!-- <img src="<?php //echo base_url('/assets/artist_image/'); if(isset($artistInfo[0]->profile_image)){echo $artistInfo[0]->profile_image;} 
                            ?>" alt=""> -->
            <!-- <div class="review-info"> -->
            <!-- <h5><? php // if (isset($artistInfo[0]->artist_fname)) {
                      // echo $artistInfo[0]->artist_fname;
                      // } 
                      ?> <?php //if (isset($artistInfo[0]->artist_lname)) {
                          //echo $artistInfo[0]->artist_lname;
                          //  } 
                          ?></h5> -->
            <!-- <span class="star-icons align-top"> -->


            <?php


            // $getartist_review =  $CI->getartist_review($row->artist_Id);
            // //print_r($getRating_review);
            //   if ($getartist_review['totalreview'] > 0) {
            //       $totalartistreviewDisplay = $getartist_review['totalreview'];

            //   } else {
            //       $totalartistreviewDisplay = "0";
            //   }


            // $artiststars = round($getartist_review['avgrat']);
            // $remartiststar = 5 - $artiststars;



            // for ($i = 0; $i < $artiststars; $i++) {

            //   echo '<i class="bi bi-star-fill "></i>';
            // }

            // for ($i = 0; $i < $remartiststar; $i++) {


            //   echo '<i class="bi bi-star"></i>';
            // }
            ?>
            <!-- </span>
              </div>
            </div> -->
          </div>
          <div class="col-sm-4 col-md-4 col-lg-12 col-xl-12 col-xxl-4">
            <div class="card-btn">
              <a href="<?php echo base_url(); ?>submit_painting/<?php echo $row->tem_paint_id ?>" class="btn btn-primary">View Details</a>
            </div>

          </div>
        </div>
      </div>
    </div>





  <?php } ?>

</div>
</div>
</div>




</body>

</html>