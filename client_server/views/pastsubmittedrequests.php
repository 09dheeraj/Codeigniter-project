<?php $CI  = &get_instance(); ?>
<div class="row mb-5">
  <?php foreach ($reqdata as $row) {

  
    // print_r($row->id);
    $artistInfo = $CI->getartist_details($row->selected_artist);
    $check_status = $CI->check_status($row->id);
    //print_r($check_status);
    //$check_status_in_temp = $CI->check_status_in_temp($row->id);


  ?>
    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
      <div class="profile-card  border-0   request-card pt-2 requested-painting">

         
         <div class="d-flex justify-content-between">
          <p style="color: grey;"><b><?php echo $row->token; ?></b></p>
        <!-- //------------------------------------------------------------------->
        <?php if (!empty($check_status)) { ?>

          <?php if (empty($check_status[0]->selected_artist)) { ?>

            <div class="complete-text text-end  Not-assigned-text">
              <span> Not Assigned</span>
            </div>

          <?php } elseif ($check_status[0]->painting_status == "0" && !empty($check_status[0]->selected_artist)) { ?>

            <div class="complete-text text-end  Pending-text">
              <span>Pending</span>
            </div>

          <?php } elseif ($check_status[0]->painting_status == "1" && !empty($check_status[0]->selected_artist)) { ?>

            <div class="complete-text text-end">
              <span>Accepted</span>
            </div>

          <?php } elseif ($check_status[0]->painting_status == "2" && !empty($check_status[0]->selected_artist)) { ?>

            <div class="complete-text text-end Cancelled-text">
              <span>Rejected</span>
            </div>
          <?php } ?>
        <?php } ?>
          </div>
        <!-- //----------------------------------------------------------------- -->
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
        <h1 class="edit-heading"><b><?php if (isset($row->painting_title)) {
                                      $titlewords = explode(' ', $row->painting_title);
                                      $maxWords = 75;
                                      $limitedtitle = implode(' ', array_slice($titlewords, 0, $maxWords));
                                      echo ucfirst($limitedtitle . '....');
                                    } ?></b>
        </h1>
        <h4>Tags : <?php if (isset($row->tag)) {
                      $tagwords = explode(' ', $row->tag);
                      $maxWords = 7;
                      $limitedtag = implode(' ', array_slice($tagwords, 0, $maxWords));
                      echo ucfirst($limitedtag . '....');
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
              <a href="<?php echo base_url(); ?>myrequest_detail/<?php echo $row->id ?>" class="btn btn-primary">View Details</a>
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