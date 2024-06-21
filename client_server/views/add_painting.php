<?php $CI  = &get_instance(); ?>

<div class="edit-painting">
    
    <!--error message -->
<?php if($this->session->flashdata('error')){?>
<p class=" text-danger alert-dismissable"><?php  echo $this->session->flashdata('error');?></p>
<?php } ?>
    <form id="paintingForm" action="<?php echo base_url(); ?>addPainting" method="POST"  enctype="multipart/form-data" class="needs-validation">
       <div class="painting-edit">
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Painting Name</label>
                    <input type="text" class="form-control" name="paint_name" id="paint_name" placeholder="Painting Name" style='background-image: none;' >
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Price($)</label>
                    <input type="number" class="form-control" name="price" id="price" placeholder="Price" style='background-image: none;'>
                </div>
            </div>
        </div>
          <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="validationCustom02">Painting Size</label>
                    <select class="form-select" name="size" id="validationCustom02"  required style='background-image: none;'>
                        <option selected disabled >Select Size</option>
                        <option value="4 x 8 inch" >4 x 8 inch</option>
                        <option value="5 x 7 inch" >5 x 7 inch</option>
                        <option value="8 x 10 inch" >8 x 10 inch</option>
                        <option value="4 x 8 inch" >9 x 12 inch</option>
                        <option value="5 x 7 inch" >11 x 14 inch</option>
                        <option value="8 x 10 inch" >12 x 12 inch</option>
                        <option value="4 x 8 inch" >12 x 16 inch</option>
                        <option value="5 x 7 inch" >16 x 20 inch</option>
                        <option value="8 x 10 inch" >18 x 24 inch</option>
                      </select>
                </div>
            </div>


            <div class="col-sm-6">
                <div class="form-group">
                    <label>Painting Type</label>
                 
                    <div id="sel-cont">
                      <select  name="painttype[]" id="select1" class="selectbox" style="width: 350px;" multiple>
                        
                              <?php foreach($painting_category as $category){ ?>
                        
                                <option value="<?php echo $category->ID; ?>"><?php echo $category->title;  ?></option>
                               
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
                  <textarea  rows="6" cols="50" class="form-control" name="description" id="description" style='background-image: none;'></textarea>
                
                </div>
            </div>
        </div>
       </div>
    
       
       <div class="select-images">
            <h4>Add Frame</h4>
            <label class="add-frame text-center" for="validationCustom03">
                <span><img src="<?php echo base_url(); ?>assets/images/image_2023_07_12T07_58_38_810Z.png" alt="Frame Image"></span>
                
            </label>
                <input type="file" name="frame[]" multiple id="validationCustom03" class="form-control" required>
            <div class="invalid-feedback error">
                    Frame is required.
             </div>
            <div id="fnames" style="padding-left: 2%;"></div>
        </div>

            <?php if($this->session->flashdata('frameerror')){?>
                <small class=" text-danger alert-dismissable" style="font-family: Poppins-Medium;"><?php  echo $this->session->flashdata('frameerror');?></small>
            <?php } ?> 
            <div class="draw-section mt-3">
                <h4> Painting Image</h4>
                <div class="add-image mt-3 text-center">
                    <div class="upload-box pb-4">
                        <span><img src="<?php echo base_url(); ?>assets/images/upload-btn.png" alt="Upload Image"></span>
                        <label for="validationCustom04" class="btn btn-primary">Upload image</label>

                        <input type="file" id="validationCustom04" name="image[]" multiple class="form-control" required>
                        <div class="invalid-feedback error">
                            Painting image is required. Allowed types: (JPEG, jpg or PNG).
                         </div>
                        <div id="imgname" style="text-align: center;"></div>
                    </div>
                </div>
            </div>
            
          <div class="button-sec m-5 text-center">
            <button type="submit" class="btn btn-primary upload-btn">Update</button>
          </div>
      
      
</div>
</form>

           

    </div>
</div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.6.2/chosen.jquery.min.js"></script> 


<script>

$(document).ready(function() {
  $('#validationCustom03').on('change', function() {
    var fileNames = [];
    $.each(this.files, function(index, file) {
      fileNames.push(file.name);
    });
    $('#fnames').text(fileNames.join(', ') || 'No files selected');
  });
});


$(document).ready(function() {
  $('#validationCustom04').on('change', function() {
    var fileName = [];
    $.each(this.files, function(index, file){
      fileName.push(file.name);
    });
    $('#imgname').text(fileName.join(', ') || 'No files selected');
  });


});

$(document).ready(function () {
        $("#paintingForm").validate({
            rules: {
                paint_name: {
                    required: true
                },
                price: {
                    required: true,
                    number: true
                },
                size: {
                    required: true
                },
                'painttype[]':{
                  required: true
                },
                description: {
                    required: true
                },
                
            },
            messages: {
                paint_name: {
                    required: "Name is required"
                },
                price: {
                    required: "Price is required",
                    number: "Please enter a valid number"
                },
                size: "Please select a size",
                'painttype[]': "Please select a painttype",
                description: "Description is required",
            
               
            }
        });
    });


(function () {
  'use strict';
  var forms = document.querySelectorAll('.needs-validation');
  Array.prototype.slice.call(forms).forEach(function (form) {
    form.addEventListener('submit', function (event) {
      if (!form.checkValidity()) {
        event.preventDefault();
        event.stopPropagation();
      } else {
        var fileInput = form.querySelector('input[type="file"]');
        var allowedTypes = ['image/jpeg', 'image/png','image/jpg'];
       // jpg|png|jpeg
        if (fileInput.files.length > 0) {
          var invalidFiles = Array.from(fileInput.files).filter(function (file) {
            return allowedTypes.indexOf(file.type) === -1;
          });

          if (invalidFiles.length > 0) {
            event.preventDefault();
            event.stopPropagation();

            var errorMessage = 'Invalid file type. Allowed types: ' + allowedTypes.join(', ');
            var invalidFeedback = form.querySelector('.invalid-feedback');
            invalidFeedback.textContent = errorMessage;
            invalidFeedback.style.display = 'block';
          }
        }
      }

      form.classList.add('was-validated');
    });
  });
})();




    $('select[name="painttype[]"]').chosen();


</script>


