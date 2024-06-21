<?php $CI  = &get_instance(); ?>


<?php
foreach($customer_buypainting as $row){
     if(isset($row->ID))   {  
        //$totalpainting = $CI->totalpainting($artistdetails[0]->reg_id);
        $totalreviews = $CI->totalreviews($row->ID);
        if ($totalreviews['total'] > 0) {
            $totalDisplay = $totalreviews['total'];
        } else {
            $totalDisplay = "0";
        }

        $getpainting_review =  $CI->getpainting_review($row->ID);
      //print_r($getRating_review);
        if ($getpainting_review['totalreview'] > 0) {
            $totalpaintingreviewDisplay = $getpainting_review['totalreview'];
        } else {
            $totalpaintingreviewDisplay = "0";
        }
      
      
        $paintingstars = round($getpainting_review['avgrat']);
        $rempaintingstar = 5 - $paintingstars;
        }
    ?> 
         <!--top header-->
    <div class="artist-text">
  <!-- <h1><?php//echo $row->painting_name;?></h1></div> -->
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
                foreach($images as $img){
                ?>
                <div class="item">
                     <div class="img-fill">
                         <img src="<?php echo base_url('/assets/artist_paintings/') . trim($img); ?>" alt="">
                   
                    </div>
                </div>
             <?php } ?>
                <!-- /.item -->
                <!-- .item -->
             
              
            
        
        </div>
       
       
      </div>
      <!-- /__images -->

      <!-- __thumbnails -->
      <div class="gallery-slider__thumbnails">
        <div>
          <!-- .item -->
          <?php $images = explode(',', $row->painting_image); 
                foreach($images as $img){
                ?>
          <div class="item">
                  <div class="img-fill">
                       <img src="<?php echo base_url('/assets/artist_paintings/') . trim($img); ?>" alt="">
                  </div>
          </div>
          <?php }?>
          <!-- /.item -->
          <!-- .item -->
         
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
            <h1  class="section-heading pb-2" style="color: #AAA2FF;"><?php echo $row->painting_name;?></h1>
            <p class="painting-para">Painting : <?php echo $row->painting_size;?></p>
            <p class="painting-para" id="painting-description"><?php echo htmlentities(substr($row->painting_description, 0, 80)); ?>...</p>
            <a  id="hide-atype" onclick="toggleDescription(); return false;"><b>Show More</b></a>
            <div class="review-info">
                <span class="star-icons align-top"><?php if (isset($paintingstars)) {  for ($i = 1; $i <= $paintingstars; $i++)  { ?><i class="bi bi-star-fill pe-2"></i><?php  }} ?> <?php if (isset($rempaintingstar)) { for ($i = 1; $i <= $rempaintingstar; $i++) { ?><i class="bi bi-star pe-2"></i><?php } } ?><b class="ps-3 align-bottom text-dark">(<?php if (isset($totalDisplay)) { echo $totalDisplay; }?>)</b></span></b></span>
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
             <div class="painting ">
                <a href="<?php echo base_url('buy/'); echo $row->ID; ?>" class="btn btn-primary">Add To Cart</a>
            </div>
            </div>
    </div>

        <div class="like-images ">
            <h3>You might also like</h3>
        
        <div class="row">
            <?php
            foreach($rand_paintings as $img){
            ?>          
              <div class="col-sm-12 col-md-12 col-xl-4 my-3">
              <a  href="<?php echo base_url('individualpainting/'); echo $img->ID; ?>" >  <img   class = "w-100  gallery-img" src="<?php echo base_url('/assets/artist_paintings/');echo $img->painting_image; ?>" alt="">  </a>                
            </div>
            <?php }?>
           
            
        </div>
      
       
    </div>
  
            </div> 


   

<?php
}
?>
                       

    </div>
</div>
</div>

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
			speed:300,
			slidesToShow:5,
			slidesToScroll:1,
			cssEase:'linear',
			centerMode:false,
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

		var $caption = $('.gallery-slider .caption');

		
		var captionText = $('.gallery-slider__images .slick-current img').attr('alt');
		updateCaption(captionText);

		
		$imagesSlider.on('beforeChange', function(event, slick, currentSlide, nextSlide){
			$caption.addClass('hide');
		});

	
		$imagesSlider.on('afterChange', function(event, slick, currentSlide, nextSlide){
			captionText = $('.gallery-slider__images .slick-current img').attr('alt');
			updateCaption(captionText);
		});

		function updateCaption(text) {
			
			if (text === '') {
				text = '&nbsp;';
			}
			$caption.html(text);
			$caption.removeClass('hide');
		}
</script>


<script>
    var descriptionExpanded = false;
    
    function toggleDescription() {
      var description = document.getElementById("painting-description");
      var fullDescription = "<?php echo addslashes($row->painting_description); ?>";
      
      if (!descriptionExpanded) {
        description.textContent = fullDescription;   
        descriptionExpanded = true;
       
      } else {
        description.textContent = fullDescription;
        descriptionExpanded = false;
       $('#hide-atype').hide();
         return;
    
      }
    }
  </script>

      </body>
</html>