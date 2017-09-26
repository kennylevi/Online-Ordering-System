<?php 
    $page = 'all_users';
    include('inc/security.php');
    include('inc/doc_head.php');
    include('inc/cssUrl.php'); 
?>
<body class="sticky-header">
<style>
     .alert-success {
        color: #e0e4e0;
        background-color: #2f8f07;
    }
     .alert-danger {
        color: #c9c2c1;
        background-color: #9b0808;
    } 
    tbody td{font-size:13px;}
    button.edit,button.del{padding: 0 5px;}
</style>
    <section>
        <!-- sidebar left start-->
        <?php include('inc/sidebar.php'); ?>
        <!-- sidebar left end-->

        <!-- body content start-->
        <div class="body-content" >
              <!-- header section start-->
                <?php include('inc/header.php'); ?>
            <!-- header section end-->

            <!-- page head start-->
            <div class="page-head">
                <ol class="breadcrumb m-b-less bg-less">
                    <li>
                        <a href=""><i class="fa fa-home"></i> &nbsp;Dashboard</a>
                    </li>
                    <li class="active">All Users</li>
                </ol>
            </div>
             <!--body wrapper start-->
            <div class="wrapper">
            <div class="row">
                    <div class="col-sm-12">
                        <section class="panel">
                            <header class="panel-heading ">
                                All Users Table
                                <span class="tools pull-right">
                                    <div class="msg">
                                    </div>
                                    <a class="fa fa-repeat box-refresh" title="refresh" href="javascript:;"></a>
                                </span>
                            </header>
                            <table class="table responsive-data-table data-table table-hover" id="users-table">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Full Name</th>
                                        <th>Username</th>
                                        <th>Phone</th>
                                        <th>Gender</th>
                                        <th>Role</th>
                                        <th>Date Created</th>
                                        <th>Last logged In</th>
                                        <th>Status (D/A)</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="row-del-tool">
                                <?php $i = 0; foreach($users as $user): $i ++;  
                                    $status = $user->user_status;
                                 ?>
                               
                                    <tr>
                                        <td><?php echo $i;?></td>
                                        <td><?php echo $user->user_full_name; ?></td>
                                        <td><?php echo $user->user_username; ?></td>
                                        <td><?php echo $user->user_telephone; ?></td>
                                        <td><?php echo $user->user_gender; ?></td>
                                        <td><?php echo $user->role_name; ?></td>
                                         <td><?php echo $user->user_date_created; ?></td>
                                        <td>
                                            <?php
                                                $date = date_create($user->date_logged_in);
                                                if(date_format($date, 'Y-m-d') == date("Y-m-d")){
                                                   echo "today ".'at '.date_format($date, 'g:i A');
                                                }elseif (date_format($date, 'Y-m-d') == date("Y-m-d ",  strtotime("-1 days"))) {
                                                   echo "yesterday ".'at '.$user->date_logged_in;
                                                }elseif($date == "" ){
                                                    echo "never logged in";
                                                }else {
                                                    echo $user->date_logged_in;
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <?php  if($user->user_id == 1): ?>
                                            <?php  echo " "; ?>
                                            <?php else : ?>
                                                <input type="checkbox" data-toggle="toggle" data-onstyle="success" data-offstyle="danger" id="<?php $user->user_id;?>" name="status" value="<?php echo $user->user_id; ?>" <?php if($status == 1){echo "checked";} ?>>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php  if($user->user_id == 1): ?>
                                            <?php  echo " "; ?>
                                            <?php else :?>
                                                <button type="button"  data-toggle="modal" data-target="#myModal" class="edit btn btn-warning" data-id="<?= $user->user_id; ?>">
                                                    <i class="fa fa-pencil" title="edit this user"></i>
                                                </button>   
                                                <button type="button" class="del btn btn-danger" title="Delete User" data-id="<?php echo $user->user_id; ?>"><i class="fa fa-times"></i></button>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <!-- product item modal -->
                                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    <h4 class="modal-title">Edit User Role</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-sm-12 col-md-12">
                                                            <div id="formWrap">
                                                               
                                                            </div>
                                                            <div class="formMsg" style="color:#2f8f07;">

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                    <div class="modal-footer">
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
    <!-- validate form p -->
    <script type="text/javascript" src="<?php echo site_url(); ?>assets/admin_ext/js/jquery.validate.min.js"></script>

</body>
</html>   
<script type="text/javascript">
    $(document).ready(function () {
         Tipped.create('.btn, .edit, .box-refresh');

        $('.box-refresh').click(function () {
            $('body').load("<?php echo site_url();?>Admin/all-users");
        }); 
        
        $("input[type='checkbox']").change(function () {
               
            if ($(this).prop('checked') == false) {
                var val = $(this).val();
                if(confirm('Are you sure you want to deactivate this user')){
                    
                    $.ajax({
                       url: "<?php echo site_url(); ?>Admin/deactivate_user/"+val,
                       method: "POST",
                       success: function (data) {
                           alert('User deactivated');
                       } 
                    });
                    // asking for comfirmation
                }
            }else {
                var val = $(this).val();
                if(confirm('Are you sure you want to activate user')){
                    
                    $.ajax({
                       url: "<?php echo site_url(); ?>Admin/deactivate_user/"+val,
                       method: "POST",
                       success: function (data) {
                           alert('User Activated');
                       } 
                    });
                    // asking for comfirmation
                }
            }  
            
        });

        // deleting user
        $(".row-del-tool").delegate('.del', 'click', function () {
            var value = $(this).data('id');
            var tr = $(this).closest('tr');

           if (confirm('Are Sure You want to Delete this user?')) {
                
                $.ajax({

                    url: "<?php echo site_url(); ?>Admin/delete_user/"+value,
                    method: "POST",
                    dataType: "JSON",
                    success: function (data) {
                        // console.log(value);
                        tr.fadeOut(300, function () {
                            $(this).remove();
                        });
                        $('.msg').html(data.msg);
                    }

                });
           }

        });

        // edit user role
        $('.edit').on('click', function () {
           var roleID = $(this).attr('data-id');
           var role = $('#formWrap');
            $.post(
                "<?php echo site_url();?>Admin/get_edit_form/"+roleID,
                function (result) {
                   console.log(result.form);
                   role.html(result.form);
                }
            );
        
        });

        //save edited role
        $(document).on('click', '.save',function () {
            var value = $("#editForm").serialize();
            var msg = $('.formMsg');
            $.post(
                "<?php echo site_url();?>Admin/save_edited_role",
                value,
                function (result) {
                   msg.html(result.msg);
                   console.log(result.msg)
                   setTimeout(function() {
                        $('body').load("<?php echo site_url();?>Admin/all-users");
                    }, 500); 
                }
            );
        }); 

    });
</script>
