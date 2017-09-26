           <div class="header-section">

                <!--logo and logo icon start-->
                <div class="logo dark-logo-bg hidden-xs hidden-sm">
                    <a href="<?php echo site_url('Admin'); ?>">
                        <img src="<?php echo site_url(); ?>assets/img/DAZINNY-logo.png" alt="" height="50px">
                        <!--<i class="fa fa-maxcdn"></i>-->
                        <span class="brand-name">Dazinny CP</span>
                    </a>
                </div>

                <div class="icon-logo dark-logo-bg hidden-xs hidden-sm">
                    <a href="<?php echo site_url('Admin'); ?>">
                        <img src="<?php echo site_url(); ?>assets/img/DAZINNY-logo.png" class="img-responsive" height="50px" alt="">
                        <!--<i class="fa fa-maxcdn"></i>-->
                    </a>
                </div>
                <!--logo and logo icon end-->

                <!--toggle button start-->
                <a class="toggle-btn"><i class="fa fa-outdent"></i></a>
                <!--toggle button end-->

                <div class="notification-wrap">
                <!--left notification start-->
                <div class="left-notification">
                <ul class="notification-menu">

                <!--notification info start-->
                <li>
                    <a href="javascript:;" class="btn btn-default dropdown-toggle info-number" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        <span class="badge bg-danger">4</span>
                    </a>

                    <div class="dropdown-menu dropdown-title ">

                        <div class="title-row">
                            <h5 class="title yellow">
                                You have 4 New Notification
                            </h5>
                            <a href="javascript:;" class="btn-danger btn-view-all">View all</a>
                        </div>
                        <div class="notification-list-scroll sidebar">
                            <div class="notification-list mail-list not-list">
                                <a href="javascript:;" class="single-mail">
                                    <span class="icon bg-primary">
                                        <i class="fa fa-envelope-o"></i>
                                    </span>
                                    <strong>New User Registration</strong>

                                    <p>
                                        <small>Just Now</small>
                                    </p>
                                    <span class="un-read tooltips" data-original-title="Mark as Read" data-toggle="tooltip" data-placement="left">
                                        <i class="fa fa-circle"></i>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </li>
                <!--notification info end-->
                </ul>
                </div>
                <!--left notification end-->


                <!--right notification start-->
                <div class="right-notification">
                    <ul class="notification-menu">
                        <li>
                            <a href="javascript:;" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                <?php echo $username; ?>
                                <span class=" fa fa-angle-down"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-usermenu purple pull-right">
                                <li><a href="<?php echo site_url('Admin/profile/'.$username); ?>">  Profile</a></li>
                                <li><a href="<?php echo site_url('Admin/log_out'); ?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                            </ul>
                        </li>
                        <li>
                            <div class="sb-toggle-right">
                                <i class="fa fa-indent"></i>
                            </div>
                        </li>

                    </ul>
                </div>
                <!--right notification end-->
                </div>

            </div>
