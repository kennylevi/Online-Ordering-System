<?php
    $page = "";
    include('inc/security.php');
    include('inc/doc_head.php');
?>
<body class="sticky-header">
  <?= include('inc/cssUrl.php'); ?>
    <section>
        <!-- sidebar left start-->
        <?php include('inc/sidebar.php'); ?>
        <!-- body content start-->
        <div class="body-content" style="min-height: 1200px;">

            <!-- header section start-->
            <?php include('inc/header.php'); ?>
            <!-- page head end-->
            
            <!--body wrapper start-->
            <div class="wrapper no-pad">
                <!--mail inbox start-->
                <div class="mail-box">
                    <?php include('inc/message_sidebar.php');?>
                
                    <aside class="lg-side" style="height: 1200px">

                        <?php foreach($response as $datas): ?>  
                        <div class="inbox-body">
                            <div class="heading-inbox row">

                                <div class="col-md-12">
                                    <h4> <?= $datas->subject; ?></h4>
                                </div>

                            </div>
                            <div class="sender-info">
                                <div class="row">
                                    <div class="col-md-6 col-xs-12">
                                        <div class="pull-left">
                                            <img alt="" src="img/img2.jpg">
                                        </div>
                                        <div class="s-info">
                                            <span>dazinny</span>
                                            to
                                            <span>[<?= $datas->email; ?>]</span>
                                            <a class="sender-dropdown tooltips" href="javascript:;"  data-placement="bottom" data-toggle="tooltip" type="button" data-original-title="Show Details">
                                                <i class="fa fa-chevron-down"></i>
                                            </a>
                                        </div>

                                    </div>
                                    <div class="col-md-6 col-xs-12">
                                        <div class="compose-btn pull-right">
                                            <button title="" data-placement="top" data-toggle="tooltip" data-original-title="Trash" class="btn btn-default btn-sm tooltips"><i class="fa fa-trash-o"></i></button>
                                        </div>
                                        <p class="date pull-right"> <?= $datas->date_created;?> </p>
                                        <p class="date pull-right"> at <span><?= $datas->time_created;?> </span> </p>
                                    </div>
                                </div>
                            </div>
                            <div class="view-mail">
                                <p>
                                    <strong>
                                        Hello 
                                    </strong>
                                </p>
                                <p> <?= $datas->message; ?> </p>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </aside> 
                </div>
                

            </div>
            <!--body wrapper end-->
        </div>
        <!-- body content end-->
    </section>
<?php include('inc/doc_footer.php'); ?>

</body>
</html>
