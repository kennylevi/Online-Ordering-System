<?php
    $page = "reservation";
    include('inc/security.php');
    // document head tag sectrion 
    include('inc/doc_head.php');
    include('inc/cssUrl.php');
?>
<body class="sticky-header">
    <style>
        .alert-success {
            color: #e0e4e0;
            background-color: #2f8f07;
        }
        tr input.disabled{color: #fff;}
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
                    <li class="active">Reservations</li>
                </ol>
            </div>
            <!--body wrapper start-->
            <div class="wrapper">
            <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading ">
                        All Reservations Table
                        <span class="tools pull-right">
                            <a class="fa fa-repeat box-refresh" href="javascript:;" title="refresh list"></a>
                            <a class="t-close fa fa-times" href="javascript:;"></a>
                        </span>
                        <div class="msg pull-right"></div>
                    </header>
                    <table class="table responsive-data-table data-table table-striped" id="rev-table">
                        <thead>
                            <tr>
                                <th>#Ref No</th>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>seats</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Payment status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="reservation">
                            <?php foreach ($resev_item as $value): 
                                $status = $value->res_status;
                                $today = date('Y-m-d');
                                $pay_status = $value->res_payment_status;
                            ?>
                            <tr>
                                <td><?php echo $value->ref_num; ?></td>
                                <td><?php echo strtolower($value->res_full_name); ?></td>
                                <td><?php echo $value->res_email; ?></td>
                                <td><?php echo $value->res_telephone; ?></td>
                                <td><?php echo $value->seats; ?></td>
                                <td>
                                    <?php
                                      include('inc/reserve_status.php');
                                    ?>            
                                </td>
                                <td><?php echo $value->date; ?></td>
                                <td><?php echo $value->time; ?></td>
                                <td> 
                                    <form>                               
                                        <label class="radio-inline">
                                            <input type="radio" class="payment_status" data-id="<?php echo $value->res_id; ?>" name="pay_status" value="1" <?php if($pay_status == 1){echo 'checked';} ?>>
                                        Yes</label>
                                        <label class="radio-inline">
                                            <input type="radio" class="payment_status" data-id="<?php echo $value->res_id; ?>" name="pay_status" value="0" name="optradio" <?php if($pay_status == 0){echo 'checked';} ?>>
                                        No</label>
                                    </form>
                                </td>
                                <td>
                                    <a href="javascript:;" class="d-resv" data-id="<?php echo $value->res_id; ?>" title="Delete this reservation">
                                        <span class="fa fa-trash text-danger" id="delete"></span>
                                    </a> &nbsp;
                                    <a href="#myModal" data-id="<?php echo $value->res_id; ?>" class="v-note" title="view reservation note" data-toggle="modal">
                                        <span class="fa fa-desktop text-success"></span>
                                    </a> &nbsp;
                                    <a href="<?php echo site_url();?>Admin/confirmation_message/<?php echo $value->res_id; ?>" class="resv-msg" title="send message to this person">
                                        <span class="fa fa-envelope text-info"></span>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>    
                        </tbody>
                    </table>
                        <!-- Modal reservation note-->
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title">Reservation Note</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12">
                                            <p class="note"></p>
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
       $('.box-refresh').click(function () {
          $('body').load("<?php echo site_url(); ?>Admin/all-reservations"); 
       });
       Tipped.create('.box-refresh, .d-resv, .v-note, .pending, .around, .resv-msg');

        // deleting this reservation
        $(".reservation").delegate('.d-resv', 'click', function () {
           var id = $(this).data('id');
           var tr = $(this).closest('tr');
           if (confirm("Are you sure you want to delete this reservation?")) {
               $.ajax({
                   url: "<?php echo site_url();?>Admin/delete_reservation/"+id,
                   method: "POST",
                   dataType: "JSON",
                   success: function (data) {
                       tr.fadeOut(300, function () {
                           $(this).remove();
                       });
                       console.log(data.message);
                       $('.msg').html(data.message);
                   }
               });
           } 
        });

        // getting reservation note
        $('.v-note').on('click',function () {
            var id = $(this).attr('data-id');
            // console.log(id);
            $.ajax({
                url: "<?php echo site_url('Admin/getReservationNote/');?>"+id,
                type: "POST",
                dataType: "json",
                success: function(data){
                  $('.note').html(data);
                }
               
            });
        });

        $(".reservation").delegate('.pending, .around', 'click', function () {  
           var reserv_id = $(this).data('id');
           var status = $(this);
           if (status.hasClass('pending')) {
               if (confirm("Are You Sure this Person is Avialable?")) {
                    $(this).removeClass('pending btn btn-warning');
                    $(this).addClass('checked btn btn-success disabled m-b-10');
                    $(this).attr('value','Checked in');

                    // send request to server
                    $.post("<?php echo site_url(); ?>Admin/reservation_status/"+reserv_id);
               }
           }else if (status.hasClass('around')) {
               if (confirm("Are You Sure this Person is Avialable?")) {
                    $(this).removeClass('around btn btn-primary');
                    $(this).addClass('checked btn btn-success disabled m-b-10');
                    $(this).attr('value','Checked in');

                     // send request to server
                    $.post("<?php echo site_url(); ?>Admin/reservation_status/"+reserv_id);
               }
           }

        });

        // posting poayment status
        $('.payment_status').on('click', function () {
           var  res_id = $(this).data('id');
            var value  = $(this).val();
            $.ajax({
                url: "<?php echo site_url();?>Admin/resv_payment_status/"+res_id,
                type: "POST",
                data: {value: value},
                success: function () {
                    console.log('done');
                }
            });

        });

    });
</script>