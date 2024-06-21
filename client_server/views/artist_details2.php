     
     
     
<?php $CI  = &get_instance(); ?>

<?php

foreach($artist_paintingdetail as $row){
 
    
     $painting_rating = $CI->painting_rating($row->ID );
  

     $stars = round($painting_rating['avgrat']);
     $remstar = 5 - $stars;
    
    ?> <!--top header-->



<div class="individual-painting">
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-6">
           


    <!-- .gallery-slider -->
    <div class="gallery-slider">
  
      <!-- __images -->
      <div class="gallery-slider__images">
        <div>
                <!-- .item -->
                        <?php $images = explode(',', $row->painting_image);
                           foreach($images as $image){ ?>
                <div class="item">
                     <div class="img-fill">
                     <img src="<?php  echo base_url('/assets/artist_paintings/') . trim($image);?>" alt="">
                        
                    </div>
                </div>
          
                        
                        <?php  }?>                 
        </div>

       
      </div>
    
      <div class="gallery-slider__thumbnails">
        <div>
          <!-- .item -->
                  <?php $images = explode(',', $row->painting_image);
                      foreach($images as $img){ ?>
          <div class="item">
                  <div class="img-fill">
                 
                 <img src="<?php  echo base_url('/assets/artist_paintings/') . trim($img);?>" alt="">
                                         </div>
          </div>
      
                      <?php } ?>    
        </div>
        <button class="prev-arrow slick-arrow">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1280 1792">
              <path fill="#fff" d="M1171 301L640 832l531 531q19 19 19 45t-19 45l-166 166q-19 19-45 19t-45-19L173 877q-19-19-19-45t19-45L915 45q19-19 45-19t45 19l166 166q19 19 19 45t-19 45z" />
            </svg>
      </button>
      <button class="next-next-arrow slick-arrow">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1280 1792">
              <path fill="#fff" d="M1107 877l-742 742q-19 19-45 19t-45-19l-166-166q-19-19-19-45t19-45l531-531-531-531q-19-19-19-45t19-45L275 45q19-19 45-19t45 19l742 742q19 19 19 45t-19 45z" />
            </svg>
      </button>
      </div>
    </div>
    <!-- /.gallery-slider -->
  
        </div>


        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-6 ps-xl-5">
            <div class="artist-text d-flex justify-content-between"><h1 class="individual-heading"><?php echo ucfirst($row->painting_name);?></h1>
           <span> <button class="edit-profile-img"  style=" margin-bottom: 10px;">
            <a class="text-white" href="<?php echo base_url('edit_painting/'); echo $row->ID; ?>"><i class="bi bi-pencil-fill"></i></a>
            </button></span>
          </div>
            <p class="individual-description">Painting :<?php echo ' '.  $row->painting_size;?></p>
            <p class="individual-description" id="painting-description"><?php echo htmlentities(substr($row->painting_description, 0, 80)); ?><span id="painting-full-description" style="display:none;"><?php echo htmlentities($row->painting_description); ?></span>...</p>
            <a id="show-hide" onclick="toggleDescription(); return false;"><b>Show More</b></a>

            <div class="review-info">
                <span class="star-icons align-top"><?php for ($i = 1; $i <= $stars; $i++) { ?><i class="bi bi-star-fill pe-2"></i><?php  } ?> <?php for ($i = 1; $i <= $remstar; $i++) { ?><i class="bi bi-star pe-2"></i><?php  } ?><b class="ps-3 align-bottom text-dark"><?php echo $stars;?></b></span>
             </div>
             <h2>$<?php echo $row->painting_price;?></h2>
             <div class="select-images">
                <p class="painting-para"><b>Select a frame :</b></p>
                <?php 
            
            $data = explode(',',$row->painting_frame);
             foreach($data as $val)
             {
            ?>
                <img class="ms-0" src="<?php echo base_url(); ?>/assets/artist_paintings/<?php echo $val; ?>" alt="">   
                <?php } ?>
             </div>
            
            </div>
    </div>

      
       
            </div>
</div>

   

   
                       

    </div>
    <?php } ?>
</div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://kenwheeler.github.io/slick/slick/slick.js"></script>

<script>
    $(document).ready(function(){
  $("#Load-more").click(function(e){
    e.preventDefault();
    $(".on-loadmorediv").slice(0,3).fadeIn("slow");
    
    if($(".on-loadmorediv").length == 0){
       $("#Load-more").fadeOut("slow");
      }
      if ($(".on-loadmorediv:hidden").length == 0) {
				$(".load-more").css('visibility', 'hidden');
			}
  });
})
</script>

<script>
	/*
		variables
	*/

    var $imagesSlider = $(".gallery-slider .gallery-slider__images>div"),
			  $thumbnailsSlider = $(".gallery-slider__thumbnails>div");

	/*
		sliders
	*/

		// images options
		$imagesSlider.slick({
			speed:300,
			slidesToShow:1,
			slidesToScroll:1,
			cssEase:'linear',
			fade:true,
			draggable:false,
			asNavFor:".gallery-slider__thumbnails>div",
			prevArrow:'.gallery-slider__images .prev-arrow',
			nextArrow:'.gallery-slider__images .next-next-arrow'
		});

		// thumbnails options
		$thumbnailsSlider.slick({
      infinite:true,
      speed:300,
      slidesToShow:3,
      slidesToScroll:1,
      variableWidth:true,
			cssEase:'linear',
			centerMode:true,
			draggable:false,
			focusOnSelect:true,
			asNavFor:".gallery-slider .gallery-slider__images>div",
			prevArrow:'.gallery-slider__thumbnails .prev-arrow',
			nextArrow:'.gallery-slider__thumbnails .next-next-arrow',
			responsive: [
				{
					breakpoint: 720,
					settings: {
						slidesToShow: 4,
						slidesToScroll: 4
					}
				},
				{
					breakpoint: 576,
					settings: {
						slidesToShow: 3,
						slidesToScroll: 3
					}
				},
				{
					breakpoint: 350,
					settings: {
						slidesToShow: 2,
						slidesToScroll: 2
					}
				}
			]
     
		});


</script>

<script>
var descriptionExpanded = false;

function toggleDescription() {
  var description = document.getElementById("painting-description");
  var fullDescription = document.getElementById("painting-full-description").textContent;

  if (!descriptionExpanded) {
    description.textContent = fullDescription;
    descriptionExpanded = true;
    document.getElementById("show-hide").innerText = "";


  } else {
    description.textContent = fullDescription;
    descriptionExpanded = false;
    $('#show-hide').hide();
     return;
  }
}
  </script>

    