<?php $CI  = &get_instance(); ?>


<?php

$artistInfo = $CI->getartist_Data($this->session->userdata('id'));

?>
<?php if ($this->session->flashdata('error')) { ?>
  <p class="time text-danger alert-dismissable"><?php echo $this->session->flashdata('error'); ?></p>
<?php } ?>
<?php if ($this->session->flashdata('success')) { ?>
  <p class="time text-success"><?php echo $this->session->flashdata('success'); ?></p>
<?php } ?>
<div class="edit-painting">

  <div class="artist-text">
    <h1><?php if (isset($paintingDetail[0]->painting_name)) {
          echo ucfirst($paintingDetail[0]->painting_name);
        } ?></h1>
  </div>
 
  <div class="d-flex pb-4">
    <div class="review-img">
    
    </div>
    <div class="review-info ps-3">
      


    </div>
  </div>

  <p class="painting-para mb-0">
  <div class="painting-edit">
    <form action="<?php echo base_url('updatePainting/');
                  echo $paintingDetail[0]->ID; ?>" method="POST" enctype="multipart/form-data">




      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label>Painting Name</label>
            <input type="text" class="form-control" name="name" placeholder="" value="<?php if (isset($paintingDetail[0]->painting_name)) {
                                                                                        echo ucfirst($paintingDetail[0]->painting_name);
                                                                                      } ?>">
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label>Price($)</label>
            <input type="number" class="form-control" placeholder="" name="price" value="<?php if (isset($paintingDetail[0]->painting_price)) {
                                                                                            echo  $paintingDetail[0]->painting_price;
                                                                                          } ?>">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label>Painting Size</label>
          
              <select class="form-select" values="" name="size">
                <option selected>Select Size </option>
                <option value="4 x 8 inch" <?php if (isset($paintingDetail[0]->painting_size)) {  echo ($paintingDetail[0]->painting_size == '4 x 8 inch') ? 'selected' : '';  } ?>>4 x 8 inch</option>
                <option value="5 x 7 inch" <?php if (isset($paintingDetail[0]->painting_size)) {  echo ($paintingDetail[0]->painting_size == '5 x 7 inch') ? 'selected' : ''; } ?>>5 x 7 inch</option>
                <option value="8 x 10 inch" <?php if (isset($paintingDetail[0]->painting_size)) {  echo ($paintingDetail[0]->painting_size == '8 x 10 inch') ? 'selected' : ''; } ?>>8 x 10 inch</option>
                <option value="9 x 12 inch" <?php if (isset($paintingDetail[0]->painting_size)) {   echo ($paintingDetail[0]->painting_size == '9 x 12 inch') ? 'selected' : ''; } ?>>9 x 12 inch</option>
                <option value="11 x 14 inch" <?php if (isset($paintingDetail[0]->painting_size)) {  echo ($paintingDetail[0]->painting_size == '11 x 14 inch') ? 'selected' : ''; } ?>>11 x 14 inch</option>
                <option value="12 x 12 inch" <?php if (isset($paintingDetail[0]->painting_size)) { echo ($paintingDetail[0]->painting_size == '12 x 12 inch') ? 'selected' : '';  } ?>>8 x 10 inch</option>
                <option value="12 x 16 inch" <?php if (isset($paintingDetail[0]->painting_size)) {  echo ($paintingDetail[0]->painting_size == '12 x 16 inch') ? 'selected' : ''; } ?>>12 x 16 inch</option>
                <option value="16 x 20 inch" <?php if (isset($paintingDetail[0]->painting_size)) {  echo ($paintingDetail[0]->painting_size == '16 x 20 inch') ? 'selected' : '';   } ?>>16 x 20 inch</option>
                <option value="18 x 24 inch" <?php if (isset($paintingDetail[0]->painting_size)) {  echo ($paintingDetail[0]->painting_size == '18 x 24 inch') ? 'selected' : '';   } ?>>18 x 24 inch</option>

              </select>
        

          </div>
        </div>

        <div class="col-sm-6">
                <div class="form-group">
                    <label>Painting Type</label>
                    <div id="sel-cont">

        
                   <?php    $categoryArray = explode(',', $paintingDetail[0]->painting_category);?>

                    <select  name="painttype[]" id="select1" class="selectbox" style="width: 350px;" multiple>
                        
                        <?php
                         foreach($painting_category as $category){ 
                          $isSelected = in_array($category->ID, $categoryArray) ? 'selected' : '';
                          ?>
                  
                          <option value="<?php echo $category->ID; ?>" <?php echo $isSelected; ?>><?php echo $category->title;?></option>

                     
                         
                        <?php } ?>
                  </select>

                        <br />
                    </div>
                </div>
            </div>


      </div>
      <div class="row">
        <div class="col-sm-12">
          <div class="form-group">
            <label>Painting Description</label>
            <textarea rows="6" cols="50" class="form-control" name="description"><?php if (isset($paintingDetail[0]->painting_description)) {
                                                                                    echo  ucfirst($paintingDetail[0]->painting_description);
                                                                                  } ?></textarea>
          </div>
        </div>

      </div>
  </div>


<span id="span_to_delete_frame_response" class=" text-success alert-dismissable"></span>
  <div class="select-images">
    <h4>Add Frame</h4>


    <?php
    $CI = &get_instance();
    $photos = $CI->getphotos($this->uri->segment(2));

    $data = explode(',', $photos[0]->painting_frame);
    foreach ($data as $img) {
    ?>
   <span class="add-painting-img position-relative">
        <img class="ms-0" src="<?php echo base_url(); ?>/assets/artist_paintings/<?php echo $img; ?>" alt="" width="188" height="190">
        <a id="<?php echo $img; ?>" data-bs-toggle="modal" data-bs-target="#frame_delete" class="edit-gallery delete-frame"><i class="bi bi-trash3-fill"></i></a>
    </span>

    <?php } ?>
    <label class="add-frame text-center"> <span> <img src="<?php echo base_url(); ?>assets/images/image_2023_07_12T07_58_38_810Z.png" alt="">
        <input type="file" name="frame[]" multiple id="frame_upload" value="<?php if (isset($paintingDetail[0]->painting_frame)) {
                                                                            echo $paintingDetail[0]->painting_frame;
                                                                          } ?> ">
        <input type="hidden" name="photos[]" multiple id="file_upload" value="<?php if (isset($paintingDetail[0]->painting_frame)) {
                                                                                echo $paintingDetail[0]->painting_frame;
                                                                              } ?> ">

    </label>
    <div id="fnames" style="padding-left: 2%;"></div>



  </div>
  <?php if ($this->session->flashdata('frameerror')) { ?>
    <p class=" text-danger alert-dismissable"><?php echo $this->session->flashdata('frameerror'); ?></p>
  <?php } ?>
<!-- -------------------------------------- -->

<span id="span_to_post_response" class=" text-success alert-dismissable"></span>

<div class="select-images">
    <h4>Add Painting</h4>


    <?php
    $CI = &get_instance();
    $photos = $CI->getphotos($this->uri->segment(2));

    $data = explode(',', $photos[0]->painting_image);
    foreach ($data as $val) {
      
    ?>
     <span class="add-painting-img position-relative">
              <img class="ms-0" src="<?php echo base_url(); ?>/assets/artist_paintings/<?php echo $val; ?>" alt="" width="3000" height="3000">
              <a id="<?php echo $val;?>" data-bs-toggle="modal" data-bs-target="#deleteModal" class="edit-gallery delete-painting"><i class="bi bi-trash3-fill"></i></a>
      </span>
    <?php } ?>
    <label class="add-frame text-center"> <span> <img src="<?php echo base_url(); ?>assets/images/image_2023_07_12T07_58_38_810Z.png" alt="">
        <input type="file" id="fileUpload" name="image[]" multiple value="<?php if (isset($paintingDetail[0]->painting_image)) {
                                                                            echo $paintingDetail[0]->painting_image;
                                                                          } ?> ">
        <input type="hidden" name="GalleryImage[]" multiple id="file_upload" value="<?php if (isset($paintingDetail[0]->painting_image)) {
                                                                                echo $paintingDetail[0]->painting_image;
                                                                              } ?> ">

    </label>
    <div id="imgname" style="text-align: center;"></div>



  </div>



  <div class="button-sec m-5 text-center">

    <button type="submit" class="btn btn-primary upload-btn">Update</button>
  </div>


</div>

   </form>

</div>
</div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <h2>Are you sure,you want to delete?</h2>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
                <a type="button" class="btn btn-primary delete-more" id="confirmDelete">Yes</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="frame_delete" tabindex="-1" aria-labelledby="frame_deleteLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <h2>Are you sure you want to delete?</h2>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
                <a type="button" class="btn btn-primary delete_frame" id="confirmframe_delete">Yes</a>
            </div>
        </div>
    </div>
</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> 


<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.6.2/chosen.jquery.min.js"></script>  

<script>
$(document).ready(function() {
  $('#frame_upload').on('change', function() {
    var fileNames = [];
    $.each(this.files, function(index, file) {
      fileNames.push(file.name);
    });
    $('#fnames').text(fileNames.join(', ') || 'No files selected');
  });
});
</script>
<script>
$(document).ready(function() {
  $('#fileUpload').on('change', function() {
    var fileNames = [];
    $.each(this.files, function(index, file) {
      fileNames.push(file.name);
    });
    $('#imgname').text(fileNames.join(', ') || 'No files selected');
  });
});

  
  
</script>

      <script>
        var timeout = 3000; 

        $('.time').delay(timeout).fadeOut(300);
        </script>

        <script>
          $('select[name="painttype[]"]').chosen();
        </script>




        <script>

            $(document).ready(function() {
                var paintingId; 
                var postData;
                $(document).on('click', '.delete-painting', function() {
                    paintingId = $(this).attr('id'); 
                    $('#deleteModal .delete-more').attr('data-id', paintingId);
                });

              // alert(paintingId);
                $('#confirmDelete').click(function() {
                    var formData = new FormData();
                    var postData = <?php echo $this->uri->segment(2)?>;
                
                    formData.append('paintingId', paintingId);
                    formData.append('ID', postData);
                  // alert(postData);

                    $.ajax({
                        type: 'POST',
                        url: '<?php echo base_url('Artist/delete_painting'); ?>', 
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            $('#deleteModal').modal('hide');
                            jQuery('#span_to_post_response').text(response);
                            location.reload();
                        },
                        error: function(xhr, status, error) {
                          console.error(error);
                        }
                    });
                });
            });

        </script>



<script>

      $(document).ready(function() {
              var frameId;
              var postData;

              $(document).on('click', '.delete-frame', function() {
                  frameId = $(this).attr('id');
                  $('#frame_delete .delete_frame').attr('data-id', frameId);
                  
              });

          $('#confirmframe_delete').click(function() {
              var formData = new FormData();
              var postData = <?php echo $this->uri->segment(2)?>;
          
              formData.append('framename', frameId);
              formData.append('ID', postData);
            // alert(postData);

              $.ajax({
                  type: 'POST',
                  url: '<?php echo base_url('Artist/delete_frame'); ?>', 
                  data: formData,
                  processData: false,
                  contentType: false,
                  success: function(response) {
                      $('#deleteModal').modal('hide');
                    //  alert(response);
                      jQuery('#span_to_delete_frame_response').text(response);
                      location.reload();
                  },
                  error: function(xhr, status, error) {
                    console.error(error);
                  }
              });
          });
      });

</script>

        



