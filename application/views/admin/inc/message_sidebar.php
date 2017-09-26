<aside class="sm-side">
    <div class="m-title">
        <h3>Order/Reservation   </h3>
        <span>14 sent mail</span>
    </div>
    <div class="inbox-body">
        <a class="btn btn-compose" href="<?php echo site_url('Admin/confirmation_message'); ?>">
            Compose
        </a>
    </div>
    <ul class="inbox-nav inbox-divider">
        <li>
            <a href="https://dazinny.com.ng/webmail" target="_blank"><i class="fa fa-inbox"></i> Visit webmail here</a>
        </li>
        <li class="<?php if($page == 'sent_msg'){echo "active";} ?>">
            <a href="<?php echo site_url('Admin/sent_mails'); ?>"><i class="fa fa-envelope"></i> Sent Mail</a>
        </li>
    </ul>
</aside>