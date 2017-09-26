<?php
    error_reporting('E_NOTICE');
    include('inc/security.php');
    $page = "confirm_msg";

    include('inc/doc_head.php');
?>
    <style>
         button.save{margin-left:20px;}
    .alert-danger {
        color: #c9c2c1;
        background-color: #9b0808;
    } 
    .alert-success {
        color: #e0e4e0;
        background-color: #2f8f07;
    }
    label.error{color: #9b0808;}
    </style>
<body class="sticky-header">
    <?= include('inc/cssUrl.php'); ?>
    <section>
        <!-- sidebar left start-->
        <?php include('inc/sidebar.php'); ?>
        <!-- body content start-->
        <div class="body-content" style="min-height: 1200px;">
            <!-- header section start-->
            <?php include('inc/header.php'); ?>
            <!-- page head end-->
            <!--body wrapper start-->
            <div class="wrapper no-pad" >

                <!--mail inbox start-->
                <div class="mail-box">
                    <?php include('inc/message_sidebar.php');?>
                    <aside class="lg-side">
                        <div class="inbox-head">
                            <div class="mail-option">
                                <h3 class="pull-left"><?= $headline.' '; ?><?= strtolower($full_name);?></h3>
                                <div class="btn-group pull-right">
                                    <?php if (isset($flash)) {
                                        echo $flash;
                                        } 
                                    ?>
                                </div>
                            </div>

                        </div>
                        <div class="inbox-body">
                            <div class="compose-mail">
                                <?php
                                    $attr = array('class' => "form-horizontal", 'id' => "msg_form");
                                    echo form_open('Admin/confirmation_message', $attr);
                                ?>    
                                    <div class="form-group">
                                        <label for="to" class="col-sm-1 control-label">Email</label>
                                        <div class="col-sm-11">
                                            <input type="text" name="recip_email" value="<?= $email; ?>" tabindex="1" id="to" class="form-control required email">
                                        </div>
                                        <div class="compose-options">
                                            <a onclick="$(this).hide(); $('#cc').parents('.form-group').removeClass('hidden'); $('#cc').focus();" href="javascript:;">Cc</a>
                                            <a onclick="$(this).hide(); $('#bcc').parents('.form-group').removeClass('hidden'); $('#bcc').focus();" href="javascript:;">Bcc</a>
                                        </div>
                                    </div>
                                    <div class="form-group hidden">
                                        <label for="cc" class="col-sm-1 control-label">Cc</label>
                                        <div class="col-sm-11">
                                            <input type="text" name="another_email" tabindex="2" id="cc" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group hidden">
                                        <label for="bcc" class="col-sm-1 control-label">Bcc</label>
                                        <div class="col-sm-11">
                                            <input type="text" tabindex="2" id="bcc" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="subject" class="col-sm-1 control-label">Subject</label>
                                        <div class="col-sm-11">
                                            <input type="text" name="recip_subject" tabindex="1" id="subject" class="form-control required">
                                        </div>
                                    </div>

                                    <div class="compose-editor form-group">
                                        <label for="subject" class="col-sm-1 control-label">Message</label>
                                        <div class="col-sm-11">
                                            <textarea class="wysihtml5 form-control required" rows="9" name="recip_message"></textarea>
                                        </div>

                                    </div>
                                    <hr/>

                                    <div class="compose-btn pull-right">
                                        <button class="btn btn-success" name="submit" type="submit" value="submit"> Send Mail</button>
                                    </div>
                            </div>
                            
                        </div>
                    </aside>
                </div>
                <!--mail inbox end-->

            </div>
            <!--body wrapper end-->
        </div>

    </section>
<?php 
    include('inc/doc_footer.php'); 
    include('inc/jsUrl.php'); 
?>
</body>
</html>        
<script>
    $(document).ready(function () {
        $('#msg_form').validate();
    });
</script>