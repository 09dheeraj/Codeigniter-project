<div class="request-painting-form">
    <div class="row">
        <div class="col-12">
            <section>
                <form>

                    <div class="card-body request-details">
                        <div class="tab d-none">
                            <div class="draw-section mt-0">
                                <h2><b>Step 1.</b></h2>
                                <div class="form-group mt-4">
                                    <label>Title</label>
                                </div>

                                <div class="form-group mt-4">


                                    <div class="row align-items-center">
                                        <div class="col-12 col-lg-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control" value="<?php if (isset($request_data[0]->painting_title)) {
                                                                                                    echo $request_data[0]->painting_title;
                                                                                                } ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>




                            </div>
                            <div class="draw-section">


                                <div class="form-group mt-4">
                                    <label>Tags</label>
                                </div>

                                <div class="form-group mt-4">


                                    <div class="row align-items-center">
                                        <div class="col-12 col-lg-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control" value="<?php if (isset($request_data[0]->tag)) {
                                                                                                    echo $request_data[0]->tag;
                                                                                                } ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>





                            </div>

                            <div class="draw-section">
                                <h2 class="request-step2"><b>Step 2.</b></h2>


                                <div class="form-group mt-4">
                                    <label>Process how painting should be created </label>
                                </div>


                                <div class="form-group mt-4">


                                    <div class="row align-items-center">
                                        <div class="col-12 col-lg-12">
                                            <div class="form-group ">



                                                <?php
                                                if (!empty($request_data[0]->script)) {
                                                    $script = explode(",", $request_data[0]->script);
                                                    foreach ($script as $val) {
                                                        $val = str_replace('HR24', '', $val);
                                                        if (strpos($val, 'HR24') !== false) {
                                                        }
                                                        $value = str_replace('[', "", "$val");
                                                        $value1 = str_replace('"', "", "$value");
                                                        $value2 = str_replace(']', "", "$value1");

                                                        $input_text = $value2;
                                                        $color_pattern = "/#([0-9a-fA-F]{6})/";
                                                        preg_match_all($color_pattern, $input_text, $matches);
                                                        $data['color_codes'] = $matches[0];
                                                        $cleaned_text = preg_replace($color_pattern, '', $input_text);

                                                ?>

                                                        <div class="d-flex reuestform-script">
                                                            <p class="paint-process">
                                                                <?php if (isset($cleaned_text)) {
                                                                ?>
                                                                    <?php
                                                                    $result = substr($cleaned_text, 0, 6);
                                                                    // print_r($result);
                                                                    if ($result == 'PB2023') {


                                                                        $desc = "description";
                                                                    } else {
                                                                        $desc = "";
                                                                    }

                                                                    $cleaned_data = str_replace('~', ',', $cleaned_text);
                                                                    $cleaned_result = str_replace('PB2023', '', $cleaned_data);
                                                                    ?>
                                                            </p>
                                                            <span class="<?php echo $desc; ?>">
                                                                <?php echo ucfirst($cleaned_result); ?>
                                                                <?php echo "&nbsp"; ?>
                                                            </span>
                                                            <div class="color-box" style="width: 30px; height: 30px; background-color: <?php if (isset($data['color_codes'][0])) {
                                                                                                                                            echo $data['color_codes'][0];
                                                                                                                                        } ?>; ">
                                                            </div>

                                                            <?php echo "&nbsp"; ?>
                                                            <span class="">
                                                                <?php if (isset($data['color_codes'][0])) {
                                                                        echo $data['color_codes'][0];
                                                                    } ?>
                                                                <?php echo "&nbsp"; ?>
                                                            </span>

                                                            <div class="color-box" style="width: 30px; height: 30px; background-color: <?php if (isset($data['color_codes'][1])) {
                                                                                                                                            echo $data['color_codes'][1];
                                                                                                                                        } ?>; ">
                                                            </div>
                                                            <?php echo "&nbsp"; ?>
                                                            <span class="">
                                                                <?php if (isset($data['color_codes'][1])) {
                                                                        echo $data['color_codes'][1];
                                                                    } ?>
                                                            </span>
                                                        <?php }
                                                        ?>
                                                        </div>
                                                        <br>


                                                <?php }
                                                } ?>
                                                <?php 
                                                $temp_id = $this->uri->segment(2);
                                                $CI = &get_instance();
                                                $modifiedString256 = $CI->canvas_image_data($temp_id);
                                                if(!empty($modifiedString256))
                                                {?>
                                                <div class="form-group mt-4 mb-4">
                                                    <label>Inserted Media </label>
                                                </div>


                                            <?php  }?>
                                              
                                             
                                                    <div class="media-slider d-flex  overflow-auto">

                                                        <?php
                                                        $cus_id = $this->session->userdata('id');
                                                        //   $images_array = [];
                                                        if (!empty($request_data[0]->script)) {
                                                            $script = explode(",", $request_data[0]->script);

                                                            $HR24Words = array();
                                                            foreach ($script as $val) {
                                                                if (strpos($val, 'HR24') !== false) {
                                                                    $HR24Words[] = $val;
                                                                }
                                                            }
                                                        }
                                                      
                                                        // print_r($modifiedString256);
                                                  
                                                        $i=1;
                                                        foreach ($modifiedString256 as $value) {
                                                          
                                                            $image_name = substr($value->image_name, 14);
                                                           

                                                        ?>
                                                            <div class=" media-images ">
                                                                <div>
                                                                    <img src="data:image/png;base64, <?php echo $value->images; ?>" width="150" height="150" /><br>
                                                                    <span>
                                                                    <?php echo $image_name; ?>
                                                                        <?php //echo $value->image_name; ?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                              




                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </form>

            </section>
        </div>
    </div>


<div class="request-detail p-4">
    <h1 class="edit-heading"><b>Canvas Image</b></h1>
    <img class="w-100" src="<?php echo base_url(); ?>/assets/canvas_image/<?php echo $request_data[0]->canvas_image; ?>" alt="">
</div>

<div class="text-center m-5"><a href="<?php echo base_url() ?>assign_artist/<?php echo $this->uri->segment(2); ?>" class="btn btn-primary ms-auto">Assign to artist</a> </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://kenwheeler.github.io/slick/slick/slick.js"></script>
<script src="<?php echo base_url(); ?>assets/css/form-step.js"></script>
