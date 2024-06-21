<?php $CI = &get_instance();


?>
<?php $individualpainting_review = $CI->individualpainting_review($this->uri->segment(2));

$createdAt = $CI->createdAt($this->uri->segment(2));
$Artistname = $CI->Artistname($purchase_painting[0]->artistID);



if ($individualpainting_review['totalreview'] > 0) {
    $totalreviewDisplay = $individualpainting_review['totalreview'];
} else {
    $totalreviewDisplay = "0";
}


$stars = round($individualpainting_review['avgrat']);
$remstar = 5 - $stars;
?>


<?php if ($this->session->flashdata('success')) { ?>
    <!-- <p style="color:green"><?php // echo $this->session->flashdata('success');?></p>	 -->
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
<div class="individual-painting individual-purchase">
    <img class="w-100"
        src="<?php echo base_url('/assets/artist_paintings/');
        echo $purchase_painting[0]->painting_image; ?>" alt="">
    <h1 class="section-heading py-3">
        <?php echo $purchase_painting[0]->painting_name ?>
    </h1>
    <p class="painting-para">Painting :
        <?php echo $purchase_painting[0]->painting_size ?>
    </p>

    <div class="review-info">
        <span class="star-icons align-top">
            <?php for ($i = 1; $i <= $stars; $i++) { ?><i class="bi bi-star-fill pe-2"></i>
            <?php } ?>
            <?php for ($i = 1; $i <= $remstar; $i++) { ?><i class="bi bi-star pe-2"></i>
            <?php } ?><b class="ps-3 align-bottom text-dark">
                <?php if (isset($totalreviewDisplay)) {
                    echo $totalreviewDisplay;
                } ?>
            </b>
        </span>
    </div>
    <h2>$
        <?php echo $purchase_painting[0]->painting_price ?>
    </h2>
    <p class="painting-para pt-4"><b>Purchase Date:</b><span class="ps-3">
            <?php if (isset($createdAt[0]->created_at)) {
                $d = $createdAt[0]->created_at;
                $newdate = date("d M, Y", strtotime($d));
                echo $newdate;
            } ?>
        </span></p>
    <p class="painting-para"><b>Artist Name:</b><span class="ps-5">
            <?php echo $Artistname[0]->artist_fname ?>
            <?php echo $Artistname[0]->artist_lname; ?>
        </span></p>
    <h1 class="making-text">Painting description for making a painting:</h1>
    <p class="painting-para">
        <?php echo $purchase_painting[0]->painting_description ?>
    </p>
    <?php

    if (isset($check_req) > 0) {
        // echo "hey";
        ?>
        <div class="profile-card  border-0 painting-details mt-5">
            <p class="p-details"><b>Rough Sketches</b></p>

            <div class="select-images">
                <?php foreach ($check_req as $sketches) {
                    $image_arr = explode(",", $sketches->scketch);
                    foreach ($image_arr as $image_name) {


                        ?>

                        <img src="<?php echo base_url('assets/images/' . $image_name); ?>" alt="">
                        <?php
                    }
                }
                ?>
            </div>

        </div>
        <div class="profile-card  border-0 painting-details mt-5">
            <p class="p-details"><b>Reference Images</b></p>
            <div class="select-images">
                <?php foreach ($check_req as $refimg) {
                    $image_arr = explode(",", $refimg->referance_image);
                    foreach ($image_arr as $ref_image) {


                        ?>
                        <img src="<?php echo base_url('assets/images/' . $ref_image); ?>" alt="">
                        <?php
                    }
                }
                ?>
            </div>
        </div>
        <div class="profile-card  border-0 painting-details mt-5">
            <p class="p-details"><b>Reference Video</b></p>
            <div class="select-images text-center">
                <iframe width="1400" height="450" src="<?php echo $check_req[0]->reference_video; ?>"
                    title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    allowfullscreen></iframe>
            </div>
        </div>
        <div class="profile-card  border-0 painting-details mt-5 mb-5">
            <p class="p-details"><b>Resources submitted by Artist</b></p>
            <div class="select-images ">
                <?php foreach ($check_req as $submit) {
                    $image_arr = explode(",", $submit->sub_by_artist);
                    foreach ($image_arr as $submit_img) {


                        ?>
                        <img src="<?php echo base_url('assets/images/' . $submit_img); ?>" alt="">
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    <?php } elseif (isset($check_req) == "false") {
        ?>
        <hr>
        <?php

    } ?>
    <?php if ($this->uri->segment(2)) {
        $ToTalreview = $CI->TotalPantingReview($this->uri->segment(2));
        $numOfreview = $CI->paintreviewnumber($this->uri->segment(2));
        //echo gettype($ToTalreview);
        //echo $ToTalreview[0]->total;
    }

    ?>
    <?php
    if (isset($numOfreview) && isset($ToTalreview)) {
        $numFive = intval($numOfreview['five']);
        $TOTal = $ToTalreview[0]->total;
        //print_r($TOTal);
        if ($TOTal != 0) {
            $ratingpercent = ($numFive / $TOTal) * 100;
        } else {
            $ratingpercent = 0;
        }

    }

    ?>


    <div class="review-section  mt-5 mb-5 ps-3">
        <h1 class="  section-heading"><b>Review and Rating</b><span class="star-icons align-top ps-3">
                <?php for ($i = 1; $i <= $stars; $i++) { ?><i class="bi bi-star-fill pe-2"></i>
                <?php } ?>
                <?php for ($i = 1; $i <= $remstar; $i++) { ?><i class="bi bi-star pe-2"></i>
                <?php } ?><b class="ps-3 align-bottom">
                    <?php if (isset($stars)) {
                        echo $stars;
                    } ?>
                </b>
            </span></h1>
        <div class="progress-review d-flex">
            <span>5 Stars</span>
            <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="75" aria-valuemin="0"
                aria-valuemax="100">
                <div class="progress-bar " style="width:<?php if (isset($ratingpercent)) {
                    echo $ratingpercent;
                } ?>%;"></div>
            </div>
            <span>(
                <?php if (isset($numOfreview['five'])) {
                    echo $numOfreview['five'];
                } ?>)
            </span>
        </div>
        <?php
        if (isset($numOfreview) && isset($ToTalreview)) {
            $numFive = intval($numOfreview['four']);
            $TOTal = $ToTalreview[0]->total;

            if ($TOTal != 0) {
                $ratingpercent = ($numFive / $TOTal) * 100;
            } else {
                $ratingpercent = 0;
            }

        }

        ?>
        <div class="progress-review d-flex">
            <span>4 Stars</span>
            <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="25" aria-valuemin="0"
                aria-valuemax="100">
                <div class="progress-bar " style="width:<?php if (isset($ratingpercent)) {
                    echo $ratingpercent;
                } ?>%;"></div>
            </div>
            <span>(<?php if (isset($numOfreview['four'])) {
                    echo $numOfreview['four'];
                } ?>)
            </span>
        </div>
        <?php
        if (isset($numOfreview) && isset($ToTalreview)) {
            $numFive = intval($numOfreview['three']);
            $TOTal = $ToTalreview[0]->total;

            if ($TOTal != 0) {
                $ratingpercent = ($numFive / $TOTal) * 100;
            } else {
                $ratingpercent = 0;
            }

        }

        ?>
        <div class="progress-review d-flex">
            <span>3 Stars</span>
            <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="25" aria-valuemin="0"
                aria-valuemax="100">
                <div class="progress-bar " style="width:<?php if (isset($ratingpercent)) {
                    echo $ratingpercent;
                } ?>%;"></div>
            </div>
            <span>(
                <?php if (isset($numOfreview['three'])) {
                    echo $numOfreview['three'];
                } ?>)
            </span>
        </div>
        <?php
        if (isset($numOfreview) && isset($ToTalreview)) {
            $numFive = intval($numOfreview['two']);
            $TOTal = $ToTalreview[0]->total;

            if ($TOTal != 0) {
                $ratingpercent = ($numFive / $TOTal) * 100;
            } else {
                $ratingpercent = 0;
            }

        }

        ?>
        <div class="progress-review d-flex disabled">
            <span disabled>2 Stars</span>
            <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="20" aria-valuemin="0"
                aria-valuemax="100">
                <div class="progress-bar " style="width:<?php if (isset($ratingpercent)) {
                    echo $ratingpercent;
                } ?>%;"></div>
            </div>
            <span>(
                <?php if (isset($numOfreview['two'])) {
                    echo $numOfreview['two'];
                } ?>)
            </span>
        </div>
        <?php
        if (isset($numOfreview) && isset($ToTalreview)) {
            $numFive = intval($numOfreview['one']);
            $TOTal = $ToTalreview[0]->total;

            if ($TOTal != 0) {
                $ratingpercent = ($numFive / $TOTal) * 100;
            } else {
                $ratingpercent = 0;
            }

        }

        ?>
        <div class="progress-review d-flex disabled">
            <span disabled>1 Stars</span>
            <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="20" aria-valuemin="0"
                aria-valuemax="100">
                <div class="progress-bar" style="width:<?php if (isset($ratingpercent)) {
                    echo $ratingpercent;
                } ?>%;"></div>
            </div>
            <span>(
                <?php if (isset($numOfreview['one'])) {
                    echo $numOfreview['one'];
                } ?>)
            </span>
        </div>
    </div>


    <?php

    if ($check_reviews == 'true') {
        ?>
        <?php
    } elseif ($check_reviews == 'false') {
        ?>
        <form id="review-form" action="<?php echo base_url('submit_review'); ?>" method="post">
            <div class="share-review">
                <p class="p-details"><b>Share Your Reviews</b></p>

                <div class="write-review">
                    <textarea id="write_review" class="form-control border-dark" name="write_review" required></textarea>
                    <input type="hidden" name="paint_id" value="<?php echo $this->uri->segment(2); ?>">
                </div>

                <p class="p-details p-0"><b>Give a rating</b></p>
                <span class="rating-star">
                    <i class="bi bi-star star-icon" data-rating="1"></i>
                    <i class="bi bi-star star-icon" data-rating="2"></i>
                    <i class="bi bi-star star-icon" data-rating="3"></i>
                    <i class="bi bi-star star-icon" data-rating="4"></i>
                    <i class="bi bi-star star-icon" data-rating="5"></i>
                </span>
                <input type="hidden" id="clicked-stars-input" name="selected_rating" value="0">
            </div>

            <button id="submit-btn" class="btn btn-primary">Submit</button>
        </form>
    <?php
    }
    ?>

    <div id="message-container"></div>
    <div class="customer-review">
        <h2>Reviews by customers</h2>
        <hr>
        <div class="review-box d-flex">

            <?php $individualcustomerReview = $CI->individualcustomerReview($this->uri->segment(2));
            $paintingID = $this->uri->segment(2);
            foreach ($individualcustomerReview as $custreview) {
                $id = $custreview->customer_id;
                $customer_DATA = $CI->customer_DATA($id);
                $getindividualRating = $CI->individualPaintingRating($id, $paintingID);
                $stars = round($getindividualRating[0]->rating);
                $remstar = 5 - $stars;
                ?>
                <div class="review-img">
                    <img src="<?php echo base_url('assets/customer_image/'); ?><?php if (isset($customer_DATA[0]->profile_image)) {
                           echo $customer_DATA[0]->profile_image;
                       } ?>" alt="">
                </div>

                <div class="review-info ps-3">
                    <h4>
                        <?php if (isset($customer_DATA[0]->first_name)) {
                            echo $customer_DATA[0]->first_name;
                        } ?>
                        <?php if (isset($customer_DATA[0]->last_name)) {
                            echo $customer_DATA[0]->last_name;
                        } ?>
                    </h4>
                    <small>
                        <?php if (isset($customer_DATA[0]->country)) {
                            echo $customer_DATA[0]->country;
                        } ?>
                    </small><br>
                    <span class="star-icons align-top ps-3">
                        <?php for ($i = 1; $i <= $stars; $i++) { ?><i class="bi bi-star-fill pe-2"></i>
                        <?php } ?>
                        <?php for ($i = 1; $i <= $remstar; $i++) { ?><i class="bi bi-star pe-2"></i>
                        <?php } ?><b class="ps-3 align-bottom">
                            <?php echo $stars; ?> &nbsp; <small class="ps-2 ps-2 border-start">&nbsp;
                                <?php if (isset($custreview->createdAt)) {
                                    $d = $custreview->createdAt;
                                    $newdate = date("d M, Y", strtotime($d));
                                    echo $newdate;
                                } ?>
                            </small>
                        </b>
                    </span>
                    <p>
                        <?php if (isset($custreview->description)) {
                            echo $custreview->description;
                        } ?>
                    </p>

                </div>
            </div>
            <hr>
        <?php } ?>

    </div>


</div>






</div>
</div>
</div>

<script>
    $(document).ready(function () {
        $("#Load-more").click(function (e) {
            e.preventDefault();
            $(".on-loadmorediv").slice(0, 3).fadeIn("slow");

            if ($(".on-loadmorediv").length == 0) {
                $("#Load-more").fadeOut("slow");
            }
            if ($(".on-loadmorediv:hidden").length == 0) {
                $(".load-more").css('visibility', 'hidden');
            }
        });
    })
</script>

<style>
    #message-container {
        padding: 10px;
        font-weight: bold;
        text-align: center;
    }

    .success-message {
        color: green;
    }

    .error-message {
        color: red;
    }

    .yellow-text {
        color: red;
    }

    .star-icon.bi-star-fill {
        color: #f5bd06;
    }
</style>


<script>
    $(document).ready(function () {
        $('.star-icon').hover(function () {

        }, function () {

        });

        $('.star-icon').click(function () {
            var clickedStars = $(this).index() + 1;
            $('#clicked-stars-input').val(clickedStars);

            $('.star-icon').removeClass('bi-star-fill').addClass('bi-star');
            $('.star-icon:lt(' + clickedStars + ')').addClass('bi-star-fill').removeClass('bi-star');
        });

        $('#reviewForm').submit(function (event) {

        });
    });
</script>
<script>
    var timeout = 3000;

    $('.alert').delay(timeout).fadeOut(350);
</script>




