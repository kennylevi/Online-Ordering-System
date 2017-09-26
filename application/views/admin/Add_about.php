<?php
    $page = "";
    include('inc/security.php');
    foreach ($value as $content) {
        $contents = $content->content;
    }

    // document head tag sectrion
    include('inc/doc_head.php');
?>
<body class="sticky-header">
<style type="text/css">
    button.btn.btn-default.kv-fileinput-upload.fileinput-upload-button{
        display:none;
    }
    .file-preview-thumbnails img{
        width: 100%;
        /*max-height: 100% !important;*/
    }
    button.save{margin-left:20px;}
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
                    <li class="active">Add-About-Content</li>
                </ol>
            </div>
            <!--body wrapper start-->
            <div class="wrapper">
            <div class="row">
                <div class="col-md-12">
                    <div class="pull-right">
                        <?php if($this->session->has_userdata('success')): ?>
                            <?php echo $this->session->success; ?>
                        <?php endif; ?> 
                        <?php if($this->session->has_userdata('failed')): ?>
                            <?php echo $this->session->failed; ?>
                        <?php endif; ?>    
                    </div>
                </div>
            </div>
                <div class="row">
                    <?php 
                        $attr = array(
                            'role' => 'form' ,
                            'id' => 'aboutForm'
                        );
                       echo form_open_multipart('Admin/about_content_submit', $attr);
                     ?>   
                    
                       <div class="col-sm-5 form-group">
                           <label>About Image</label>
                            <input id="file-0" class="file form-control" name="file" type="file" multiple=true>
                            <p class="help-block">Composory</p>
                       </div>
                       <div class="col-sm-7 form-group">
                             <div class="panel-body">
                                 <label>About Content</label>
                                <textarea class="required wysihtml5 form-control con" rows="9" name="content"><?php echo $contents; ?></textarea>
                            </div>
                             <?php if ($this->session->has_userdata('err')): ?>
                                <div class="pull-right"><?php echo $this->session->err; ?></div>
                            <?php endif; ?>
                       </div>
                       <div class="form-group">
                           <button type="submit" class="btn btn-success save">Save Content</button>
                       </div>
                   </form>
                </div>

            </div>
            <!--body wrapper end-->
        </div>
        <!-- body content end-->
    </section>
<?php include('inc/doc_footer.php'); ?>

<script type="text/javascript" src="<?php echo site_url(); ?>assets/admin_ext/js/bootstrap-fileinput-master/js/fileinput.js"></script>
<script type="text/javascript" src="<?php echo site_url(); ?>assets/admin_ext/js/file-input-init.js"></script>
<!-- text editor js p -->
<!--summernote-->
<script type="text/javascript" src="<?php echo site_url(); ?>assets/admin_ext/js/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script>
<script type="text/javascript" src="<?php echo site_url(); ?>assets/admin_ext/js/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
<!-- validate form p -->
<script type="text/javascript" src="<?php echo site_url(); ?>assets/admin_ext/js/jquery.validate.min.js"></script>

</body>
</html>
<script type="text/javascript">
    $(document).ready(function(){

        $('#aboutForm').validate(); 

         $('.wysihtml5').wysihtml5();
        
    });
</script>