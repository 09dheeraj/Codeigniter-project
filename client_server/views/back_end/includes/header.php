<!doctype html>
<html lang="en">

<head>
    <link rel="icon" href="<?php echo base_url(); ?>assets/images/logo.png">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> <?php echo $page_title; ?></title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/responsive.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link href=" https://cdn.rawgit.com/kenwheeler/slick/master/slick/slick.css" rel="stylesheet">
    <link href=" https://cdn.rawgit.com/kenwheeler/slick/master/slick/slick-theme.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.6.2/chosen.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>
    <div class="data">

        <?php
        $addclassheader =  $this->uri->segment(1);
        $addclassartistmodule = $this->uri->segment(1);

        if ($addclassheader == 'request_form') {
            echo "<div class= 'header form-sidebar'>";
        } else if($addclassheader == 'art_paint_request'){

            echo "<div class= 'header form-sidebar'>";
        }else{
            
            echo "<div class= 'header'>";
        }

        ?>
        <!-- <div class="header"> -->
        <div class="logo-sec">
            <img src="<?php echo base_url(); ?>assets/images/logo-2.png" alt="">
        </div>

    </div>
    <div class="wrapper">
        <?php $addclass =  $this->uri->segment(1);

        if ($addclass == 'request_form') {
            echo "<div class= 'sidebar form-sidebar'>";
        } else if($addclass == 'art_paint_request' ) {

            echo "<div class= 'sidebar form-sidebar'>";
        }else{
            
            echo "<div class= 'sidebar'>";
        }
        ?>
        <!-- <div class="sidebar"> -->
        <navbar>
            <ul class="navbar-list list-unstyled text-center">
                <?php
                if ($this->session->userdata('user_role') == "2") {
                ?>

                    <!-- <li>
                                <a href="<?php //echo base_url('dashboard'); 
                                            ?>">
                                    <img src="<?php //echo base_url(); 
                                                ?>assets/images/dashboard (2).png" alt="">
                                    <span>Dashboard</span>
                                </a>
                            </li> -->
                    <!-- <li>
                                <a href="<?php //echo base_url('artist_gallery'); 
                                            ?>">
                                    <img src="<?php // echo base_url(); 
                                                ?>assets/images/gallery.png" alt="">
                                    <span>My Gallery</span>
                                </a>
                            </li> -->
                    <!-- <li>
                                <a href="<?php //echo base_url('purchase_requests'); 
                                            ?>">
                                    <img src="<?php //echo base_url(); 
                                                ?>assets/images/shopping-bag.png" alt="">
                                    <span> Puschase Request</span>
                                </a>
                            </li> -->
                    <li>
                        <a href="<?php echo base_url('art_paint_request'); ?>">
                            <img src="<?php echo base_url(); ?>assets/images/canvas.png" alt="">
                            <?php $addclassspanartist  =  $this->uri->segment(1);


                            if ($addclassspanartist == 'art_paint_request') {

                                echo "<span class='d-none'> </span>";
                            } else {
                                echo "<span>Request Painting</span>";
                            } ?>

                            <!-- <span class="span">Request Painting</span> -->
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>pastsubmittedrequests">
                            <img src="<?php echo base_url(); ?>assets/images/upload.png" alt="">
                            <?php $addclassspanPainting  =  $this->uri->segment(1);


                            if ($addclassspanPainting == 'art_paint_request') {

                                echo "<span class='d-none'> </span>";
                            } else {
                                echo "<span>Submitted Painting</span>";
                            } ?>
                            <!-- <span>Submitted Painting</span> -->
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>Requested_Painting">
                            <img src="<?php echo base_url(); ?>assets/images/requested.png" alt="">

                            <?php $addclassspanPaintingRequested  =  $this->uri->segment(1);


                            if ($addclassspanPaintingRequested == 'art_paint_request') {

                                echo "<span class='d-none'> </span>";
                            } else {
                                echo "<span>Requested Painting</span>";
                            } ?>

                            <!-- <span>Requested Painting</span> -->
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>generate_random_request">
                            <img src="<?php echo base_url(); ?>assets/images/randompainting.png" alt="">
                            <?php $addclassspanPaintingRandom  =  $this->uri->segment(1);


                            if ($addclassspanPaintingRandom == 'art_paint_request') {

                                echo "<span class='d-none'> </span>";
                            } else {
                                echo "<span>Generate Random Request</span>";
                            } ?>
                            <!-- <span>Generate Random Request</span> -->
                        </a>
                    </li>

            </ul>
        </navbar>
    </div>

    <?php $addclasscontenttt =  $this->uri->segment(1);

if ($addclasscontenttt == 'art_paint_request') {
    echo "<div class='right-content form-right-content'>";
} else {

    echo "<div class= 'right-content'>";
}
?>

    <!-- <div class="right-content"> -->

        <!--top header-->
        <div class="row">
            <div class="col-sm-12">
                <div class=" top-header d-flex justify-content-end mb-4">
                    <div class="artist-text">
                        <h1><?php echo $title; ?></h1>
                    </div>
                    <?php  //print_r($this->session->userdata('profile_image'));
                    ?>
                    <div class="profile-img  ms-auto">
                        <a href="#" type="button" class=" dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php $sessionData = $this->session->userdata('profile_image'); ?>
                            <img src="<?php echo base_url('/assets/artist_image/');
                                        echo $sessionData; ?>" alt=""></a>

                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?php echo base_url('profile_management'); ?>"> <img class="pe-3" src="<?php echo base_url(); ?>assets/images/user-9.png" alt="">My Profile</a></li>
                            <li><a class="dropdown-item" href="<?php echo base_url('customer_logout'); ?>"> <img class="pe-3" src="<?php echo base_url(); ?>assets/images/logout-3.png" alt="">Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!--top header-->
        <?php if ($title == 'Painting Requests') {
        ?>
            <div class="row">
                <div class="col-12">
                    <div class="genrate-req text-end">
                        <a href="<?php echo base_url('random_request'); ?>" class="btn btn-primary ">Generate Random Request</a>
                    </div>
                </div>
            </div>
        <?php } ?>

    <?php
                } elseif ($this->session->userdata('user_role') == "1") { ?>


        <li>
            <a href="<?php echo base_url(); ?>dashboard">
                <img src="<?php echo base_url(); ?>assets/images/dashboard (2).png" alt="">
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>customer">
                <img src="<?php echo base_url(); ?>assets/images/customer-icon.png" alt="">
                <span>Customer</span>
            </a>
        </li>

        <li>
            <a href="<?php echo base_url(); ?>artist_list">
                <img src="<?php echo base_url(); ?>assets/images/artist.png" alt="">
                <span> Artists</span>
            </a>
        </li>

        <li>
            <a href="<?php echo base_url(); ?>request_form">
                <img src="<?php echo base_url(); ?>assets/images/canvas.png" alt="">
                <span> Painting Request</span>
            </a>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>pastsubmittedrequests">
                <img src="<?php echo base_url(); ?>assets/images/upload.png" alt="">
                <span> Past Submitted</span>
            </a>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>my_purchases">
                <img src="<?php echo base_url(); ?>assets/images/shopping-bag.png" alt="">
                <span> My Purchases</span>
            </a>
        </li>
        </ul>
        </navbar>
    </div>
    <div class="right-content">
        <!--top header-->
        <div class="row mb-5 ">
            <div class="col-sm-12">
                <div class=" top-header d-flex justify-content-end mb-4">
                    <div class=" artist-text ">

                        <h1><?php echo $title; ?></h1>
                    </div>

                    <div class="profile-img  ">

                        <a href="#" type="button" class=" dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php $sessionData = $this->session->userdata('profile_image'); ?>
                            <img src="<?php echo base_url('/assets/customer_image/');
                                        echo $sessionData; ?>" alt=""></a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?php echo base_url('customer_profile'); ?>"> <img class="pe-3" src="<?php echo base_url(); ?>assets/images/user-9.png" alt="">My Profile</a></li>
                            <li><a class="dropdown-item" href="<?php echo base_url('customer_logout'); ?>"> <img class="pe-3" src="<?php echo base_url(); ?>assets/images/logout-3.png" alt="">Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>


    <?php
                } else {
    ?>

        <!-- <li>
                 <a href="<?php //echo base_url(); 
                            ?>dashboard"> 
                   <img src="<?php //echo base_url(); 
                                ?>assets/images/dashboard (2).png" alt="">
                   <span>Dashboard</span>   
                 </a>
                </li>
              -->
        <li>
            <a href="<?php echo base_url(); ?>request_form">
                <img src="<?php echo base_url(); ?>assets/images/canvas.png" alt="">

                <?php $addclassspan  =  $this->uri->segment(1);

                    if ($addclassspan == 'request_form') {
                        echo "<span class='d-none'> </span>";
                    } else {

                        echo "<span>Request Painting</span>";
                    }
                ?>
                <!-- <span>Request Painting</span> -->
            </a>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>pastsubmittedrequests">
                <img src="<?php echo base_url(); ?>assets/images/upload.png" alt="">
                <?php $addclassspanSubmitted  =  $this->uri->segment(1);

                    if ($addclassspanSubmitted == 'request_form') {
                        echo "<span class='d-none'> </span>";
                    } else {

                        echo "<span>Submitted Painting</span>";
                    }
                ?>
                <!-- <span>Submitted Painting</span> -->
            </a>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>artists_list">
                <img src="<?php echo base_url(); ?>assets/images/artist.png" alt="">
                <?php $addclassspanArtists  =  $this->uri->segment(1);

                    if ($addclassspanArtists == 'request_form') {
                        echo "<span class='d-none'> </span>";
                    } else {

                        echo "<span>Artists</span>";
                    }
                ?>
                <!-- <span> Artists</span> -->
            </a>
        </li>

        <li>
            <a href="<?php echo base_url(); ?>transaction">
                <img src="<?php echo base_url(); ?>assets/images/income (1).png" alt="">
                <?php $addclassspanArtists  =  $this->uri->segment(1);

                    if ($addclassspanArtists == 'request_form') {
                        echo "<span class='d-none'> </span>";
                    } else {

                        echo "<span>Payment</span>";
                    }
                ?>
                <!-- <span> Artists</span> -->
            </a>
        </li>
        <!-- <li>
                <a href="<?php //echo base_url(); 
                            ?>my_purchases">
                 <img src="<?php //echo base_url(); 
                            ?>assets/images/shopping-bag.png" alt="">
             <span>  My Purchases</span>
             </a>
             </li> -->
        </ul>
        </navbar>
    </div>
    <?php $addclasscontent =  $this->uri->segment(1);

                    if ($addclasscontent == 'request_form') {
                        echo "<div class='right-content form-right-content'>";
                    } else {

                        echo "<div class= 'right-content'>";
                    }
    ?>
    <!-- <div class="right-content"> -->
    <!--top header-->
    <div class="row mb-5 ">
        <div class="col-sm-12">
            <div class=" top-header d-flex justify-content-end mb-4">
                <div class=" artist-text ">

                    <h1><?php echo $title; ?></h1>
                </div>
                <?php if ($title == 'Artists') { ?>
                    <div class=" search-section me-5  ">

                        <form id="form" action="<?php echo base_url(); ?>artists_list" method="get">

                            <input type="text" name="search" class="form-control" placeholder="Search Artist">

                            <button type="submit"><i class="bi bi-search"></i></button>
                        </form>

                    </div>
                <?php
                    }
                ?>

                <div class="profile-img  ">

                    <a href="#" type="button" class=" dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php $sessionData = $this->session->userdata('profile_image'); ?>
                        <img src="<?php echo base_url('/assets/customer_image/');
                                    echo $sessionData; ?>" alt=""></a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?php echo base_url('customer_profile'); ?>"> <img class="pe-3" src="<?php echo base_url(); ?>assets/images/user-9.png" alt="">My Profile</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url('customer_logout'); ?>"> <img class="pe-3" src="<?php echo base_url(); ?>assets/images/logout-3.png" alt="">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!--top header-->
<?php
                }
?>
<!-- id ="search" onkeyup='saveValue(this);'
<script type="text/javascript">
        document.getElementById("search").value = getSavedValue("search");   
  
        function saveValue(e){
            var id = e.id;   
            var val = e.value; 
            localStorage.setItem(id, val);
            
        }

    
        function getSavedValue  (v){
            if (!localStorage.getItem(v)) {
                return "";
            }
            return localStorage.getItem(v);
        }
</script>  -->