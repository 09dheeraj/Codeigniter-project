<?php $CI  = &get_instance(); ?>


<?php if ($this->session->flashdata('success')) { ?>
    <!-- <p style="color:green"><?php // echo $this->session->flashdata('success');
                                ?></p>	 -->
    <p class=" time text-success alert-dismissable"><?php echo $this->session->flashdata('success'); ?></p>
<?php } ?>

<!--error message -->
<?php if ($this->session->flashdata('error')) { ?>
    <p class="time text-danger alert-dismissable"><?php echo $this->session->flashdata('error'); ?></p>
<?php } ?>





<div class="artist-info  mt-0">
    <div class="w-100 position-relative" style="height: 222px">
        <img class="w-100 nature-img" style='height: 100%; width: 100%; object-fit: cover; overflow: hidden;' src="<?php echo base_url('/assets/artist_image/');
                                                                                                                    if(!empty($artistInfo[0]->profile_cover)){echo $artistInfo[0]->profile_cover ;} ?>" alt="">
        <div class="cover-btn"><button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editcoverprofileModal">Update Cover</button></div>
    </div>
    <div class="Artist-Detail position-relative">
        <div class="detail-text d-flex ">

            <img src="<?php echo base_url('/assets/artist_image/');
                     if(!empty($artistInfo[0]->profile_image)){  echo $artistInfo[0]->profile_image; }  ?>" alt="">
            <div class="detail-box">
                <h1 class="edit-heading pb-2"><b><?php if (isset($artistInfo[0]->artist_fname)) {
                                                        echo $artistInfo[0]->artist_fname;
                                                    } ?> <?php if (isset($artistInfo[0]->artist_lname)) {
                                                                echo $artistInfo[0]->artist_lname;
                                                            } ?></b></h1>
                <h5><?php if (isset($artistInfo[0]->category)) {
                        // echo $artistInfo[0]->category;
                        $cat_array = explode(",", $artistInfo[0]->category);
                        $i = 1;
                        foreach ($cat_array as $cate_ID) {

                            $category_name = $CI->getcategoryname($cate_ID);
                            if (isset($category_name[0]->title)) {
                                echo " " . $category_name[0]->title;
                                if (count($cat_array) != 1  && count($cat_array) != $i) {
                                    echo ',';
                                }
                                $i++;
                            }
                        }
                    } ?></h5>
            </div>


        </div>
        <div class="profile-edit-btn">
            <button class="edit-profile-img" data-bs-toggle="modal" data-bs-target="#editprofileModal">
                <i class="bi bi-pencil-fill"></i>
            </button>
            <button class="edit-profile-img " data-bs-toggle="modal" data-bs-target="#deleteModal">
                <i class="bi bi-trash3-fill"></i>
            </button>
        </div>
    </div>
</div>
<!-- my-profile edit-->
<form action="<?php echo base_url(); ?>update_artistpersonalinfo" method="POST">
    <div class="profile-card  border-0 edit-myprofile">
        <h1 class=" edit-heading"><b>Personal Info</b></h1>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label>First Name</label>
                    <input type="text" class="form-control" name="fname" value="<?php if (isset($artistInfo[0]->artist_fname)) {
                                                                                    echo $artistInfo[0]->artist_fname;
                                                                                } ?> " placeholder="First Name">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" class="form-control" name="lname" value="<?php if (isset($artistInfo[0]->artist_lname)) {
                                                                                    echo $artistInfo[0]->artist_lname;
                                                                                } ?> " placeholder="Last Name">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email" value="<?php echo $this->session->userdata('email'); ?> " placeholder="Email" readonly>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Country</label>
                    <input type="text" class="form-control" name="country" value="<?php if (isset($artistInfo[0]->country)) {
                                                                                        echo $artistInfo[0]->country;
                                                                                    } ?> " placeholder="Country">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label>State</label>
                    <input type="text" class="form-control" name="state" value="<?php if (isset($artistInfo[0]->state)) {
                                                                                    echo $artistInfo[0]->state;
                                                                                } ?> " placeholder="State">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Artist Type</label>

                    <div id="sel-cont">


                        <?php
                        if(!empty($artistInfo)){

                        $categoryArray = explode(',', $artistInfo[0]->category);


                        ?>
                        <select name="arttype[]" id="select1" class="selectbox" style="width: 350px;" multiple>



                            <?php
                            foreach ($artist_category as $category) {
                                $isSelected = in_array($category->ID, $categoryArray) ? 'selected' : '';
                            ?>

                                <option value="<?php echo $category->ID; ?>" <?php echo $isSelected; ?>><?php echo $category->title; ?></option>



                            <?php }} ?>

                        </select>

                        <br />
                    </div>
                </div>
            </div>
        </div>






        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label>Biography</label>
                    <textarea class="form-control" rows="6" cols="50" name="biography"><?php if (isset($artistInfo[0]->about_artist)) {
                                                                                            echo $artistInfo[0]->about_artist;
                                                                                        } ?></textarea>
                </div>
            </div>

        </div>
        <div class="update-btn text-center">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </div>
</form>

<div class="profile-card  border-0 mt-5 mb-5 edit-myprofile ">

    <?php

    $artist_id = $this->session->userdata('id');
    $getpaintingDATA = $CI->getpaintingDATA($artist_id);

    //   echo "<pre>"; print_r($getpaintingDATA);
    ?>

    <div class="d-flex justify-content-between">
        <h1 class=" edit-heading"><b>Painting</b></h1> <a class="btn btn-primary" id="add_row">Add More</a>
    </div>
    <form action="<?php echo base_url('paintingData'); ?>" method="post">
        <div id="show_row">

            <div class="col-md-12 mt-4 text-end ">


            </div>

            <?php foreach ($getpaintingDATA as $data) { ?>
                <div class="painting_row">

                    <div class="row align-items-center">
                        <div class="col-sm-12  col-md-6 col-lg-3">
                            <div class="form-group">
                                <label>Height <small class="text-dark">(Inches)</small></label>
                                <input type="hidden" class="form-control" id="painting_id" name="painting_id[]" value="<?php echo $data->id; ?>" required>
                                <input type="number" class="form-control" id="painting_height" name="painting_height[]" value="<?php echo $data->painting_height; ?>" required>
                            </div>
                        </div>
                        <div class="col-sm-12  col-md-6 col-lg-3">
                            <div class="form-group">
                                <label>Width <small class="text-dark">(Inches)</small></label>
                                <input type="number" class="form-control" id="painting_width" name="painting_width[]" value="<?php echo $data->painting_width; ?>" required>

                            </div>
                        </div>
                        <div class="col-sm-12  col-md-6 col-lg-2">
                            <div class="form-group">
                                <label> Price <small class="text-dark">($)</small> </label>
                                <input type="number" class="form-control" name="painting_price[]" id="painting_price" value="<?php echo $data->painting_price; ?>" required>

                            </div>
                        </div>
                        <div class="col-sm-12  col-md-6 col-lg-2">
                            <div class="form-group">
                                <label>Version </label>
                                <input type="number" class="form-control" name="painting_version[]" id="painting_version" value="<?php echo $data->painting_version; ?>" required>

                            </div>
                        </div>
                        <div class="update-btn text-center col-sm-12  col-md-6 col-lg-2 mt-5">
                            <button type="submit" class="edit-profile-img remove_row_painting" data-painting-id="<?php echo $data->id; ?>"> <i class="bi bi-trash3-fill"></i></button>
                        </div>

                    </div>
                </div>
                <div class="modal fade" id="paintingdeleteModal" tabindex="-1" aria-labelledby="paintingdeleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body">
                                <h2>Are you sure, you want to delete<span id=""></span>?</h2>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
                                <a class="btn btn-primary">Yes</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <div class="update-btn text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>



<form id="validate" action="<?php echo base_url(); ?>ArtistResetPass" method="POST">
    <div class="profile-card  border-0 mt-5 mb-5 edit-myprofile">
        <h1 class=" edit-heading"><b>Reset Password</b></h1>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label>New Password</label>
                    <input type="password" class="form-control" id="pass" name="pass" required>

                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" class="form-control" name="cpass" id="" required>

                </div>
            </div>
        </div>
        <div class="update-btn text-center">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </div>


</form>





</div>
</div>
</div>
</div>
<!--delete-btn modal-->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <h2>Are you sure,you want to delete?</h2>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
                <a href="<?php echo base_url('deleteprofile_image'); ?>" type="button" class="btn btn-primary">Yes</a>
            </div>
        </div>
    </div>
</div>

<!--editprofile-btn modal-->
<form action="<?php echo base_url(); ?>updateartistprofile_image" method="POST" enctype="multipart/form-data">

    <div class="modal fade" id="editprofileModal" tabindex="-1" aria-labelledby="editprofileModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center p-5">
                    <h2>Upload Profile Photo</h2>
                    <label class="add-morefile text-center">Upload
                        <input type="file" id="profile_img" name="image">
                        <div id="profile_name" style="text-align: center;"></div>
                    </label>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-primary">Yes</button>

                </div>
            </div>
        </div>
    </div>
</form>
<!--editcover_profile-btn modal-->
<form action="<?php echo base_url(); ?>updatecoverprofile_image" method="POST" enctype="multipart/form-data">

    <div class="modal fade" id="editcoverprofileModal" tabindex="-1" aria-labelledby="editprofileModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center p-5">
                    <h2>Upload Profile Photo</h2>
                    <label class="add-morefile text-center">Upload
                        <input type="file" name="image" id="imageupload">
                        <div id="fname" style="text-align: center;"></div>
                    </label>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-primary">Yes</button>

                </div>
            </div>
        </div>
    </div>
</form>








<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.6.2/chosen.jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {

        $("#validate").validate({
            rules: {
                pass: 'required',
                cpass: {
                    required: true,
                    equalTo: "#pass",
                },
            },
            messages: {
                pass: 'New Password is required',
                cpass: {
                    required: 'Confirm Password is required',
                    equalTo: 'Passwords does not match',
                }
            },
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#imageupload').on('change', function() {
            var fileName = $(this).val().split('\\').pop();
            $('#fname').text(fileName || 'No file selected');
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#profile_img').on('change', function() {
            var fileName = $(this).val().split('\\').pop();
            $('#profile_name').text(fileName || 'No file selected');
        });
    });
</script>

<script>
    var timeout = 3000;

    $('.time').delay(timeout).fadeOut(300);
</script>

<script>
    $('select[name="arttype[]"]').chosen();
</script>


<script>
    $(document).ready(function() {

        $('#add_row').click(function(e) {
            e.preventDefault();

            $('#show_row').append(` <div class="col-md-12 mt-4 text-start painting_row">
            
            <div class="row align-items-center">
        <div class="col-sm-12  col-md-6 col-lg-3">
            <div class="form-group">
                <label>Height <small class="text-dark">(Inches)</small></label>
                <input type="number" class="form-control" id="painting_height" name="painting_height[]" required>

            </div>
        </div>
        <div class="col-sm-12  col-md-6 col-lg-3">
            <div class="form-group">
                <label>Width <small class="text-dark">(Inches)</small></label>
                <input type="number" class="form-control" id="painting_width" name="painting_width[]" required>

            </div>
        </div>
        <div class="col-sm-12  col-md-6 col-lg-2">
            <div class="form-group">
                <label>Price <small class="text-dark">($)</small></label>
                <input type="number" class="form-control" name="painting_price[]" id="painting_price" required>

            </div>
        </div>
        <div class="col-sm-12  col-md-6 col-lg-2">
            <div class="form-group">
                <label>Version </label>
                <input type="number" class="form-control" name="painting_version[]" id="painting_version" required>

            </div>
        </div>

        <div class="update-btn text-center col-sm-12  col-md-6 col-lg-2 mt-5">
        <button class="edit-profile-img remove_row_painting" type="submit" >
                <i class="bi bi-trash3-fill"></i>
            </button>
           
        </div>
    </div>
            
            `);



        });

        $('#show_row').on("click", ".remove_row_painting", function(e) {

            e.preventDefault();
            // $(this).closest(".painting_row").remove();
            var rowToRemove = $(this).closest(".painting_row");
            var paintingId = $(this).data('painting-id');


            $('#paintingdeleteModal').modal('show');

            $('#paintingdeleteModal').on('click', '.btn-primary', function() {


                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('deletePainting') ?>",
                    data: {
                        painting_id: paintingId
                    },
                    success: function(response) {

                        // alert(response);
                        //    if (response === 'success') {
                        rowToRemove.remove();
                        $('#paintingdeleteModal').modal('hide');
                        //     } else {
                        //         alert('error');
                        //     }
                    }
                });
            });

        });

    });
</script>