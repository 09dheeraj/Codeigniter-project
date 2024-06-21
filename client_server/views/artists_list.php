<?php $CI = &get_instance(); ?>
<!-- <div class="second-section ">
    <div class="slider1">
        <?php //$All_category = $CI->getall_category();
        //foreach ($All_category as $cate) { 
        ?>

            <a class="my-anchor text-decoration-none" style="color:black;  cursor: pointer" data-id="<? php // echo $cate->ID; 
                                                                                                        ?>">
                <div class="d-flex small-box">
                    <img src="<? php // echo base_url('assets/images/' . $cate->image); 
                                ?>" alt="">
                    <h4>
                        <?php //echo $cate->title; 
                        ?>
                    </h4>
                </div>
                <form id="myForm" action="<? php // echo base_url('artists_list'); 
                                            ?>" method="post">
                    <input type="hidden" name='hiddentitle' id="dataIdInput" value='<?php //echo $cate->ID; 
                                                                                    ?>'>
                </form>
            </a> 


        <? php // } 
        ?>
       
    </div>

</div> -->

<form action="<?php echo base_url(); ?>artist_selection/<?php echo  $this->uri->segment(2); ?>" method="post">

    <!--card section start-->

    <div class="row text-center mt-5 ">
        <?php
        foreach ($artistInfo as $art) {
           


            $cdate = $art->created_at;
            $year = date('Y', strtotime($cdate));

            $base_price = $CI->getbase_pricePAINTING($art->reg_id);
            $totalpainting = $CI->totalpainting($art->reg_id);

            $getRating_review = $CI->getRating_review($art->reg_id);
          //  print_r($getRating_review);



            if ($getRating_review['totalreview'] > 0) {
                $totalreviewDisplay = $getRating_review['totalreview'];
            } else {
                $totalreviewDisplay = "0";
            }


            $stars = round($getRating_review['avgrat']);
           // print_r($stars);
            $remstar = 5 - $stars;

        ?>

            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6 position-relative selected-card">
                <!-- <input type="checkbox" id="<?php echo $art->reg_id;  ?>" value="<?php echo $art->reg_id; ?>" name="checkoption[]"> -->
                <!-- <label class="custom-control-label" for="<?php echo $art->reg_id; ?>"> -->
                <div class="card text-center  ">
                    <div class="row align-items-center">
                        <div class="col-sm-6">
                            <div class="card-text">
                                <div class="form-group">
                                    <!-- <input class="checkbox" type="checkbox"> -->


                                </div>
                                <img class="artist-cardimg" src="<?php echo base_url('assets/artist_image/');
                                                                    echo $art->profile_image; ?>" alt="">
                                <h4>
                                    <?php echo ucfirst($art->artist_fname); ?>
                                    <?php echo ucfirst($art->artist_lname); ?>
                                </h4>
                                <?php



                                // $cat_array = explode(",", ucfirst($art->category));
                                //  $i = 1;
                                // foreach ($cat_array as $cate_ID) {
                                //    $category_title = $CI->getcategorynamebyid($cate_ID);

                                //    if (!empty($category_title) && is_array($category_title) && isset($category_title[0]->title)) {
                                //echo " " . $category_title[0]->title;
                                //
                                //     if (count($cat_array) != 1 && count($cat_array) != $i) {
                                //      echo ',';
                                //      }
                                //   }

                                //     $i++;
                                //  }
                                ?>
                                <p>
                                    <?php for ($i = 1; $i <= $stars; $i++) { ?><i class="bi bi-star-fill pe-1"></i>
                                    <?php } ?>
                                    <?php for ($i = 1; $i <= $remstar; $i++) { ?><i class="bi bi-star pe-1"></i>
                                    <?php } ?><small></small><span class="ps-2">(
                                        <?php echo $totalreviewDisplay; ?> Reviews)
                                    </span>
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card-text2">
                                <div class="d-flex justify-content-between">

                                    <p> <img class="pe-3" src="<?php echo base_url(); ?>assets/images/location-pin (2).png" alt="">From</p>
                                    <p class="text-end">
                                        <?php echo $art->country;
                                        ?>
                                    </p>
                                </div>
                                <div class="d-flex justify-content-between">

                                    <p> <img class="pe-3" src="<?php echo base_url(); ?>assets/images/user (6).png" alt="">Member Since</p>

                                    <p class="text-end">
                                        <?php echo $year; ?>
                                    </p>
                                </div>
                                <div class="d-flex justify-content-between">

                                    <p> <img class="pe-3" style="width: 36px;" src="<?php echo base_url(); ?>assets/images/07.png" alt="">Painting Base Price</p>
                                    <p class="text-end">
                                        <?php if (!empty($base_price)) {
                                            $minPrice = PHP_INT_MAX;

                                            foreach ($base_price as $price) {
                                                if (isset($price->painting_price)) {
                                                    $minPrice = min($minPrice, $price->painting_price);
                                                }
                                            }

                                            echo '$' . $minPrice;
                                        }
                                        ?>
                                    </p>
                                </div>
                                <div class="button-sec pt-5 ">
                                    <a href="<?php echo base_url(); ?>artist_details/<?php echo $art->reg_id; ?>" class="btn btn-primary">View Profile</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- </label> -->
            </div>
        <?php } ?>

</form>

<!-- <div class="col-12">
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <li class="page-item">
                    <?php // echo $this->pagination->create_links(); 
                    ?>
                </li>
            </ul>
        </nav>
    </div> -->

</div>

</div>
</div>

<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script src="https://kenwheeler.github.io/slick/slick/slick.js"></script>

<script>
    $(document).ready(function() {
        $('.slider1').slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            arrows: true,
            dots: true,
            infinite: true,
            prevArrow: '   <button class="slick-prev slick-arrow border-0" aria-label="Previous" type="button"><img  class="pre-img" src="<?php echo base_url(); ?>assets/images/Group 2422.png" alt=""></button>',
            nextArrow: '   <buttonclass="slick-next slick-arrow border-0"" aria-label="Next" type="button"><img  class="next-img" src="<?php echo base_url(); ?>assets/images/Group 2782.png" alt=""></button>',
            responsive: [{
                    breakpoint: 1599,
                    settings: {
                        slidesToShow: 3,
                    }
                },
                {
                    breakpoint: 1399,
                    settings: {
                        slidesToShow: 2,
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
<script>
    $(document).ready(function() {
        $('.my-anchor').click(function() {
            var dataId = $(this).data('id');
            $('#dataIdInput').val(dataId);
            $('#myForm').submit();
        });
    });
</script>