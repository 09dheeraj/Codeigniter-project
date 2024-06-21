<?php $CI  = &get_instance(); ?>


<div class="row">
  <div class="col-sm-12">
    <div class="text-end">
      <a href="<?php echo base_url('add_painting'); ?>"  class="btn btn-primary" id="clearButton"> Add More...</a>
    </div>
  </div>
</div>
<div class="artist-gallery">

  
  <div class="gallery-container-section mt-4 posts-container">
  <?php
  $entryCount = 0;
  
  foreach ($artistPinting as $row) {

    if ($entryCount >= 12) {
      break;
    }
    $painting_rating = $CI->painting_avgrat($row->ID);
    $stars = round($painting_rating['avgrat']);
    $remstar = 5 - $stars;

    ?>
    <div class="box">
     
      <!--gallery section-->
      <?php if ($this->session->flashdata('success')): ?>
          <div class="alert alert-success">
            <?php echo $this->session->flashdata('success'); ?>
          </div>
      <?php endif; ?>
      
      <?php if ($this->session->flashdata('error')): ?>
          <div class="alert alert-danger">
            <?php echo $this->session->flashdata('error'); ?>
          </div>
      <?php endif; ?>
      

      <div data-bs-toggle="modal" data-bs-target="#exampleModal-<?php if (isset($row->ID)) {
                                                                  echo $row->ID;
                                                                } ?>" class="">
 
        <?php
        $images = explode(',', $row->painting_image);
        foreach ($images as $image) {
            ?>
            <img class="w-100" src="<?php echo base_url('/assets/artist_paintings/') . trim($image); ?>" alt="">
            <?php break; }?>
      </div>





      <div class="d-flex img-box-text justify-content-between">
        <div class ="d-none">

          </div>
          <p class="ps-2"><?php if (isset($row->painting_name)) { $fullname = $row->painting_name;  $maxLength = 30; if (strlen($fullname) > $maxLength) {  $shortenedText = substr($fullname, 0, $maxLength) . "...";
            } else {  $shortenedText = $fullname; }  echo ucfirst($shortenedText); }  ?></p>
  <span class="gallery-editbtn">
        <a href="<?php echo base_url('edit_painting/'); echo $row->ID; ?>" class="edit-gallery "><i class="bi bi-pencil"></i></a>

         <a class="edit-gallery confirm-delete"  data-bs-toggle="modal" data-bs-target="#deleteModal" id="<?php echo $row->ID;?>" ><i class="bi bi-trash3-fill"></i></a>
        </span>
      </div>
      
    </div>
    
    
    

    <div class="modal fade" id="exampleModal-<?php if (isset($row->ID)) {    echo $row->ID;  } ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
          <div class="modal-body ">
            <div class="text-end"> <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> <img src="<?php echo base_url(); ?>assets/images/close (4).png" alt=""></button></button></div>
            <h2 class="text-center painting-heading"><?php if (isset($row->painting_name)) {  echo ucfirst($row->painting_name);  } ?></h2>
            <?php $images = explode(',', $row->painting_image);
            foreach($images as $image){ ?>
           <a href="<?php echo base_url('paint_view'); ?>/<?php echo $row->ID; ?>">  <div class="moadal-img">  <img class="w-100 gallery-modal-img" src="<?php echo base_url('/assets/artist_paintings/') . trim($image); ?>"></div></a>
           <?php break;} ?>
            <p class="painting-para">Painting :<?php if (isset($row->painting_size)) { echo " " . $row->painting_size; } ?></p>
            <p class="painting-para"><?php if (isset($row->painting_description)) {  $fullText = $row->painting_description; $maxLength = 150;
                                        if (strlen($fullText) > $maxLength) {
                                          $shortenedText = substr($fullText, 0, $maxLength) . "...";
                                        } else {
                                          $shortenedText = $fullText;
                                        }
                                        echo ucfirst($shortenedText);
                                      } ?></p>


          </div>
        </div>
      </div>
    </div>
<!--delete-btn modal-->

<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
            <div class="modal-body">
                <h2>Are you sure, you want to delete<span id=""></span>?</h2>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
                <a type="button" class="btn btn-primary delete-more" id ="deleteConfirmButton">Yes</a>
            </div>
        </div>
    </div>
</div>

<?php
    $entryCount++;
  }
  ?>
</div>
<div class="row mt-4 mb-4">
  <div class="col-12 text-end">
    <div class="load-more">
      <button class = "btn btn-primary" id="load-more-btn">Load more..</button>
    </div>
  </div>
</div>

<!--gallery section-->
</div>
</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script> 
<script src="https://cdn.rawgit.com/kenwheeler/slick/master/slick/slick.min.js"></script>

<!-- image-Modal -->

<script>
  $(document).ready(function() {
    var offset = 12;
        var entriesPerRequest = 8;
        var imagesPerRow = 8;

        $('#load-more-btn').click(function () {
            $.ajax({
                url: "<?php echo base_url('get_more_posts'); ?>",
                type: 'post',
                data: { offset: offset },
                success: function (response) {
                    var $imageContainers = $(response).find('.box');
                    var imageContainersToAdd = Math.min($imageContainers.length, entriesPerRequest);
                    var modalsHtml = $(response).find('.modal.fade[id^="exampleModal-"]');
                   var deleteModalHtml = $(response).find('#deleteModal-').prop('outerHTML');
                  
                   
                   if (imageContainersToAdd === 0) {
                        $('#load-more-btn').hide();
                        return;
                    }

                    var rowHtml = '<div class="-box-text justify-content-between">';

                    for (var i = 0; i < imageContainersToAdd; i++) {
                        if (i > 0 && i % imagesPerRow === 0) {
                            rowHtml += '</div><div class="d-none">';
                        }
                        var galleryContainerHtml = $imageContainers[i].outerHTML;
                        var modalHtml = $(modalsHtml[i]).prop('outerHTML');
                        var textDivHtml = $(response).find('.d-none')[i].outerHTML;

                        rowHtml += '<div class="d-none' + (12 / imagesPerRow) + '">' +
                            galleryContainerHtml + textDivHtml + '</div>';
                            rowHtml += modalHtml;
                    }
                    
              
                    rowHtml += '</div>';

                    $('.posts-container').append(rowHtml);

                    offset += entriesPerRequest;
                }
            });
        });
    });
    </script>


<script>
$(document).ready(function () {
  
  $(document).on('click', '.confirm-delete', function () {
      var id = $(this).attr('id');
      $('#deleteModal .delete-more').attr('data-id', id);
      $('#deleteModal').modal('show');
  });

  $(document).on('click', '#deleteConfirmButton', function () {
      var id = $(this).attr('data-id');
      $.ajax({
          url: '<?php echo base_url('delete_Paint') ?>/' + id,
          type: 'POST',
          success: function (response) {
              $('#deleteModal').modal('hide');
              location.reload();
          },
          error: function () {
              alert('Error deleting item.');
          }
      });
  });
});

</script>










<script>
    $(document).ready(function() {
        var paintingId; 

        $(document).on('click', '.delete-painting', function() {
            paintingId = $(this).attr('id'); /
            $('#deleteModal .delete-more').attr('data-painting-id', paintingId);
        });

        $('#confirmDelete').click(function() {
            var formData = new FormData();
            formData.append('paintingId', paintingId);

            $.ajax({
                type: 'POST',
                url: '<?php echo base_url('artist/delete_painting'); ?>', 
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    $('#deleteModal').modal('hide');
                    alert(response);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    });
</script>


