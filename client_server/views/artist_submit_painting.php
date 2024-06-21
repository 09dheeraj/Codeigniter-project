<?php $CI = &get_instance();
$temp_id = $this->uri->segment(2);
$check_status = $CI->check_status($temp_id);
//print_r($check_status);
$get_cus_id = $CI->get_cus_id($temp_id);

$cus_id = $get_cus_id[0]->customer_id;


$get_cus_detail = $CI->get_cus_detail($cus_id);
$get_coustomer_date = $CI->get_coustomer_date($get_cus_detail[0]->reg_id);

//$getCUSTOMERID = $CI->temp_customer_id($request_data[0]->customer_id);

//print_r($get_cus_detail);
$timestamp = $get_coustomer_date[0]->created_at;
$dateTime =date("d M, Y", strtotime($timestamp));


?>

<div class="profile-card  border-0  mt-5 mb-5 Painting-req pt-4">
  <h1 class=" edit-heading"><b>Requested Customer</b><small class="float-end"><b><?php echo $dateTime; ?></b></small></h1> 
    <div class="profile-card  border-0  mt-4">
    <div class="review-box d-flex justify-content-between">
      <div class="d-flex">
        <div class="review-img">
          <img src="<?php echo base_url(); ?>/assets/customer_image/<?php if(!empty($get_cus_detail)){ echo $get_cus_detail[0]->profile_image;  } ?>" alt="">
        </div>
        <div class="review-info ps-3 assigned-artist-name">
          <h4><?php if(!empty($get_cus_detail)){ echo ucfirst($get_cus_detail[0]->first_name) ;} ?> <?php if(!empty($get_cus_detail)){   echo ucfirst($get_cus_detail[0]->last_name) ;} ?></h4>
          <small><?php if(!empty($get_cus_detail)){ echo $get_cus_detail[0]->country; }?></small><br>
          <!-- <span class="star-icons "><small class="pe-2"><?php// if(!empty($request_data[0]->painting_title)){echo $request_data[0]->painting_title;} ?></small>  </span> -->
          <!-- <span class="star-icons "><small class="pe-2">Realism Painting Artist</small></span> -->
        </div>
      </div>
      <div class="detail-btn p-0">
      <?php   
if ($check_status[0]->painting_status == "1")
{?>

<a href="<?php echo base_url() ?>artist_chatwithCustomer/<?php echo $this->uri->segment(2); ?>/<?php echo $cus_id;?>" class="btn btn-primary ">Chat With Customer</a>
     <?php }?>
              </div>
    </div>
          </div>
  </div>

<div class="request-detail mb-5 p-4">
  <?php if (empty($check_status[0]->painting_status)) { ?>
    <div class="text-end">
      <a href="<?php echo base_url(); ?>accept_painting/1/<?php echo $temp_id ?>" class="btn btn-success" id="AcceptSubmittedPainting">Accept</a>
      <a href="<?php echo base_url(); ?>reject_painting/2/<?php echo $temp_id ?>" class="btn btn-danger" id="AcceptSubmittedPainting">Reject</a>
      <!-- <a href="<?php echo base_url('Reject_Submitted_Painting'); ?>/<?php echo $this->uri->segment(2); ?>" class="btn btn-danger" id="RejectSubmittedPainting">Reject</a> -->
    </div>
  <?php } ?>

  <?php  $getCUSTOMERID = $CI->temp_customer_id($request_data[0]->painting_id); 
  

  
  ?>

  <p class="description-details m-0"><b>Title :</b>
    <?php if (isset($request_data[0]->painting_title)) {
      echo ucfirst($request_data[0]->painting_title);
    } ?>
  </p>
  <p class="description-details m-0 pt-0"><b>Tag :</b>
    <?php if (isset($request_data[0]->tag)) {
      echo ucfirst($request_data[0]->tag);
    } ?>
  </p>

  <h1 class="edit-heading"><b>Script</b></h1>
  <div class="form-group mt-4">
    <label class="p-0">Process how painting should be created <?php if(!empty($getCUSTOMERID)){ echo "(". $getCUSTOMERID[0]->painting_height .'"'. ' x ' . $getCUSTOMERID[0]->painting_width . '")'; } ?></label>
  </div>
  <div class="form-group mt-4">


    <div class="row align-items-center">
      <div class="col-12 col-lg-12">
        <div class="form-group ">



                                               <?php
                                                if (!empty($request_data[0]->script)) {
                                                    $script = explode(",", $request_data[0]->script);
                                                    foreach ($script as $val) {
                                                        $val = str_replace('HR24', '', $val);
                                                        if (strpos($val, 'HR24') !== false) {
                                                        }
                                                        $value = str_replace('[', "", "$val");
                                                        $value1 = str_replace('"', "", "$value");
                                                        $value2 = str_replace(']', "", "$value1");

                                                        $input_text = $value2;
                                                        $color_pattern = "/#([0-9a-fA-F]{6})/";
                                                        preg_match_all($color_pattern, $input_text, $matches);
                                                        $data['color_codes'] = $matches[0];
                                                        $cleaned_text = preg_replace($color_pattern, '', $input_text);

                                                ?>

                                                        <div class="d-flex reuestform-script">
                                                            <p class="paint-process">
                                                                <?php if (isset($cleaned_text)) {
                                                                ?>
                                                                    <?php
                                                                    $result = substr($cleaned_text, 0, 6);
                                                                    // print_r($result);
                                                                    if ($result == 'PB2023') {


                                                                        $desc = "description";
                                                                    } else {
                                                                        $desc = "";
                                                                    }

                                                                    $cleaned_data = str_replace('~', ',', $cleaned_text);
                                                                    $cleaned_result = str_replace('PB2023', '', $cleaned_data);
                                                                    ?>
                                                            </p>
                                                            <span class="<?php echo $desc; ?>">
                                                                <?php echo ucfirst($cleaned_result); ?>
                                                                <?php echo "&nbsp"; ?>
                                                            </span>
                                                            <div class="color-box" style="width: 30px; height: 30px; background-color: <?php if (isset($data['color_codes'][0])) {
                                                                                                                                            echo $data['color_codes'][0];
                                                                                                                                        } ?>; ">
                                                            </div>

                                                            <?php echo "&nbsp"; ?>
                                                            <span class="">
                                                                <?php if (isset($data['color_codes'][0])) {
                                                                        echo $data['color_codes'][0];
                                                                    } ?>
                                                                <?php echo "&nbsp"; ?>
                                                            </span>

                                                            <div class="color-box" style="width: 30px; height: 30px; background-color: <?php if (isset($data['color_codes'][1])) {
                                                                                                                                            echo $data['color_codes'][1];
                                                                                                                                        } ?>; ">
                                                            </div>
                                                            <?php echo "&nbsp"; ?>
                                                            <span class="">
                                                                <?php if (isset($data['color_codes'][1])) {
                                                                        echo $data['color_codes'][1];
                                                                    } ?>
                                                            </span>
                                                        <?php }
                                                        ?>
                                                        </div>
                                                        <br>


                                                <?php }
                                                } ?>
                                                <?php
                                                  $temp_id = $this->uri->segment(2);
                                                  $CI = &get_instance();
                                                  $modifiedString256 = $CI->canvas_image_data($temp_id);
                                                  if(!empty($modifiedString256))
                                                  {?>

                                                         <div class="form-group mt-4 mb-4">
                                                    <label>Inserted Media </label>
                                                </div>
                                             <?php }   ?>

                                           
                                                <div class="container">

                                                    <div class="media-slider">

                                                        <?php
                                                        $cus_id = $this->session->userdata('id');
                                                        //   $images_array = [];
                                                        if (!empty($request_data[0]->script)) {
                                                            $script = explode(",", $request_data[0]->script);

                                                            $HR24Words = array();
                                                            foreach ($script as $val) {
                                                                if (strpos($val, 'HR24') !== false) {
                                                                    $HR24Words[] = $val;
                                                                }
                                                            }
                                                        }
                                                     
                                                        // print_r($modifiedString256);
                                                        $i=1;
                                                        foreach ($modifiedString256 as $value) {
                                                          $image_name = substr($value->image_name, 14);
                                                        ?>
                                                            <div class="d-flex  media-images ">
                                                                <div>
                                                                    <img src="data:image/png;base64, <?php echo $value->images; ?>" width="150" height="150" />
                                                                    <span>
                                                                    <?php echo $image_name; ?>
                                                                        <?php //echo $value->image_name; ?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>





        </div>
      </div>
    </div>
  </div>
  <!-- <div class="request-detail mb-5 p-5">
    <h1 class="edit-heading"><b>Canvas Image</b></h1>
    <img src="<? php // echo base_url(); 
              ?>/assets/canvas_image/<? php // if(isset($request_data[0]->canvas_image)){ echo $request_data[0]->canvas_image;} 
                                      ?>" alt="">
  </div> -->
  <?php $CI = &get_instance();
  $photos = $CI->get_painting_artist($this->uri->segment(2));


  if (!empty($photos[0]->reviews)) {
  ?>
    <div class="review-section  mt-5 mb-5">
      <h3 class="  section-heading"><b style="font-size: 30px;"> Review</b><br>
        <span class="star-icons align-top"><?php
                                            $stars = $photos[0]->rating;
                                            $rem_stars = 5 - $stars;

                                            ?>

          <span class="rating-star">
            <?php
            for ($i = 1; $i <= $stars; $i++) { ?>
              <i class="bi bi-star-fill text-warning star-icon ms-0"></i>
            <?php }
            for ($i = 1; $i <= $rem_stars; $i++) {

            ?>
              <i class="bi bi-star star-icon ms-0"></i>
            <?php } ?>
          </span>
        </span>
      </h3>
      <h3>
        <p class="p-details p-0">
          <?php echo $photos[0]->reviews; ?>
        </p>
      </h3>
    </div>
  <?php } ?>
  <?php if ($check_status[0]->painting_status == "1") { ?>
  <div class="request-detail-slider card ">
    <div class="row align-items-center">
        <div class="draw-section mt-3">
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
          <div id="submited_painting">


            <form action="<?php echo base_url(); ?>submit_artist_painting/<?php echo $this->uri->segment(2); ?>" method="POST" enctype="multipart/form-data" class="needs-validation">
            <h4 class="pt-0 pb-4"> Painting Image</h4>
             
              <?php

              if (!empty($photos[0]->sub_by_artist)) {

                $data = explode(',', $photos[0]->sub_by_artist);
                // print_r($data);
                foreach ($data as $val) {

                  if (!empty($val)) {
              ?>

                    <span class="add-painting-img position-relative">
                      <img class="ms-0 me-2" src="<?php echo base_url(); ?>/assets/artist_paintings/<?php echo $val; ?>" alt="" width="200" height="150">
                      <a class="position-absolute text-danger  delete-icon" href="<?php echo base_url(); ?>delete_canvas_image/<?php echo $val; ?>/<?php echo $this->uri->segment(2); ?>"><i class="bi bi-trash3-fill"></i></a>
                    </span>


              <?php }
                }
              } ?>
              <div class="add-image mt-3 text-center">
                <div class="upload-box pb-4">
                  <span><img src="<?php echo base_url(); ?>assets/images/upload-btn.png" alt="Upload Image"></span>
                  <label for="validationCustom04" class="btn btn-primary">Upload image</label>
                  <input type="file" id="validationCustom04" name="image[]" multiple class="form-control">
                  <input type="hidden" name="id" value="<?php echo $this->uri->segment(2); ?>">
                  <div class="invalid-feedback error">
                    Painting image is required.
                  </div>
                  <div id="imgname" style="text-align: center;"></div>
                </div>
              </div>
              <div class="button-sec m-5 text-center">
                <button type="submit" class="btn btn-primary upload-btn">Submit</button>
              </div>
              <div class="d-flex justify-content-end">
               
              <!-- <div> <a href="https://influocial.co/staging-pb/artist_chatwithCustomer/<?php echo $this->uri->segment(2); ?>" class="btn btn-primary ">Chat With Customer</a> </div> -->
            
            </form>

          </div>
        </div>

      
    </div>
    <?php } ?>



    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="https://kenwheeler.github.io/slick/slick/slick.js"></script>






    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content position-relative">

          <!-- <div class="text-end">  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">  <img src="https://influocial.co/staging-pb/assets/images/close (4).png" alt=""></button></div> -->

          </button>
        </div>



        <!-- <img class="w-100" src="https://influocial.co/staging-pb/assets/customer_image/image.jpg"> -->
      </div>

    </div>
  </div>

</div>

<!-- ------------------------- -->
<!-- Shipment status -->
<?php if ($check_status[0]->painting_status == "1")
{?>
  

<div class="profile-card  border-0  mt-5 mb-5 ">
<?php 
$temp_id = $this->uri->segment(2);
$shipping = $CI->check_shipping_status($temp_id);
if(!empty($shipping))
{
  $status = $shipping[0]->shipping_status;
}


?>
<form action = "<?php echo base_url(); ?>shipping_status/<?php echo $this->uri->segment(2);?>" method="POST">
<div class="col-sm-6">
<div class="form-group">
<label for="shipping">Track number:</label><br>
<input class="form-control" type  = "text" name = "track_num" placeholder = "Track number" value="<?php if(!empty($shipping)){ echo $shipping[0]->track_num;} ?>" ><br>
  <label for="shipping">Shipment Status:</label>
  <select class="select w-100" name="shipping" id="shipping" >
    <option value="Shipping Soon" <?php if(!empty($shipping[0]->shipping_status)){if($status == "Shipping Soon"){echo "selected";}}?>>Shipping soon</option>
    <option value="Shipped" <?php if(!empty($shipping[0]->shipping_status)){if($status == "Shipped"){echo "selected";}}?>>Shipped</option>
    <option value="On the Way" <?php if(!empty($shipping[0]->shipping_status)){if($status == "On the Way"){echo "selected";}}?>>On the way</option>
    <option value="Out for delivery"   <?php if(!empty($shipping[0]->shipping_status)){if($status == "Out for delivery"){echo "selected";}}?>>Out for delivery</option>
    <option value="Delivered" <?php if(!empty($shipping[0]->shipping_status)){if($status == "Delivered"){echo "selected";}}?>>Delivered</option>
  </select>
  <input class="btn btn-primary mt-3 " type ="submit">
</div>
</div>
  <br><br>
</form>
  </div>
  <?php } ?>
  <!-- ------------------------- -->
  


<script>
  $(document).ready(function() {
    $('#validationCustom04').on('change', function() {
      var fileName = [];
      $.each(this.files, function(index, file) {
        fileName.push(file.name);
      });
      $('#imgname').text(fileName.join(', ') || 'No files selected');
    });

  });
</script>
<script>
  var timeout = 3000;

  $('.time').delay(timeout).fadeOut('slow');
</script>

<script>
  $(document).ready(function() {
    // $('#submited_painting').hide();
    $('#AcceptSubmittedPainting').on('click', function() {

      var painting_status = '1';

      $.ajax({
        type: 'POST',
        url: '<?php echo base_url('painting_status'); ?>',
        data: {
          'painting_status': painting_status,

        },
        success: function(response) {
          alert(response);

        }
      });

    });
  });
</script>