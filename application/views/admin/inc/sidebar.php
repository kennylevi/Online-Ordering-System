        <?php $url = site_url(); ?>
        <div class="sidebar-left">
            <!--responsive view logo start-->
            <div class="logo dark-logo-bg visible-xs-* visible-sm-*">
                <a href="index.html">
                    <img src="<?php echo site_url(); ?>assets/img/DAZINNY-logo.png"  alt="" height="50px">
                    <!--<i class="fa fa-maxcdn"></i>-->
                    <span class="brand-name">Dazinny Cp</span>
                </a>
            </div>
            <!--responsive view logo end-->

            <div class="sidebar-left-info">
                <!-- visible small devices start-->
                <div class=" search-field">  </div>
                <!-- visible small devices end-->

                <!--sidebar nav start-->
                <ul class="nav nav-pills nav-stacked side-navigation">
                    <li>
                        <h3 class="navigation-title">Navigation</h3>
                    </li>
                    <li class="<?php if( $page=='home'){echo 'active'; }?>"><a href="<?php echo site_url(); ?>admin"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
                    <?php if($role =="super administrator" OR $role == "management"): ?>
                        <li class="menu-list">
                            <a href=""><i class="fa fa-laptop"></i>  <span>Contents Management</span></a>
                            <ul class="child-list">
                                <li><a href="'.$url.'Admin/create-about-contents"> Add About Contents/Image</a></li>
                                <!-- <li><a href="collapsed-menu.html"> Add Location</a></li> -->
                            </ul>
                        </li>
                    <?php endif; ?>
                    <li class="menu-list"><a href=""><i class="fa fa-book"></i> <span>Products</span></a>
                        <ul class="child-list">
                            <li class="<?php if( $page=='add_category'){echo 'active'; }?>">
                                <a href="<?php echo site_url('Admin/add-category'); ?>"> Add Product Category</a>
                            </li>
                            <li class="<?php if( $page=='product_items'){echo 'active'; }?>">
                                <a href="<?php echo site_url(); ?>Admin/all-products"> All Product </a>
                            </li>
                        </ul>
                    </li>
                    <li class="<?php if( $page=='orders'){echo 'active'; }?>">
                        <a href=""><i class="fa icon-basket"></i> <span> Orders</span></a>
                    </li>
                    <li class="<?php if( $page=='reservation'){echo 'active'; }?>">
                        <a href="<?php echo site_url('Admin/all-reservations'); ?>"><i class="fa icon-book-open"></i> <span> Reservations</span></a>
                    </li>
                    <li class="<?php if($page=="change_pword"){echo "active"; }?>">
                        <a href="<?=$url.'Admin/change-password'?>"><i class="fa fa-key"></i> Change Password</a>
                    </li> 
                    <?php if($role =="super administrator" OR $role == "management"): ?>              
                        <li class="menu-list">
                            <a href=""><i class="fa fa-users"></i>  <span>Users</span></a>
                            <ul class="child-list">
                                <li class="<?php if( $page=="all_users"){ echo "active";}?>">
                                    <a href="<?= $url.'Admin/all-users' ?>"> All Users</a>
                                </li>
                                <li class="<?php if( $page =="add_users"){ echo "active";}?>">
                                    <a href="<?= $url.'Admin/add-users'?>"> Add Users</a>
                                </li>
                            </ul>
                        </li>
                        <li class="<?php if($page == 'roles'){echo "active";} ?>">
                            <a href="<?=$url.'Admin/roles'?>"><i class="fa fa-tasks"></i> Roles</a>
                        </li>
                        <li>
                            <h3 class="navigation-title">Extra</h3>
                        </li>

                        <li class="menu-list"><a href="javascript:;"><i class="fa fa-envelope-o"></i> <span>Messages </span></a>
                            <ul class="child-list">
                                <li class="<?php if($page=="confirm_msg"){echo "active";} ?>">
                                    <a href="<?= $url.'Admin/confirmation_message'?>"> Orders/Reservations Comfirmation Message</a>
                                </li>
                                <li class="<?php if($page=="sent_msg"){ echo "active"; } ?>">
                                    <a href="<?= $url.'Admin/sent_mails'?>"> All Sent Messages</a>
                                </li>
                            </ul>
                        </li>';
                    <?php endif;?>
                </ul>
                <!--sidebar nav end-->
            </div>
        </div>        