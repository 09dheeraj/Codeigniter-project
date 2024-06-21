<?php $CI     = &get_instance(); ?>


<div class=" Purchase-card p-5">
    <table class="table table-striped table-bordered customerlist note-table text-center" id="payment-table">
        <thead>
            <tr>

                <th>Date</th>
                <th> Name</th>
                <th>Amount Paid</th>
                <th>Painting Title</th>
                <th>Painting Size</th>
                <th>Country</th>
                <th>State</th>
                <th>City</th>
                <th>Address</th>
                <!-- <th>Currency</th> -->
                <th>Status</th>
                <th>Receipt URL</th>

            </tr>
        </thead>
        <tbody>
            <?php foreach ($payment as $data) { 

                $Timestamp = $data->date;
                $dateTime = date("d M, Y", strtotime($Timestamp));
                $url = $data->receipt_url;
               $maxwords = 10;
                $limitedtag = htmlentities(substr($data->receipt_url, 0, 20));
                $getuserdata = $CI->getuserdata($data->cus_id);
                $paintingTITLE = $CI->get_painting_TITLE($data->temp_id);
                $framesize = $CI->get_frame_SIZE($data->painting_id);

                ?>



                <tr>
                    <td><?php echo $dateTime; ?></td>
                    <td><?php if(!empty($getuserdata)){ echo $getuserdata[0]->first_name . $getuserdata[0]->last_name ; } ?></td>
                    <td><?php echo $data->paid_amount; ?></td>
                    <td><a class="text-dark" target="_blank" href="<?php echo base_url('myrequest_detail');?>/<?php echo $data->temp_id;?>"><?php if(!empty($paintingTITLE)){ echo htmlentities(substr($paintingTITLE[0]->painting_title, 0, 15)); } ?></a></td>
                    <td style="width: 110px;"><?php if(!empty($framesize)){ echo "(".$framesize[0]->painting_height.'"'.' x '. $framesize[0]->painting_width . '"'. ')';  } ?></td>
                    <td><?php echo ucfirst($data->billing_country); ?></td>
                    <td><?php echo ucfirst($data->billing_state); ?></td>
                    <td><?php echo ucfirst($data->billing_city); ?></td>
                    <td><?php echo ucfirst($data->billing_address); ?></td>
                    <!-- <td><?php// echo ucfirst($data->currency); ?></td> -->
                    <td><?php echo ucfirst($data->payment_status);?></td>
                    <td><a  target="_blank" class="text-dark" href="<?php echo $url; ?>"><?php echo $limitedtag; ?></a></td>
                </tr>
            <?php } ?>

        </tbody>
    </table>


</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>


<script>
    $(document).ready(function() {
        $('#payment-table').DataTable({
          

        });
    });
</script>