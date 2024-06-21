
<?php if($this->session->flashdata('success')){?>
<p class="alert text-success alert-dismissable"><?php  echo $this->session->flashdata('success');?></p>
<?php } ?>

<!--error message -->
<?php if($this->session->flashdata('error')){?>
<p class="alert text-danger alert-dismissable"><?php  echo $this->session->flashdata('error');?></p>
<?php } ?>


<div class="artist-info ">
    <div class="w-100">
        <img class="w-100 nature-img" src="<?php echo base_url();?>assets/images/5186109.jpg" alt="">
    </div>

    <div class="Artist-Detail ">
        <div class="detail-text d-flex">
            <?php $sessionData = $this->session->userdata('profile_image'); ?>


            <img src="<?php echo base_url('/assets/customer_image/');echo $sessionData;?>" alt="">

            <div class="detail-box">
                <h1 class="edit-heading pb-2">
                    <b><?php if(isset($custInfo[0]->first_name)){echo $custInfo[0]->first_name;}?>
                        <?php if(isset($custInfo[0]->last_name)){echo $custInfo[0]->last_name;}?></b></h1>
                       
                <h5><?php if(isset($custInfo[0]->city)){echo $custInfo[0]->city;}?> <?php if(!empty($custInfo[0]->city) ){ echo ",";}?>
                    <?php if(isset($custInfo[0]->country)){echo $custInfo[0]->country;}?></h5>
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
<form action="<?php echo base_url();?>update_personalinfo" method="POST">
    <!-- echo "<pre>"; -->
    <?php //print_r($custInfo);?>
    <div class="profile-card  border-0 edit-myprofile">
        <h1 class=" edit-heading"><b>Personal Info</b></h1>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">

                    <label>First Name</label>
                    <input type="text" name="fname" class="form-control" 
                        value="<?php if(isset($custInfo[0]->first_name)){echo $custInfo[0]->first_name;}   ?> " >
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" name="lname" class="form-control"
                        value="<?php if(isset($custInfo[0]->last_name)){echo $custInfo[0]->last_name;}?>"  >
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Mobile</label>
                    <input type="number" name="mobile" class="form-control"
                        value="<?php if(!empty($custInfo[0]->mobile)){echo $custInfo[0]->mobile;}?>"  >
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="<?php echo $this->session->userdata('email');?>"
                        class="form-control" readonly>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Address 1</label>
                    <textarea name="address1" class="form-control"
                        value=""  ><?php if(isset($custInfo[0]->address1)){echo $custInfo[0]->address1;}?></textarea>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Address 2</label>
                    <textarea name="address2" class="form-control"
                        value=""   ><?php if(isset($custInfo[0]->address2)){echo $custInfo[0]->address2;}?></textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label>City</label>
                    <input type="text" name="city" class="form-control"
                        value="<?php if(isset($custInfo[0]->city)){echo $custInfo[0]->city; }?>"  >
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>State</label>
                    <input type="text" name="state" class="form-control"
                        value="<?php if(isset($custInfo[0]->state)){echo $custInfo[0]->state;}?>"  >
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Country</label>
                    <input type="text" name="country" class="form-control"
                        value="<?php if(isset($custInfo[0]->country)){echo $custInfo[0]->country;}?>"  >
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Zip</label>
                    <input type="number" name="zip" class="form-control"
                        value="<?php if(!empty($custInfo[0]->zip)){echo $custInfo[0]->zip;}?>"  >
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label>About Me</label>
                    <textarea name="aboutme" class="form-control"
                        value="" ><?php if(isset($custInfo[0]->about_me)){echo $custInfo[0]->about_me;}?></textarea>
                </div>
            </div>

        </div>
        <div class="update-btn text-center">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </div>
</form>
<form id="validate" action="<?php echo base_url();?>CustomerResetPass" method="POST">
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

    </div>
</form>
</div>
</div>

<!--delete-btn modal-->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <h2>Are you sure you want to delete your profile picture?</h2>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
                <a href="<?php echo base_url('deletecustprofile_image');?>" type="button" class="btn btn-primary">Yes</a>
            </div>
        </div>
    </div>
</div>

<!--editprofile-btn modal-->
<form action="<?php echo base_url();?>updateprofile_image" method="POST" enctype="multipart/form-data">

    <div class="modal fade" id="editprofileModal" tabindex="-1" aria-labelledby="editprofileModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center p-5">
                    <h2>Upload Profile Photo</h2>
                    <label class="add-morefile text-center">Upload
                        <input type="file" id="fileUpload" name="image">
                        <div id="imgname" style="text-align: center;"></div>
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
        var timeout = 3000; 

        $('.alert').delay(timeout).fadeOut(300);
        </script>

<script>
$(document).ready(function() {
  $('#fileUpload').on('change', function() {
    var fileName = $(this).val().split('\\').pop();
    $('#imgname').text(fileName || 'No file selected');
  });
});
</script>