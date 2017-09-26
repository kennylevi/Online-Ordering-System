<?php 
    $page = 'checkout_page';
    require('section_templates/header.php');
?>
<style type="text/css">
    body{background-color:#dddddd; font-family: 'Lora',Arial,sans-serif}
    header{background-color: #fff;border-radius:0px !important;box-shadow: 0 2px 4px rgba(0,0,0,.16);}
    .customer-details{font-size:12px; color: #666} .nav .tel{padding-left:40px; font-size:11px;} .text{font-size:11px;}
    a.navbar-brand img{max-height: 45px;}
    .checkout-con{margin-top:15px;}.checkout-details{background-color:#fff; border: 2px solid #ddd;}.checkout{padding:0px 15px; border-bottom: 1px solid #dddddd;}
    .checkout h2{font-family:'Lora',sans-serif;}.content-details{padding: 15px 20px;}
    .step-one-toggle{max-height:40px; background-color: #666; padding:10px; color:#dfdfdf; font-size:12px;cursor:pointer;}
    .step-one-preview,.step-two-preview{padding:10px;border: 1px solid #dddddd;}#billing-form input[type=text]{border-radius:0px; font-size:12px;}#billing-form label{font-size:12px;}.open-close-icon i{cursor:pointer;}
    .step-one, .step-two{margin-bottom:6px;}
    .step-two-toggle{max-height:40px; background-color:#666; padding:10px; color:#dfdfdf; font-size:12px;}
    .step-two-preview {font-size:12px;}.step-two-preview ul li{list-style:none;}
</style>
<body>
    <header class="navbar">
        <div class="container">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <a href="" class="navbar-brand">
                        <img src="<?php echo site_url().'assets/img/DAZINNY-logo.png'?>" alt="checkout-header-logo" class="img-responsive">
                    </a>
                    <ul class="customer-details nav navbar-right">
                        <li>
                            <span class="fa-stack fa-lg" style="color:#dfdfdf;">
                                <i class="fa fa-circle-thin fa-stack-2x"></i>
                                <i class="fa fa-phone fa-stack-1x"></i>
                            </span>
                            <span class="text">NEED HELP? CALL US!</span><br>
                            <span class="tel">0706 051 1748</span>
                        </li>
                    </ul>                 
                </div>
                <div class="col-md-1"></div>
            </div>
        </div>
    </header>
    <section class="checkout-con">
        <div class="container">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="checkout-details">
                       <div class="checkout">
                           <h2>Checkout</h2>
                       </div>
                       <div class="content-details">
                            <div class="row">
                                <div class="col-md-8">
                                    <form action="" id="checkout-form">
                                        <div class="step-one billings-details">
                                            <div class="step-one-toggle">
                                                Billing Details
                                                <span class="pull-right open-close-icon">
                                                    <i class="open-icon-1 fa fa-caret-down"></i>
                                                    <i class="close-icon-1 fa fa-caret-up"></i>
                                                </span>
                                            </div>
                                            <div class="step-one-preview">
                                                <div class="row">
                                                    <section id="billing-form">
                                                        <div class="form-group col-sm-6">
                                                            <label for="full_name">Full Name</label>
                                                            <input type="text" name="full_name" placeholder="Full Name" class="form-control">
                                                        </div>
                                                        <div class="form-group col-sm-6">
                                                            <label for="telephone">Telephone</label>
                                                            <input type="text" name="telephone" placeholder="Telephone" class="form-control">
                                                        </div>
                                                        <div class="form-group col-sm-12">
                                                            <label for="email">Email</label>
                                                            <input type="text" name="email" placeholder="username@mail.com" class="form-control">
                                                        </div>
                                                        <button type="button" class="step-1-next w3-margin btn btn-warning btn-sm pull-right">
                                                             Next <i class="fa fa-arrow-right"></i>
                                                        </button>
                                                    </section>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="step-two delivery-details">
                                            <div class="step-two-toggle">
                                                Delivery Details
                                                <span class="pull-right open-close-icon">
                                                    <i class="open-icon-2 fa fa-caret-down"></i>
                                                    <i class="close-icon-2 fa fa-caret-up"></i>
                                                </span>
                                            </div>
                                            <div class="step-two-preview">
                                                <p><span class="w3-text-red">Note:</span> All pickups in our eatery are free and starts by:</p>
                                                <ul>
                                                    <li>
                                                        <i class="fa fa-clock-o"></i> 9:00am - 7:00pm
                                                    </li>
                                                </ul>
                                                <label for="dazinny">
                                                    <input type="checkbox" name="dazinny-picks">
                                                    Check if you wanna pick from our outlet (it's free). 
                                                </label>
                                               <br>
                                               <span class="w3-text-green">OR</span>
                                               <br>
                                                <span class="text-danger">*</span> Please Select your preferred pickup location 
                                                <div class="location-con w3-margin-top">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <select class="form-control" id="search_area" name="area" data-style="" title="e.g maryland" tabindex="-1">
                                                                    <option value="">ine</option>
                                                                    <option value="">ine</option>
                                                                    <option value="">ine</option>
                                                                    <option value="">ine</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <input type="text" class="form-control" id="amount" placeholder="Delivery fee" disabled> 
                                                        </div>
                                                        <button type="button" class="step-2-next w3-margin btn btn-warning btn-sm pull-right">
                                                                Next <i class="fa fa-arrow-right"></i>
                                                           </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-4"></div>
                            </div>
                       </div>
                    </div>
                </div>
                <div class="col-md-1"></div>
            </div>
        </div>
    </section>
    <script src="<?php echo site_url().'assets/js/bootstrap.js'?>"></script>
    <script src="<?php echo site_url().'assets/js/boot-select.js'?>"></script>
    <script src="<?php echo site_url().'assets/js/checkout.js'?>"></script>
</body>
</html>
<script>
    $(document).ready(function () {
        $('#search_area').selectpicker({
            liveSearch: true
        });
    });
    
</script>
