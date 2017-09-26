<?php
    $page = 'sent_msg';
    include('inc/security.php');
    include('inc/doc_head.php');
?>
<style>
    .alert-success {
        color: #e0e4e0;
        background-color: #2f8f07;
    }
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
            <div class="wrapper no-pad" >

                <!--mail inbox start-->
                <div class="mail-box">
                    <?php include('inc/message_sidebar.php');?>
                
                    <aside class="lg-side" style="height: 1200px">
                        <div class="inbox-head">
                            <div class="mail-option">
                                <div class="pull-left all-check">
                                    <label class="checkbox-custom check-success">
                                        <input type="checkbox" value="check-all" id="checkbox1"> <label for="checkbox1"> </label>
                                    </label>
                                </div>

                                <div class="btn-group">
                                    <a class="btn mini tooltips" href="<?php site_url();?>" data-toggle="dropdown" data-placement="top" data-original-title="Refresh">
                                        <i class=" fa fa-refresh"></i>
                                    </a>
                                </div>

                                <div class="btn-group">
                                    <a class="btn-trash btn" href="#">
                                        <i class=" fa fa-trash"></i>
                                    </a>
                                </div>
                                <ul class="pull-right pagination">
                                    <?=$pagination_links; ?>
                                </ul>
                            </div>
                            <div class="response pull-right"></div>
                        </div>
                        <div class="inbox-body no-pad">

                            <table class="table table-inbox table-hover">
                                <tbody>
                                <?php if(! empty($msg_list)): ?>
                                   <?php foreach($msg_list as $messages): $id = $messages->id;?> 
                                  
                                        <tr id="<?= $id; ?>">
                                            <td class="inbox-small-cells">
                                                <label class="checkbox">
                                                    <input type="checkbox" class="chk" value="<?= $id; ?>" name="del_id[]">
                                                </label>
                                            </td>
                                            <td class="inbox-small-cells"><i class="fa fa-star"></i></td>
                                            <td class="msg_row" data-id="<?= $id; ?>">
                                                <?= $messages->email;?>
                                            </td>
                                            <td class="msg_row" data-id="<?= $id; ?>">
                                                <span style="color:black"><?= $messages->subject; ?></span> - <i style="color:grey"><?=substr($messages->message, 0,25).'...'; ?></i>
                                            </td>
                                            <td class="msg_row" data-id="<?= $id; ?>">
                                                <?= $messages->date_created.' at '.$messages->time_created; ?>
                                            </td>
                                        </tr>
                                       
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <div style="text-align:center">Message Currently Not Avialable Send Message</div>
                                <?php endif; ?>            
                                </tbody>
                            </table>
                        </div>
                    </aside>  
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
<script>
    $(function () {
        
        $('.msg_row').click(function () {
           var id = $(this).data('id');
           window.location = "<?php echo site_url() ?>Admin/view-sent-message/"+id; 
        });

    //    highlighting the tr box when it checked
        $('.chk').click( function () {
           if($(this).is(':checked')){
              $(this).parent().parent().parent().css('background', 'gray');  
           }else{
                $(this).parent().parent().parent().css('background', 'transparent'); 
           }
        });

    // deleting multiple rows    
        $('.btn-trash').on('click', function () {
            if (confirm("Do you want to delete?")) {
                var id = [];

                $(':checkbox:checked').each(function (i) {
                    id[i] = $(this).val();
                });
                if (id.length === 0) {
                    alert('please select at least a row to delete.');
                }else{
                    $.ajax({
                        url: "<?php site_url();?>delete_row",
                        type: "POST",
                        data: {id:id},
                        dataType: "JSON",
                        success: function (data) {
                            for (var i = 0; i < id.length; i++) {
                                $('tr#'+id[i]+'').fadeOut(300, function () {
                                    $(this).remove();
                                });
                            }   
                            $('.response').html(data.del);
                        }
                    });
                }

            } 
        });
        
    });
</script>