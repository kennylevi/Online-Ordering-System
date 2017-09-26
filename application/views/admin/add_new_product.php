<?php 
    include('inc/security.php');
    include('inc/doc_head.php');
?>
<html>
    <body>
        <style type="text/css">
            label.error{color: #ff0000}
        </style>
        <br>
            <?php 
                $attr = array('method' =>'post', 'id' => 'product-form');
                echo form_open_multipart('Admin/add_new_products', $attr); 
            ?>
			<div class="form-group">
                <label>Product Name</label>
                 <input type="text" name="pro_name" id="pro_name" class="form-control required" />
            </div>
            <div class="form-group">
                <label>Select Product Category</label>
                <select name="pro_cat" id="pro_cat" class="form-control">
                    
                </select>   
            </div>
            <div class="form-group">
                <label>Product Description</label>
                 <input type="text" name="pro_desc" id="pro_desc" class="form-control required" />
            </div>
            <div class="form-group">
                <label>Product Price (N)</label>
                <input type="text" name="pro_price" id="pro_price" class="form-control required" onkeypress="return isNum(event);" />
            </div>
            <div class="form-group">
                <label>Was Price <span class="text-success">(optional)</span></label>
                <input type="text" name="was_price" class="form-control" onkeypress="return isNum(event);" />
            </div> 
            <div class="form-group">
                <label>
                    <input type="file" name="pro_image" class="required" id="pro_image"/> Add Product image
                </label>
            </div>  
            <div class="form-group">
                <button type="submit" name="save" class="btn btn-sm btn-block btn-danger">Save</button>
            </div> 
        </form>
        <?php include('inc/doc_footer.php'); ?>
          <!-- validate form p  -->
        <script type="text/javascript" src="<?php echo site_url(); ?>assets/admin_ext/js/jquery.validate.min.js"></script>
    </body>
</html>
<script type="text/javascript">
    function isNum(evt) {
        var checkInput = (evt.which) ? evt.which : event.keycode
        if (checkInput > 31 && (checkInput < 48 || checkInput >57 ) )
            return false;
        return true;
    }

    $("#pro_cat").load("<?php echo site_url(); ?>Admin/load_cat_list");

    $(document).ready(function () {

        $('#product-form').validate();

    });
</script>