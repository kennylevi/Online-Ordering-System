<?php
    $page = '';
    defined('BASEPATH') OR exit('No direct script access allowed');
    include('section_templates/header.php'); 

    include('section_templates/cart_nav.php');
?>
<section>
    <div id="view-wrapper">
        <div class="store-content">
            <div class="row">
                <div class="col-lg-8">
                    <div class="notice-con">
                        <h1 class="w3-text-bold">Please Create An Account</h1>
                        <p>You don't need to create an account with us before you can purhase any item, however if you do then you'll be able to enjoy:</p>
                        <ul>
                            <li>Order Tracking</li>
                            <li>Support and more.</li>
                        </ul>
                        <p>Will you like to create an account? </i></p>
                        <div class="notice-btn">
                            <?php echo form_open(); ?>
                            <button type="submit" name="yes-btn" class="btn btn-success" value="Yes- let do it">
                                <i class="fa fa-thumbs-up"></i> Yes- let do it
                            </button>
                            &nbsp; &nbsp;
                            <button type="submit" name="no-btn" class="btn btn-danger" value="No Thanks">
                                <i class="fa fa-thumbs-down"></i> No Thanks
                            </button>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">

                </div>
            </div>
        </div>
    </div>
    <hr>
	<p class="view-footer">&copy; <a href="<?php echo site_url(); ?>">Dazinny</a> 2017 All Right Reserved.</p>
</section>