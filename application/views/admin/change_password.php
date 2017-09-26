<?php
    $page = 'change_pword';
    include('inc/security.php');
    include('inc/doc_head.php');
?>
<body class="sticky-header">
<style type="text/css">
    label.error{
        color: #ff0000;
    }
    .alert-danger {
        color: #c9c2c1;
        background-color: #9b0808;
    }
    .alert-success {
        color: #e0e4e0;
        background-color: #2f8f07;
    }
</style>
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
                    <li class="active">Change Password</li>
                </ol>
            </div>
            <!--body wrapper start-->
            <div class="wrapper">

                <div class="row">
                    <div class="col-lg-6">
                        <section class="panel">
                            <header class="panel-heading">
                                Change Password
                            </header>
                            <div class="panel-body">
                                <form role="form" action="<?php echo site_url(); ?>Admin/verify_user" method="POST" id="user-form">
                                    <div class="form-group">
                                        <label for="Username">Username</label>
                                        <input type="text" class="form-control required" name="Username" id="Username" placeholder="Enter Username">
                                    </div>
                                    <button type="submit" class="btn btn-info">Submit</button>
                                </form>

                            </div>
                        </section>
                    </div>
                    <?php if($this->session->has_userdata('verified')): ?>
                        <?php echo $this->session->verified; ?>
                    <?php endif; ?>
                    <?php if($this->session->has_userdata('invalid')): ?>
                        <?php echo $this->session->invalid; ?>
                    <?php endif; ?>
                    <?php if($this->session->has_userdata('updated')): ?>
                        <?php echo $this->session->updated; ?>
                    <?php endif; ?>
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
    $(document).ready(function(){

        $('#user-form').validate();
        $('#password-form').validate({
            rules: {
                 pass1: {
                    required: true,
                    minlength: 5
                },
                pass2: {
                    required: true,
                    minlength: 5,
                    equalTo: "#pass1",
                }
            }
        });

    });
</script>