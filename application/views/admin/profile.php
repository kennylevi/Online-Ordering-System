<?php
    $page = "";
    include('inc/security.php');
    // document head tag sectrion 
    include('inc/doc_head.php');
    include('inc/cssUrl.php');

    // getting user details
    foreach ($details as  $detail) {
        $id = $detail->user_id;
        $full_name = $detail->user_full_name;
        $username = $detail->user_username;
        $role = $detail->role_name;
        $phone = $detail->user_telephone;
        $gender = $detail->user_gender;
    }
?>
<body class="sticky-header">
<style type="text/css">
    #profile_wrapper{
        padding: 20px;
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
                    <li class="active">Profile</li>
                </ol>
            </div>
            <!--body wrapper start-->
            <div class="wrapper">
                <section class="panel">
                    <div class="panel-body">
                        <div class="alert alert-warning fade in" role="alert">
                            <b><i class="fa fa-exclamation-circle"></i> notification</b> You can Edit and Change Some of Your Details
                        </div>
                            <div class="row" id="profile_wrapper">
                                <div class="form">
                                    <div class="row">
                                        <div class="col-md-7 col-lg-7">
                                            <?php 
                                                $attr = array(
                                                    'class' => "cmxform form-horizontal tasi-form",
                                                    'id' => "profile"
                                                );
                                                echo form_open('',$attr);
                                            ?>
                                                <input type="hidden" name="user_id" value="<?= $id;?>">
                                                <div class="form-group">
                                                    <label class="col-sm-2" for="full_name">Full Name</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" name="full_name" id="full_name" value="<?=$full_name; ?>">                    
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2" for="role">Role</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" name="role" id="role" value="<?=$role; ?>" disabled>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2" for="telephone">Telephone</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control required" name="telephone" id="telephone" value="<?=$phone;?>">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2" for="gender">Gender</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" name="gender" id="gender" value="<?=$gender; ?>" disabled>
                                                    </div>
                                                </div>
                                                <button class="btn btn-success" name="save">Save Changes</button>
                                            </form>
                                        </div>
                                        <div class="col-md-5 col-lg-5">
                                            <span>
                                                <?php  if($this->session->has_userdata('profile')) :?>
                                                    <?php echo $this->session->profile;?>
                                                <?php endif; ?>
                                            </span>
                                            <div id="message"></div>
                                        </div>
                                  </div>
                            </div>
                        </div>
                    </div>
                </section> 
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
        
    });
</script>