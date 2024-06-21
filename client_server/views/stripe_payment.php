<div class="">
    <div class="profile-card mb-4 payment-painting">
        <div class="row align-items-center">
            <div class="col-sm-12 col-md-6 col-lg-2">
                <img src="<?php echo base_url(); ?>assets/canvas_image/<?php echo $temp_painting_DATA[0]->canvas_image; ?>" alt="" width="220" height="170">
            </div>
            <div class=" col-sm-12 col-md-6 col-lg-6">
                <h1 class="section-heading pb-2"><?php if (!empty($temp_painting_DATA[0]->painting_title)) {
                                                        echo $temp_painting_DATA[0]->painting_title;
                                                    } ?></h1>
                <p class="painting-para">Painting-size : <b> <?php if (!empty($painting_price[0]->painting_height && $painting_price[0]->painting_width)) {
                                                                    echo $painting_price[0]->painting_height . ' x ' . $painting_price[0]->painting_width . ' ';
                                                                } ?>inch</b></p>
                <p class="painting-para">Painting-Price :<b> <?php if (!empty($painting_price[0]->painting_price)) {
                                                                    echo '$' . $painting_price[0]->painting_price;
                                                                } ?> </b></p>
                <p class="painting-para">Platform-charges :<b> 20%</b></p>

                <?php
                $x = 120;
                $y = 100;
                if (!empty($painting_price[0]->painting_price)) {
                    $price =  $painting_price[0]->painting_price * $x;
                    //echo $price;
                    $charges =  $price / $y;
                }

                ?>
                <span class="request-accept">Total : <?php echo '$' . $charges; ?> </span>
            </div>
        </div>
    </div>



    <div class="profile-card payment-card">
        <h1> Payment Details </h1>
        <div class="panel">
            <div class="panel-heading">


                <!--error message -->
                <?php if ($this->session->flashdata('error')) { ?>
                    <p class="alert text-danger alert-dismissable">
                        <?php echo $this->session->flashdata('error'); ?>
                    </p>
                <?php } ?>
            </div>
            <div class="panel-body">
                <!-- Display errors returned by createToken -->


                <!-- Payment form -->
                <form action="<?php echo base_url('payment'); ?>" method="POST" id="payment-form">
                    <?php foreach ($painting_price as $data) { 
                  
                         ?>

                        <?php
                        $x = 120;
                        $y = 100;
                        if (!empty($data->painting_price)) {
                            $price = $data->painting_price * $x;
                            //echo $price;
                            $charges =  $price / $y;
                        }

                        ?>

                        <input type="hidden" name="painting_price" class="form-control" value="<?php echo $charges; ?>" required>
                        <input type="hidden" name="painting_version" class="form-control" value="<?php echo $data->painting_version; ?>" required>
                        <input type="hidden" name="id" class="form-control" value="<?php echo $data->id; ?>" required>
                        <input type="hidden" name="painting_id" class="form-control" value="<?php echo $this->uri->segment(3); ?>" required>
                        <input type="hidden" name="select_id" class="form-control" value="<?php echo $this->uri->segment(4); ?>" required>
                        <input type="hidden" name="painting_H_W_id" class="form-control" value="<?php echo $this->uri->segment(2); ?>" required>
                        <input type="hidden" name="canvas_img" value="<?php echo $temp_painting_DATA[0]->canvas_image; ?>">



                        <div class="profile-card">
                            <h4>Contact Info</h4>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" name="email" class="form-control" id="email" placeholder="Enter email" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="profile-card">
                            <h4>Shipping</h4>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" name="name" class="form-control" id="name" placeholder="Enter name" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Country</label>
                                        <input type="text" name="country" class="form-control" id="country" placeholder="Enter country" required>
                                    </div>

                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>State</label>
                                        <input type="text" name="state" class="form-control" id="state" placeholder="Enter state" required>
                                    </div>

                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>City</label>
                                        <input type="text" name="city" class="form-control" id="city" placeholder="Enter city" required>
                                    </div>

                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text" name="address" class="form-control" id="address" placeholder="Enter Address" autocomplete="off" required>

                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>ZIP</label>
                                        <input type="text" name="ZIP" id="ZIP" class="form-control" placeholder="Enter ZIP" required="">
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="profile-card">
                            <h4>Payment</h4>
                            <div class="card-errors"></div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Card Number</label>
                                        <input type="text" name="card_number" class="form-control" id="card_number" placeholder="1234 1234 1234 1234" autocomplete="off" required>

                                    </div>
                                    <span id="onlycard_number" class="text-danger"></span>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>CVC </label>
                                        <input type="number" name="card_cvc" class="form-control" id="card_cvc" placeholder="CVC" autocomplete="off" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">

                                    <div class="form-group">
                                        <label>Expiry Month</label>
                                        <input type="number" name="card_exp_month" class="form-control" id="card_exp_month" placeholder="MM" required>
                                    </div>

                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Expiry Year</label>
                                        <input type="number" name="card_exp_year" class="form-control" id="card_exp_year" placeholder="YYYY" required>
                                    </div>
                                </div>

                            </div>


                            <div class="row my-2">
                                <div class="col-sm-12">
                                    <p class="d-flex align-items-center"> <input type="checkbox" class="pe-4 billing-checkbox" name="shipping_information"> Billing is same as shipping information </p>
                                </div>
                            </div>

                            <div class="profile-card mt-0" id="Billing_information">
                                <h4>Billing</h4>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" name="billing_name" class="form-control" id="name" placeholder="Enter name">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Country</label>
                                            <input type="text" name="billing_country" class="form-control" id="country" placeholder="Enter country">
                                        </div>

                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>State</label>
                                            <input type="text" name="billing_state" class="form-control" id="state" placeholder="Enter state">
                                        </div>

                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>City</label>
                                            <input type="text" name="billing_city" class="form-control" id="city" placeholder="Enter city">
                                        </div>

                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Address</label>
                                            <input type="text" name="billing_address" class="form-control" id="address" placeholder="Enter Address" autocomplete="off">

                                        </div>
                                    </div>

                                </div>
                            </div>


                            <div class="text-center mt-4"> <button type="submit" class="btn btn-primary" id="payBtn">Submit Payment</button> </div>
                        </div>

                    <?php } ?>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>

<script>
    Stripe.setPublishableKey('<?php echo $this->config->item('stripe_publishable_key'); ?>');


    $(document).ready(function() {
        // On form submit
        $("#payment-form").submit(function() {
            $('#payBtn').attr("disabled", "disabled");

            Stripe.createToken({
                number: $('#card_number').val(),
                exp_month: $('#card_exp_month').val(),
                exp_year: $('#card_exp_year').val(),
                cvc: $('#card_cvc').val()
            }, stripeResponseHandler);

            return false;
        });
    });


    function stripeResponseHandler(status, response) {
        if (response.error) {
            $('#payBtn').removeAttr("disabled");
            $(".card-errors").html('<p style="color: #eb1106;" class="alert">' + response.error.message + '</p>');
        } else {
            var form$ = $("#payment-form");
            var token = response.id;
            form$.append("<input type='hidden' name='stripeToken' value='" + token + "' />");
            form$.get(0).submit();
        }
    }
</script>


<script>
    $(document).ready(function() {

        var timeout = 3000;

        $('.alert').delay(timeout).fadeOut(300);

    });
</script>

<script>
    $(document).ready(function() {
        var checkedValue = $("input[name='shipping_information']");
        var chkId = '';
        $('input').on('click', function() {

            if (checkedValue.is(':checked')) {
                $("input[name='shipping_information]:checked").each(function() {
                    chkId = $(this).val() + ",";
                    chkId = chkId.slice(0, -1);
                });

                //alert(chkId);
                $("#Billing_information").hide();

            } else {
                $("#Billing_information").show();
            }
        });




        $("#card_number").keyup(function() {
            var card_number = $("#card_number").val();
            if (!/^\d+$/.test(card_number)) {
                $("#onlycard_number").html("The card must be a number.");
                $('#payBtn').hide();

            } else {
                $("#onlycard_number").html("");
                $('#payBtn').show();
            }
        });

    });
</script>