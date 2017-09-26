<?php 
    $page = 'add_product';
    include('inc/security.php');
    include('inc/doc_head.php'); 
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
    button.delete,button.edit,button.cls, button.save{
        padding: 0 5px;
    }
    table tbody tr{font-size:12px;}
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
                    <li class="active">Categories</li>
                </ol>
            </div>
             <!--body wrapper start-->
            <div class="wrapper">
                <section class="panel">
                   <div class="panel-body">
                       <div class="form">
                            <div class="row">
                                <div class="col-md-5">
                                    <form class="cmxform form-horizontal tasi-form" id="addMenu" method="post" action="<?php echo site_url();?>Admin/new_category">
                                        <div class="form-group">
                                            <div class="col-lg-8">
                                                <input type="text" class="form-control required" name="category" id="menu" placeholder="Product Category">
                                            </div>
                                            <div class="col-lg-4">
                                                <button type="submit" class="btn btn-success m-b-10">Add category</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-7">
                                    <?php if($this->session->has_userdata('added')):?>
                                        <?php echo $this->session->added; ?>
                                    <?php endif; ?>
                                    <div id="message"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <div class="row" id="product-con">
                <?php
                        $cat = $pro_cat['cat_name'];
                        $pro_item = $pro_cat['products'];
                ?>
                <?php  foreach ($cat as $key => $value): ?>
                <?php  $name = $value; $pro_items = $pro_item[$key]; ?>
                            <div class="col-lg-6">
                                <section class="panel panel-<?=$name->cat_name;?>">
                                    <header class="panel-heading head-border">
                                             <?php echo $name->cat_name; ?>
                                        <div class="block pull-right">
                                            <span class="edit_wrap hide" id="edit_val-<?=$name->cat_id;?>">
                                                <input class="edit_val-<?=$name->cat_id;?>" type="text" value="<?=$name->cat_name; ?>" name="<?=$name->cat_id;?>" data-id="<?= $name->cat_id; ?>">
                                                <button type="button" class="save btn btn-success" name="<?=$name->cat_id;?>">save</button>
                                                <button onclick="dataProcess('save', <?=$name->cat_id;?>);" type="button" name="<?=$name->cat_id;?>" class="cls btn btn-info">exit</button>
                                            </span>
                                            <span id="button_val-<?=$name->cat_id;?>" class="">
                                                <button id="edit" class="edit btn btn-info" name="<?=$name->cat_id;?>">
                                                    <i class="fa fa-pencil"></i>
                                                </button>&nbsp;
                                                <button id="delete"  class="delete btn btn-danger" data-id="<?php echo $name->cat_id; ?>"><i class="fa fa-times"></i></button>
                                    
                                            </span>
                                            </div>
                                        <div class="clear-fix"></div>
                                    </header>  
                                    
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Product Name</th>
                                                <th>Product Description</th>
                                                <th>Product Price</th>
                                            </tr>    
                                        </thead>
                                        <tbody>
                                            <?php if ($pro_items): ?>
                                                    <?php foreach ($pro_items as $product) : ?>
                                                    <tr>
                                                        <td><?php echo $product->pro_name; ?></td>
                                                        <td><?php echo $product->pro_description; ?></td>
                                                        <td><?php echo 'N'.$product->pro_price; ?></td>
                                                    </tr>
                                                    <?php endforeach; ?>
                                            <?php else:  echo '<p class="text-danger text-center">NO PRODUCT AVIALABLE <a href="'.site_url().'Admin/all-products"> ADD PRODUCT HERE</a></p>';?>
                                            
                                            <?php endif; ?>
                                            
                                        </tbody>
                                    </table>    
                                </section>    
                            </div>
                    <?php endforeach; ?>
                </div>          
                         
            <!--body wrapper end-->

        </div>
        <!-- body content end-->
    </section>
    <?php include('inc/doc_footer.php'); ?>
    <!-- validate form p -->
<script type="text/javascript" src="<?php echo site_url(); ?>assets/admin_ext/js/jquery.validate.min.js"></script>

</body>
</html>   
<script type="text/javascript">

    function dataProcess(name,key){
        if (name === 'save'){
            $('#edit_val-'+key).addClass('hide');
            $('#button_val-'+key).removeClass('hide');
        }
    }
    $(document).ready(function(){
        $('#addMenu').validate();
       
        $('#product-con').delegate('.delete', 'click', function () {
            var id = $(this).data('id');
            var pro_div = $(this).closest('div');
            if (confirm('Deleting This Product will Remove The whole Items Under It, Are You Sure?')) {
                
                $.ajax({
                    url: "<?php echo site_url(); ?>Admin/delete_category/"+id,
                    type: "POST",
                    success: function (data) {
                        pro_div.fadeOut(200, function () {
                            $(this).remove();
                        });
                        console.log(data);
                        $('#message').html(data.message);
                    }

                });
            }

        });

       
        // editing the categoty name if theres any typo error
        $('.edit').on('click', function (evt) {
            // console.log('evt-',evt.currentTarget.name);
            $("#edit_val-"+evt.currentTarget.name).removeClass("hide");
            $("#button_val-"+evt.currentTarget.name).addClass("hide");

        });
        $('.save').on('click', function (evt) {
            var cat_name = $('.edit_val-'+evt.currentTarget.name).val();
            var cat_id = $('.edit_val-'+evt.currentTarget.name).data('id');          
                       
            $.ajax({
                url: "<?php echo site_url();?>Admin/edit_category/"+ cat_id,
                type: "POST",
                data:{cat_name: cat_name},
                success: function () {
                    $('body').load("<?php echo site_url();?>Admin/add-category");
                }
            });
        });

    });
</script>     
