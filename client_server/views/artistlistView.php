<?php $ci =& get_instance(); ?>
<span class=" alert-success" id="span_to_post_response"></span>
<div class=" Purchase-card p-5"> 
          <table class="table table-striped table-bordered customerlist text-center" id="artist-table">
            <thead>
              <tr>
               
                <th> Name</th>
                <th> Email</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>

            <?php
            
            foreach($Artist_data as $artist){
             ?>
              <tr>
                
                <td><?php echo ucfirst($artist->user_name);?></td>
                <td><?php echo $artist->user_email;?></td>


                <?php   if (($artist->user_status) == 1) { ?>
                 <td><span class="d-flex text-success justify-content-center"><i class="bi bi-check2-square me-1"></i><?php echo "Active"; ?> </span></td>
                <?php } else { ?>
                <td><span class="d-flex text-warning justify-content-center"><i class="bi bi-exclamation-square me-1"></i><?php echo "Inactive"; ?> </span></td>
                <?php } ?>
    

                <td>
                  <div class="d-flex align-items-center justify-content-center">
                          <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox"  value="<?php echo $artist->id; ?>" role="switch" id="flexSwitchCheckChecked-<?php echo $artist->id; ?>" <?php if($artist->user_status == 1) {echo "checked";} else{};?>>
                                <label class="form-check-label" for="flexSwitchCheckChecked-<?php echo $artist->id; ?>">&nbsp;</label>
                          </div>
                          <button class="btn btn-icon text-danger delete-btn delete-data"  data-id="<?php echo $artist->id; ?>" data-status="<?php echo $artist->user_status; ?>"><i class="bi bi-trash"></i></button>

                          
                     
                      </div>
                </td>


              </tr>


  <?php } ?>
            </tbody>
          </table>
    </div>

    





<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>


<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script> 


<script>
$(document).ready(function() {


	$('#artist-table').DataTable(
		{
          //  "order": []
            
        }
	);

   
    $('input[type="checkbox"]').click(function() {

        var artID = $(this).val();
        var status = $(this).prop("checked") ? '1' : '0';
        var contrurl ="<?php echo base_url('Admin/setStatus'); ?>";
     

        $.ajax({
            type: "POST",
            url: contrurl,
            data: { "artID": artID, "status": status },
            success: function(data) {
                location.reload();
            }
        });
    });
});


$(".delete-data").click(function() {

  var art_id = $(this).data('id');
  var status = $(this).data('status');

  var url = '<?php echo base_url('Admin/delete_artist') ?>?art_id=' + art_id + '&status=' + status;

  
  $.ajax({
          url: url,
          type: 'POST',
          success: function (response) {
            jQuery('#span_to_post_response').text(response);
             location.reload();
          },
          error: function () {
              alert('Error deleting item.');
          }
      });


});



</script>