<?php
    $page = "add_users";
    include('inc/security.php');
    include('inc/doc_head.php');
?>
<style type="text/css">
    label.error{color:#e55957;}
     .alert-danger {
        color: #c9c2c1;
        background-color: #9b0808;
    }  
    .alert-success {
        color: #e0e4e0;
        background-color: #2f8f07;
    }
</style>
<body class="sticky-header">
    
    <section>
        <!-- sidebar left start-->
        <?php include('inc/sidebar.php'); ?>
        <!-- body content start-->
        <div class="body-content" style="min-height: 1200px;">

            <!-- header section start-->
            <?php include('inc/header.php'); ?>
            <!-- page head end-->
             <!-- page head start-->
            <div class="page-head">
                <ol class="breadcrumb m-b-less bg-less">
                    <li>
                        <a href="<?php echo site_url('Admin'); ?>"><i class="fa fa-home"></i> &nbsp;Dashboard</a>
                    </li>
                    <li class="active"><i class="fa fa-user"></i> Add User</li>
                </ol>
            </div>
            <!--body wrapper start-->
            <div class="wrapper">
                <div class="row">
                    <div class="col-md-12">
                        <section class="panel">
                            <header class="panel-heading">
                               Add New User 
                               <span class="pull-right">
                                    <?php if($this->session->has_userdata('success')):?>
                                        <?php echo $this->session->success; ?>
                                    <?php endif; ?>
                                    <?php if($this->session->has_userdata('error')):?>
                                        <?php echo $this->session->error; ?>
                                    <?php endif; ?>
                                </span>
                            </header>
                            <div class="panel-body">
                                <form id="wizard-validation-form" action="<?php echo site_url(); ?>Admin/add_users_auth" method="post">
                                    <div>
                                         <h4>Step 1 (PERSONAL DETAILS) </h4>
                                        <section>

                                            <div class="form-group clearfix">
                                                <label class="col-lg-2 control-label" for="name"> Full name *</label>
                                                <div class="col-lg-10">
                                                    <input id="name" name="fname" type="text" class="required form-control">
                                                </div>
                                            </div>
                                            <div class="form-group clearfix">
                                                <label class="col-lg-2 control-label " for="telephone"> Telephone *</label>
                                                <div class="col-lg-10">
                                                    <input id="telephone" name="telephone" type="text" class="required form-control">

                                                </div>
                                            </div>

                                            <div class="form-group clearfix">
                                                <label class="col-lg-2 control-label " for="role">Role *</label>
                                                <div class="col-lg-10">
                                                    <select class="role required form-control m-b-10" name="role">
                                                        
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group clearfix">
                                                <label class="col-lg-2 control-label " for="option-yes">Gender</label>
                                                 <div class="radio-custom radio-success required col-lg-10">
                                                    <input type="radio" value="male" checked="checked" name="option-yes" id="male">
                                                    <label for="male">Male</label>
                                                    <input type="radio"  value="female" name="option-yes" id="female">
                                                    <label for="female">Female</label>
                                                </div>
                                            </div>
                                            <div class="form-group clearfix">
                                                <label class="col-lg-12 control-label ">(*) Mandatory</label>
                                            </div>

                                        </section>
                                        <h4>Step 2 (ACCOUNT DETAILS)</h4>
                                        <section>
                                            <div class="form-group clearfix">
                                                <label class="col-lg-2 control-label " for="userName">User name </label>
                                                <div class="col-lg-10">
                                                    <input class="form-control required" id="userName" name="userName" type="text">

                                                </div>
                                            </div>
                                            <div class="form-group clearfix">
                                                <label class="col-lg-2 control-label " for="password"> Password *</label>
                                                <div class="col-lg-10">
                                                    <input id="password" name="password" type="password" class="form-control">

                                                </div>
                                            </div>

                                            <div class="form-group clearfix">
                                                <label class="col-lg-2 control-label " for="confirm">Confirm Password *</label>
                                                <div class="col-lg-10">
                                                    <input id="confirm" name="confirm" type="password" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group clearfix">
                                                <label class="col-lg-12 control-label ">(*) Mandatory</label>
                                            </div>
                                        </section>
                                       
                                        <h4>Step Final</h4>
                                        <section>
                                            <div class="form-group clearfix">
                                                <div class="col-lg-12">
                                                    <input id="acceptTerms" name="acceptTerms" type="checkbox" class="required">
                                                    <label for="acceptTerms">I agree with the Terms and Conditions.</label>
                                                </div>
                                            </div>

                                        </section>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" name="submit" class="btn btn-success btn-sm">Add User</button>
                                    </div>
                                </form>
                            </div>
                        </section>
                    </div>            
            </div>
            <!--body wrapper end-->
        </div>
        <!-- body content end-->
    </section>
<?php 
    include('inc/doc_footer.php'); 
    include('inc/jsUrl.php');
?>
</body>
</html>
<script type="text/javascript">
    $(document).ready(function () {

       $("#wizard-validation-form").validate({
            rules:{
                password:{
                    required: true,
                    minlength: 5
                },
                confirm:{
                    required: true,
                    equalTo: "#password"
                }
            }
       });

       $('.role').click(function () {
          
            $.getJSON(
                "<?php echo site_url();?>Admin/get_user_role",
                function (result) {
                    $('.role').html(result);
                }
            );
       });

    });
</script>