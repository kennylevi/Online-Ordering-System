<?php
    $page = "roles";
    include('inc/security.php');
    // document head tag sectrion 
    include('inc/doc_head.php');
    include('inc/cssUrl.php');
?>
<body class="sticky-header">
<style type="text/css">
    .alert-danger {
        color: #c9c2c1;
        background-color: #9b0808;
    } 
    .alert-success {
        color: #e0e4e0;
        background-color: #2f8f07;
    }
    button.edit,button.delete{padding:0 5px;}
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
                    <li class="active">Roles</li>
                </ol>
            </div>
            <!--body wrapper start-->
            <div class="wrapper">
                <section class="panel">
                    <div class="panel-body">
                        <div class="form">
                            <div class="row">
                                <div class="col-md-5">
                                    <form class="cmxform form-horizontal tasi-form" id="addRole" method="post" action="<?php echo site_url();?>Admin/new_role">
                                        <div class="form-group">
                                            <div class="col-lg-8">
                                                <input type="text" class="save form-control required" name="role" id="role" placeholder="role name">
                                            </div>
                                            <div class="col-lg-4">
                                                <button type="submit" class="btn btn-success m-b-10">Add Role</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-7">
                                    <span class="pul-right">
                                        <?php if($this->session->has_userdata('role')) :?>
                                            <?php echo $this->session->role; ?>
                                        <?php endif; ?>
                                    </span>
                                    <div id="message"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <div class="row" id="roles_wrapper">
                    <div class="col-lg-12">
                        <section class="panel">
                            <header class="panel-heading ">
                                All Roles 
                            </header>
                            <table class="table responsive-data-table data-table table-striped" id="rev-table">
                                <thead>
                                    <tr>
                                        <th>S/n</th>
                                        <th>Role Name</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                     $i = 0;
                                     foreach($user_role as $roles) : 
                                     $i ++;
                                    ?>
                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td><?=$roles->role_name; ?></td>
                                        <td><?= $roles->role_created_at; ?></td>
                                        <td>
                                            <button class="edit btn btn-warning" title="Edit this role" data-toggle="modal" data-target="#myModal_<?=$roles->role_id?>">
                                                <i class="fa fa-pencil"></i>
                                            </button>
                                            <button class="delete btn btn-danger" title="Delete this role">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <!-- product item modal -->
                                    <div class="modal fade" id="myModal_<?=$roles->role_id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    <h4 class="modal-title">Edit Role</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-sm-12 col-md-12">
                                                            <div id="form-div">
                                                                <input type="hidden" class="hidden" value="<?=$roles->role_id;?>">
                                                                <input type="text" class="form-control" name="role_name" id="" value="<?=$roles->role_name;?>">
                                                            </div>
                                                            <div class="message">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                    <div class="modal-footer">
                                                        <button class="save btn btn-success">Save Changes</button>
                                                        <button data-dismiss="modal" class="btn btn-danger" type="button">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                     </div>    
                                <!-- modal -->
                                    <?php endforeach; ?>
                                </tbody>
                            </table>    
                        </section>
                    </div>
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
        Tipped.create('.edit, .delete');
        $('#addRole').validate(); 
        
    });
</script>