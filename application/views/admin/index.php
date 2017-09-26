<?php
    include('inc/security.php');
    $page ="home";
    include('inc/doc_head.php');
?>
<body class="sticky-header">

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
                <h3>
                    Dashboard
                </h3>
                <span class="sub-title">Welcome to Dazinny dashboard</span>
                <div class="state-information">
                    <div class="state-graph">
                        <div id="balance" class="chart"></div>
                        <div class="info">Today Reservation </div>
                    </div>
                    <div class="state-graph">
                        <div id="item-sold" class="chart"></div>
                        <div class="info">Items 1230</div>
                    </div>
                </div>
            </div>
            <!-- page head end-->

            <!--body wrapper start-->
            <div class="wrapper">
                <!--state overview start-->
                <div class="row state-overview">
                    <div class="col-lg-3 col-sm-6">
                        <section class="panel purple">
                            <div class="symbol">
                                <i class="fa fa-send"></i>
                            </div>
                            <div class="value white">
                                <h1 class="timer" data-from="0" data-to="320"
                                    data-speed="1000">
                                    <!--320-->
                                </h1>
                                <p>New Order</p>
                            </div>
                        </section>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <section class="panel ">
                            <div class="symbol purple-color">
                                <i class="fa fa-tags"></i>
                            </div>
                            <div class="value gray">
                                <h1 class="purple-color timer" data-from="0" data-to="123"
                                    data-speed="1000">
                                    <!--123-->
                                </h1>
                                <p>Reservations</p>
                            </div>
                        </section>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <section class="panel green">
                            <div class="symbol ">
                                <i class="fa fa-cloud-upload"></i>
                            </div>
                            <div class="value white">
                                <h1 class="timer" data-from="0" data-to="432"
                                    data-speed="1000">
                                    <!--432-->
                                </h1>
                                <p>Item Upload</p>
                            </div>
                        </section>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <section class="panel">
                            <div class="symbol green-color">
                                <i class="fa fa-bullseye"></i>
                            </div>
                            <div class="value gray">
                                <h1 class="green-color timer" data-from="0" data-to="2345"
                                    data-speed="3000">
                                    <!--2345-->
                                </h1>
                                <p>Visitors</p>
                            </div>
                        </section>
                    </div>
                </div>
                <!--state overview end-->

                <div class="row">
                    <div class="col-md-12">
                        <section class="panel">
                            <header class="panel-heading">
                                Earning Graph
                                <span class="tools pull-right">
                                    <a class="fa fa-repeat box-refresh" href="javascript:;"></a>
                                    <a class="t-collapse fa fa-chevron-down" href="javascript:;"></a>
                                    <a class="t-close fa fa-times" href="javascript:;"></a>
                                </span>
                            </header>
                            <div class="panel-body">

                                <div class="earning-chart-space" id="dashboard-earning-chart"></div>

                                <div class="row earning-chart-info">
                                    <div class="col-sm-12 col-xs-12 text-center">
                                        <h4>$ 12,37</h4>
                                        <small class="text-muted"> Daily Orders</small>
                                    </div>
                                </div>    
                                    
                            </div>
                        </section>
                    </div>
                </div>
            <!--body wrapper end-->

        </div>
        <!-- body content end-->
    </section>
    <?php include('inc/doc_footer.php'); ?>
<script type="text/javascript">

    $(document).ready(function() {

        //countTo

        $('.timer').countTo();

        //owl carousel

        $("#news-feed").owlCarousel({
            navigation : true,
            slideSpeed : 300,
            paginationSpeed : 400,
            singleItem : true,
            autoPlay:true
        });
    });

    $(window).on("resize",function(){
        var owl = $("#news-feed").data("owlCarousel");
        owl.reinit();
    });

</script>

</body>
</html>
