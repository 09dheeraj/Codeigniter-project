<?php $CI = &get_instance(); ?>

<style>
    body {
        margin: 0;
        font-family: Arial, sans-serif;
    }

    .container {
        width: 1400px;
        margin: 20px auto;
        columns: 4;
        column-gap: 20px;
    }

    .container .box {
        width: 100%;
        margin-bottom: 10px;
        break-inside: avoid;
    }

    .container .box img {
        max-width: 100%;
        border-radius: 6px;
        border: 8px solid #aaa2ff;
    }

    .star-icon.bi-star-fill {
        color: #f5bd06;
    }
</style>

<?php if ($this->session->flashdata('success')) { ?>

    <p class="alert text-success alert-dismissable">
        <?php echo $this->session->flashdata('success'); ?>
    </p>
<?php } ?>

<!--error message -->
<?php if ($this->session->flashdata('error')) { ?>
    <p class="alert text-danger alert-dismissable">
        <?php echo $this->session->flashdata('error'); ?>
    </p>
<?php } ?>
<div class="artist-info ">
    <div class="w-100">
        <img class="w-100 nature-img" src="<?php echo base_url(); ?>assets/images/abstract-nature.jpg" alt="">
    </div>

    <div class="Artist-Detail d-flex justify-content-between">
        <div class="detail-text d-flex">
            <img src="<?php echo base_url('assets/artist_image/');
    
                        if (isset($artistdetails[0]->profile_image)) {
                            echo $artistdetails[0]->profile_image;
                        } ?>" alt="">
            <div class="detail-box">
                <h1 class="section-heading pb-1"><b>
                        <?php if (isset($artistdetails[0]->artist_fname)) {
                            echo ucfirst($artistdetails[0]->artist_fname);
                        } ?>
                        <?php if (isset($artistdetails[0]->artist_lname)) {
                            echo ucfirst($artistdetails[0]->artist_lname);
                        } ?>
                    </b></h1>

                <h5 class="pb-1">
                    <?php

                    if (isset($artistdetails[0]->category)) {

                        $cat_array = explode(",", ucfirst($artistdetails[0]->category));
                        $i = 1;
                        foreach ($cat_array as $cate_ID) {
                            $category_title = $CI->getcategorynamebyid($cate_ID);
                            if (isset($category_title[0]->title)) {
                                echo " " . $category_title[0]->title;
                                if (count($cat_array) != 1 && count($cat_array) != $i) {
                                    echo ',';
                                }
                                $i++;
                            }
                        }
                    }
                   
                    ?>
                </h5>
                <h5>
                      <?php 
                                 $getRating_review = $CI->getRating_review($this->uri->segment(2));
                                
                                 if(!empty($getRating_review))
                                 {
                                   $total_stars = round($getRating_review['avgrat']);
                                  // print_r($total_stars);
                                   $rem_stars = 5 - $total_stars;
                                 }
                                 else
                                 {
                                   $total_stars ='0';
                                   $rem_stars ='5';
                                 }

                     ?>
                       <span class="star-icons "><small></small>   <?php for ($i = 1; $i <= $total_stars; $i++) { echo '<i class="bi bi-star-fill ps-2"></i>';}?> <?php for ($i = 1; $i <= $rem_stars; $i++) { echo '<i class="bi bi-star ps-1"></i>';}?></span>
                </h5>
            </div>
        </div>
        <div class="detail-btn  ">
            <!-- <button class="btn btn-primary contact-me" data-bs-toggle="modal" data-bs-target="#contactModal">Contact
                me</button>
            <a href="<?php //echo base_url('request_form'); 
                        ?>" class="btn btn-primary"> Paint Request</a> -->
        </div>
    </div>

</div>

<div class="about-section ">
    <h1 class=" section-heading"><b>About</b></h1>
    <div class="about-info">


        <?php


        if (isset($artistdetails[0]->reg_id)) {
            $totalpainting = $CI->totalpainting($artistdetails[0]->reg_id);

            $getRating_review = $CI->getRating_review($artistdetails[0]->reg_id);
            //print_r($getRating_review);
            if ($getRating_review['totalreview'] > 0) {
                $totalreviewDisplay = $getRating_review['totalreview'];
            } else {
                $totalreviewDisplay = "0";
            }


            $stars = round($getRating_review['avgrat']);
            $remstar = 5 - $stars;
        }
        ?>

        <div class="row p-3  ">
            <div class="col-sm-12  col-md-6 col-lg-6 ">
                <div class="d-flex">
                    <span> <img class="pe-3" src="<?php echo base_url(); ?>assets/images/user (6) (1).png" alt=""></span>
                    <h5>Member Since
                        <?php 
                        $get_created_at = $CI->get_created_at($artistdetails[0]->reg_id);
                    
                        if (!empty($get_created_at)) {
                            $cdate = $get_created_at[0]->created_at;
                            $year = date('Y', strtotime($cdate));
                            echo $year;
                        } ?>
                    </h5>
                </div>
            </div>
            <div class="col-sm-12  col-md-6 col-lg-6">
                <div class="d-flex">
                    <span> <img class="pe-3" src="<?php echo base_url(); ?>assets/images/location-pin (2) (1).png" alt=""></span>
                    <h5>Lives in
                        <?php if (isset($artistdetails[0]->country)) {
                            echo ucfirst($artistdetails[0]->country);
                        } ?>
                    </h5>
                </div>
            </div>

        </div>
        <div class="row p-3">
            <div class="col-sm-12  col-md-6 col-lg-6">
                <div class="d-flex">
                    <span> <img class="pe-3" src="<?php echo base_url(); ?>assets/images/feedback.png" alt=""></span>
                    <h5>
                        <?php if (isset($totalreviewDisplay)) {
                            echo $totalreviewDisplay;
                        } ?> Reviews
                    </h5>
                </div>
            </div>
            <div class="col-sm-12  col-md-6 col-lg-6">
                <?php if (isset($artistdetails[0]->reg_id)) {
                    $TotalPAnting = $CI->Totalpaint($artistdetails[0]->reg_id);
                } else {
                    $TotalPAnting = "0";
                }
                ?>
                <div class="d-flex">
                    <span> <img class="pe-3" src="<?php echo base_url(); ?>assets/images/paint-board-and-brush (1).png" alt=""></span>
                    <h5>Total Paintings (<?php if (isset($TotalPAnting)) {
                                                echo $TotalPAnting->paintings;
                                            } else {
                                                echo "0";
                                            } ?>)
                    </h5>
                </div>
            </div>


        </div>


        <p class="p-3">
            <?php if (isset($artistdetails[0]->about_artist)) {
                echo ucfirst($artistdetails[0]->about_artist);
            } ?>
        </p>
    </div>
</div>

<div id="show_row">
    <div class="col-md-12 mt-4 text-end ">
    </div>


    <div class="row align-items-center">
        <div class="col-sm-12  col-md-6 col-lg-3">
            <div class="form-group">
                <label>Height <small class="text-dark">(Inches)</small></label>

            </div>
        </div>
        <div class="col-sm-12  col-md-6 col-lg-3">
            <div class="form-group">
                <label>Width <small class="text-dark">(Inches)</small></label>

            </div>
        </div>
        <div class="col-sm-12  col-md-6 col-lg-2">
            <div class="form-group">
                <label> Price <small class="text-dark">($)</small> </label>

            </div>
        </div>
        <div class="col-sm-12  col-md-6 col-lg-2">
            <div class="form-group">
                <label>Version </label>

            </div>
        </div>
    </div>
    <?php

    $CI = &get_instance();
    $artist_id = $this->uri->segment(2);

    $painting_demensions = $CI->painting_demensions($artist_id);
    foreach ($painting_demensions as $row) {
    ?>
        <div class="row align-items-center mt-3">
            <div class="col-sm-12  col-md-6 col-lg-3">
                <div class="form-group">

                    <h5><?php echo $row->painting_height; ?></h5>
                </div>
            </div>
            <div class="col-sm-12  col-md-6 col-lg-3">
                <div class="form-group">

                    <h5><?php echo $row->painting_width; ?></h5>
                </div>
            </div>
            <div class="col-sm-12  col-md-6 col-lg-2">
                <div class="form-group">

                    <h5><?php echo $row->painting_price; ?></h5>
                </div>
            </div>
            <div class="col-sm-12  col-md-6 col-lg-2">
                <div class="form-group">

                    <h5><?php echo $row->painting_version; ?></h5>
                </div>
            </div>

            <?php $temp_paint_Id = $this->uri->segment(3);
          
            if(!empty($temp_paint_Id)){ ?>
            <div class="update-btn text-center col-sm-12  col-md-6 col-lg-2 ">
                <a href="<?php echo base_url('buy_now'); ?>/<?php echo $row->id; ?>/<?php echo $temp_paint_Id;?>/<?php echo $artist_id; ?>" class="edit-profile-img buy-now remove_row_painting mt-0 text-decoration-none"> Buy Now</a>
            </div>
            <?php }else{?>

                <div class="update-btn text-center col-sm-12  col-md-6 col-lg-2 ">
                <a href="<?php echo base_url('request_form'); ?>" class="edit-profile-img buy-now remove_row_painting mt-0"> Request Painting</a>
            </div>
            <?php }?>
        </div>

    <?php } ?>


    <div class="gallery-section ">
        <h1 class="section-heading mt-4"><b>Gallery</b></h1>
        <?php $artistPaintings = $CI->artistPaintingsData($artistdetails[0]->reg_id);

        foreach ($artistPaintings as $cId) {

       
            if (!empty($cId->sub_by_artist)) {

                $cust_id = $cId->customer_id;
               // print_r($cust_id);
                $check_role = $CI->check_role($cust_id);
                   
                //  print_r($check_role);
                if ($check_role[0]->user_role == 2) {
                    $getcust_name = $CI->getartist_name($cust_id);
                    if(!empty($getcust_name)){

                        $artist_profile_image = $getcust_name[0]->profile_image;
                    }
                    //  print_r($getcust_name);
                } else {
                    $getcust_name = $CI->getcust_name($cust_id);
                    $artist_profile_image =$getcust_name[0]->profile_image;
                   
                    //  print_r($getcust_name);
                }



                // echo "<pre>";
                // print_r($artistPaintings);


                $artist_images = explode(",", $cId->sub_by_artist);

                $num_of_images = count($artist_images);

        ?>
                <div class="request-detail-slider card mb-5 ">

                    <div class=" artist-text ">

                        <h1><a href="<?php echo base_url('myrequest_detail/') . $cId->tem_paint_id; ?>">
                                <?php if (isset($cId->painting_title)) {
                                    $titlewords = explode(' ', $cId->painting_title);
                                    $maxWords = 7;
                                    $limitedtitle = implode(' ', array_slice($titlewords, 0, $maxWords));
                                    echo ucfirst($limitedtitle);
                                } ?>
                            </a></h1>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-sm-2">
                            <div class="">
                                <?php if ($check_role[0]->user_role == 2) {

                                ?>
                                    <img class="request-detail-profile" src="<?php echo base_url(); ?>assets/artist_image/<?php if (!empty($getcust_name[0])) {
                                         $artist_profile_image = $getcust_name[0]->profile_image;
                                                                                                                                echo $artist_profile_image;
                                                                                                                            } ?>">

                                    <h4>
                                        <?php if (!empty($getcust_name))
                                            echo $getcust_name[0]->artist_fname; ?>
                                        <?php if (!empty($getcust_name)) {
                                            echo $getcust_name[0]->artist_lname;
                                        } ?>
                                    </h4>
                                <?php
                                } else {
                                ?>
                                    <img class="request-detail-profile" src="<?php echo base_url(); ?>assets/customer_image/<?php if (!empty($getcust_name[0])) {
                                                                                                                                echo $artist_profile_image;
                                                                                                                            } ?>">

                                    <h4>
                                        <?php if (!empty($getcust_name))
                                            echo $getcust_name[0]->first_name; ?>
                                        <?php if (!empty($getcust_name)) {
                                            echo $getcust_name[0]->last_name;
                                        } ?>
                                    </h4>
                                <?php

                                }
                                ?>

                            </div>
                        </div>
                        <div class="col-sm-10">

                            <?php

                            if ($num_of_images == 1) {
                                foreach ($artist_images as $images) { ?>

                                    <div class="slider-image-canvas" data-bs-toggle="modal" data-bs-target="#exampleModal-<? //php // echo $id; 
                                                                                                                            ?>"> <a href="<?php echo base_url(); ?>assets/artist_paintings/<?php echo $images; ?>" class="bg-none" target="_blank"><img style="width: 300px;" src="<?php echo base_url(); ?>assets/artist_paintings/<?php echo $images; ?>"></a> </div>
                                <?php }
                            } else { ?>
                                <div class="slick-slider3">
                                    <!-- <button class="slick-prev slick-arrow border-0 slickbtn3" aria-label="Previous" type="button"><img class="pre-img" src="https://influocial.co/staging-pb/assets/images/Group 2422.png" alt=""></button>
                                <button class="slick-next slick-arrow border-0 slickbtn3" aria-label="Next" type="button"><img class="next-img" src="https://influocial.co/staging-pb/assets/images/Group 2782.png" alt=""></button> -->
                                    <?php foreach ($artist_images as $images) { // print_r($images);
                                    ?>

                                        <div class="slider-image-canvas" > <a href="<?php echo base_url(); ?>assets/artist_paintings/<?php echo $images; ?>" class="bg-none p-0" target="_blank"> <img src="<?php echo base_url(); ?>assets/artist_paintings/<?php echo $images; ?>"> </a>
                                        </div>
                                    <?php } ?>

                                </div>
                            <?php } ?>
                        </div>

                    </div>




                    <?php

                    if (!empty($cId->rating)) {


                    ?>
                        <div class="row align-items-center justify-content-end">
                            <div class="submit-btn col-sm-3">
                                <div class="text-end" data-bs-toggle="modal" data-bs-target="#review-<?php //echo $id; 
                                                                                                        ?>"><button class="btn btn-primary submit-btn">Submitted Review</button></div>
                                <div class="submited-review col-sm-4">

                                    <?php
                                    $stars = $cId->rating;
                                    $rem_stars = 5 - $stars;

                                    ?>

                                    <span class="rating-star">
                                        <?php
                                        for ($i = 1; $i <= $stars; $i++) { ?>
                                            <i class="bi bi-star-fill text-warning star-icon"></i>
                                        <?php }
                                        for ($i = 1; $i <= $rem_stars; $i++) {

                                        ?>
                                            <i class="bi bi-star star-icon"></i>
                                        <?php } ?>
                                    </span>
                                    <p class="p-details p-0">
                                        <?php echo $cId->reviews; ?>
                                    </p>
                                </div>
                            </div>

                        </div>
                </div>
            <?php } else { ?>
                <div class="row align-items-center justify-content-end">
                    <div class="submit-btn col-sm-3">
                        <div class="text-end" data-bs-toggle="modal" data-bs-target="#review-"></div>
                        <div class="submited-review col-sm-4">



                            <span class="rating-star">

                                <i class="bi bi-star-fill text-warning star-icon"></i>

                                <i class="bi bi-star star-icon"></i>

                            </span>
                            <p class="p-details p-0">

                            </p>
                        </div>
                    </div>

                </div>
    </div>
<?php } ?>


<?php
            }
        }
?>


<!-- contact-Modal -->
<div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-body">

                <form id="Contact_form" action="<?php echo base_url('contact/' . $this->uri->segment(2)); ?>" method="post">
                    <div class="text-end pe-3">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <img src="<?php echo base_url(); ?>assets/images/close (4).png" alt="">
                        </button>
                    </div>
                    <h2 class="text-center painting-heading">Contact me</h2>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="cust_name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="cust_email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Message</label>
                        <textarea class="form-control" name="cust_msg"></textarea>
                    </div>
                    <div class="modal-btn text-center mt-5">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>







<script>
    $(document).ready(function() {
        $("#Contact_form").validate({
            rules: {
                cust_name: {
                    required: true
                },
                cust_email: {
                    required: true,
                    email: true
                },
                cust_msg: {
                    required: true,
                }

            },
            messages: {
                cust_name: {
                    required: "Name is required"
                },
                cust_email: {
                    required: "Email is required",
                    email: "Please enter a valid email address"
                },
                cust_msg: {
                    required: "Message is required",
                },

            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        var offset = 20;
        var entriesPerRequest = 8;


        $('#load-more-btn').click(function() {
            var currentURL = window.location.href;
            var urlObject = new URL(currentURL);
            var pathSegments = urlObject.pathname.split('/');

            var artist_id = pathSegments[3];
            var vdata = {
                artist_id: artist_id,
                limit: offset
            }
            $.ajax({
                url: "<?php echo base_url() ?>Customer/getmore_images",
                type: 'post',
                data: vdata,
                success: function(response) {

                    $("#messageBody").html(response.html);
                    if (offset > response.totalPainting) {
                        $('#load-more-btn').hide();
                    }

                    offset += entriesPerRequest;

                }
            });
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('.star-icon').hover(function() {

        }, function() {

        });

        $('.star-icon').click(function() {
            var clickedStars = $(this).index() + 1;
            $('#clicked-stars-input').val(clickedStars);

            $('.star-icon').removeClass('bi-star-fill').addClass('bi-star');
            $('.star-icon:lt(' + clickedStars + ')').addClass('bi-star-fill').removeClass('bi-star');
        });

        $('#reviewForm').submit(function(event) {

        });
    });
</script>
<script>
    var timeout = 3000;

    $('.alert').delay(timeout).fadeOut(350);
</script>
<!-- 
<script>
    $(document).ready(function () {
        // Handle star rating clicks
        $(".star").click(function () {
            var rating = $(this).data("rating");
            $("#selected_rating").val(rating);
            $(".star").removeClass("active");
            $(this).addClass("active");
        });

    
        $("#submit-btn").click(function (e) {
            e.preventDefault();
            var formData = $("#review-form").serialize();

            $.ajax({
                url: $("#review-form").attr("action"),
                type: "POST",
                data: formData,
                success: function (response) {
                    if (response.includes("success")) {
                        alert("Review submitted successfully.");
                    
                    } else if (response.includes("error")) {
                        alert(" Review already submitted.");
                    } else {
                        alert("An unknown error occurred.");
                    }
                },
                error: function () {
                    alert("Error submitting review.");
                }
            });
        });
    });
</script> -->
<!-- <p class="p-details p-0"><b>Give a rating</b></p>
                                    <div class="rating-stars">
                                        <span class="star" data-rating="1"><i class="bi bi-star star-icon"></i></span>
                                        <span class="star" data-rating="2"><i class="bi bi-star star-icon"></i></span>
                                        <span class="star" data-rating="3"><i class="bi bi-star star-icon"></i></span>
                                        <span class="star" data-rating="4"><i class="bi bi-star star-icon"></i></span>
                                        <span class="star" data-rating="5"><i class="bi bi-star star-icon"></i></span>
                                    </div>
                                    <input type="hidden" id="selected_rating" name="selected_rating" value="0">
                                </div> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/additional-methods.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.6.2/chosen.jquery.min.js"></script>

<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script> 
<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script src="https://kenwheeler.github.io/slick/slick/slick.js"></script> -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script src="https://cdn.rawgit.com/kenwheeler/slick/master/slick/slick.min.js"></script>
<script>
    $(document).ready(function() {
        $('.slick-slider3').slick({
            slidesToShow:4,
            slidesToScroll: 1,
            arrows: true,
            dots: false,
            infinite: false,
            prevArrow: '<button class="slick-prev slick-arrow border-0 slickbtn3" aria-label="Previous" type="button"><img class="pre-img" src="https://influocial.co/staging-pb/assets/images/Group 2422.png" alt=""></button>',
            nextArrow: '<button class="slick-next slick-arrow border-0 slickbtn3" aria-label="Next" type="button"><img class="next-img" src="https://influocial.co/staging-pb/assets/images/Group 2782.png" alt=""></button>',
            responsive: [{
                    breakpoint: 1599,
                    settings: {
                        slidesToShow: 3,
                    }
                },
                {
                    breakpoint: 1399,
                    settings: {
                        slidesToShow: 3,
                    }
                },
                {
                    breakpoint: 1199,
                    settings: {
                        slidesToShow: 2,
                    }
                },
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 2,
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1,
                    }
                },
                {
                    breakpoint: 767,
                    settings: {
                        slidesToShow: 1,
                    }
                }
            ]
        });
    });
</script>