<?php
    $page = 'product_items';
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
    tr td{font-size: 12px;}
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
                    <li class="active">Products</li>
                </ol>
            </div>
            <!--body wrapper start-->
            <div class="wrapper">
                <div class="row">
                    <div class="col-sm-12">
                        <section class="panel">
                            <header class="panel-heading ">
                                All Products Inventory
                                <span class="tools pull-right">
                                    <a class="fa fa-repeat box-refresh" title="refresh" href="javascript:;"></a>&nbsp;
                                    <a rel="facebox" title="Add New Product here" class="btn btn-success" href="<?php echo site_url(); ?>Admin/add_new_products">Add New Product</a>
                                </span>
                                <span class="pull-right">
                                    <?php if($this->session->has_userdata('upload_error')): ?>
                                            <?php echo $this->session->upload_error; ?>
                                    <?php endif; ?>
                                    <?php if($this->session->has_userdata('item_saved')): ?>
                                            <?php echo $this->session->item_saved; ?>
                                    <?php endif; ?>
                                    <?php if($this->session->has_userdata('item_error')): ?>
                                            <?php echo $this->session->item_error; ?>
                                    <?php endif; ?>
                                    <div class="del-msg"></div>
                                </span>
                            </header>
                            <table class="table responsive-data-table data-table table-hover" id="rev-table">
                                <thead>
                                    <tr>
                                        <th>S/n</th>
                                        <th>Product Name</th>
                                        <th>Category Name</th>
                                        <th>Price</th>
                                        <th>Was Price</th>
                                        <th>Product Image</th>
                                        <th>Date Added/ Updated</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="list-items">
                                    <?php 
                                        $url = site_url('uploads/');
                                        $i = 0;
                                        foreach ($result as $product_items) {
                                            if($product_items->pro_status == 0){
                                                $class ="status-0 btn-danger";
                                                $value ="Inactive";
                                            }else{
                                                $class = "status-1 btn-success";
                                                $value ="Active";
                                            }
                                            $i ++;
                                            echo '
                                                <tr>
                                                    <td>'.$i.'</td>
                                                    <td>'.$product_items->pro_name.'</td>
                                                    <td>'.$product_items->cat_name.'</td>
                                                    <td>N'.$product_items->pro_price.'</td>
                                                    <td>N'.$product_items->pro_was_price.'</td>
                                                    <td><img src="'.$url.$product_items->pro_image.'" height="60" width="80" ></td>
                                                    <td>'.$product_items->pro_date_created.' /'.$product_items->pro_date_updated.'</td>
                                                    <td>
                                                        <input type="button" data-id="'.$product_items->pro_id.'"  class="'.$class.'" value="'.$value.'">
                                                    </td>
                                                    <td>
                                                        <button type="button" id="edit"  data-toggle="modal" data-target="#myModal" data-id="'.$product_items->pro_id.'" class="btn btn-warning" title="Edit this Item"><i class="fa fa-pencil"></i></button>
                                                        <button type="button" id="delete" data-id="'.$product_items->pro_id.'" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                                    </td>
                                                </tr>';
                                        }

                                    ?>
                                </tbody>    
                            </table>  
                            <!-- product item modal -->
                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title">Edit Product-Items</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-sm-12 col-md-12">
                                                    <div id="form-div">
                                                        
                                                    </div>
                                                    <div class="message text-success" style="color:green;">
                                                        
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
                            <!-- modal -->  
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
    $(document).ready(function () {

        $('a[rel*=facebox]').facebox({
            loadingImage : '<?php echo site_url();?>assets/plugins/facebox/loading.gif',
            closeImage   : '<?php echo site_url();?>assets/plugins/facebox/closelabel.png'
        });
       
       Tipped.create('a.btn,button.edit,.box-refresh');
        $('.box-refresh').click(function () {
            $('body').load("<?php echo site_url();?>Admin/product-items");
        });

        // save edited product
        $(document).on('click','.save', function () {
            var datas = $('#edit-form').serialize();
            
            $.ajax({
                url: "<?php echo site_url(); ?>Admin/edit_product_api",
                type: "POST",
                dataType: "JSON",
                data: datas,
                success: function (data) {
                    $('.message').html(data.msg);
                    setTimeout(function() {
                        $('body').load("<?php echo site_url();?>Admin/all-products");
                    }, 5000);
                }
            });
        });

        // Editing product    
        $(document).on('click', '#edit', function () {
           var id = $(this).data('id');
            $.ajax({
                url: "<?php echo site_url(); ?>Admin/edit_products/"+id,
                type: "POST",
                dataType: "JSON",
                success: function (data) {
                    $('#form-div').html(data.form);
                }
            });
        });

        // changing status to inactive
      
        $('input[type=button]').on('click', function () {
            var status = $(this);
            var id = $(this).data('id');
            if (status.hasClass('status-1')) {
                if (confirm('Do You want to Make This Item Inactive?')) {
                    $(this).removeClass('status-1 btn-success');
                    $(this).addClass('status-0 btn-danger');
                    $(this).attr('value','Inactive');   
                
                    $.ajax({
                        url:"<?php echo site_url(); ?>Admin/status_api/"+id,
                        type: "POST",
                        success: function (data) {
                            
                        }
                    });

                }
            }else if (status.hasClass('status-0')) {
                 if (confirm('Do You want to Make This Item Active?')) {
                    $(this).removeClass('status-0 btn-danger');
                    $(this).addClass('status-1 btn-success');
                    $(this).attr('value','Active');   
                
                     $.ajax({
                        url:"<?php echo site_url(); ?>Admin/status_api/"+id,
                        type: "POST",
                        success: function (data) {
                            
                        }
                    });

                }
            }
           
        });

        // Deleting product_items 
        $('#list-items').delegate('#delete', 'click', function () {
            var get_id = $(this).data('id');
            var tr = $(this).closest('tr');

            if (confirm('Are You Sure You Want Delete this Item?')) {
                
                $.ajax({
                    url: "<?php echo site_url();?>Admin/delete_item_api/"+get_id,
                    type: "POST",
                    dataType: "JSON",
                    success: function (data) {
                        tr.fadeOut(300, function () {
                            $(this).remove();
                        });
                        $('.del-msg').html(data.msg);
                    }
                });

            }
        });
        
    });
</script>