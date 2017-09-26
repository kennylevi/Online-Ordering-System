<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <link rel="shortcut icon" href="<?php echo site_url(); ?>assets/img/DAZINNY-logo.png">
    <title>Admin-Login</title>

    <!-- Base Styles -->
    <link href="<?php echo site_url(); ?>assets/admin_ext/css/style.css" rel="stylesheet">
    <link href="<?php echo site_url(); ?>assets/admin_ext/css/style-responsive.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.min.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <style>
        .login-logo img{
            height:100px;
        }
        label.error{color:red;}
        .alert-danger {
            color: #e0abaa;
            background-color: #7d1c1c;
        }
    </style>
</head>

  <body class="login-body">

      <div class="login-logo">
          <img src="<?php echo site_url();?>assets/img/DAZINNY-logo.png" alt="dazinny-logo" />
      </div>

      <h2 class="form-heading">login</h2>
      <div class="container log-row">
            <?php
                $attr = array('class' => 'form-signin', 'id' => 'loginForm');
                echo form_open('Admin/admin-login', $attr);
            ?>
            <div class="login-wrap">
                  <input type="text" class="form-control required" name="userID"placeholder="User ID" autofocus>
                  <input type="password" class="form-control required" name="password" placeholder="Password">
                  <button class="btn btn-lg btn-success btn-block" type="submit" name="login">LOGIN</button>
                 
                  <label class="checkbox-custom check-success">
                      <input type="checkbox" value="remember-me" id="checkbox1"> <label for="checkbox1">Remember me</label>
                  </label>
                  <?php echo validation_errors('<p style="color:red;">', '</p>'); ?>
                  <?php if($this->session->has_userdata('logInError')):?>
                        <div class="alert alert-danger" role="alert"> <?php echo $this->session->logInError;?> </div>
                  <?php endif; ?>
              </div>
          </form>
      </div>


      <!--jquery-1.10.2.min-->
      <script src="<?php echo site_url(); ?>assets/admin_ext/js/jquery-1.11.1.min.js"></script>
      <!--Bootstrap Js-->
      <script src="<?php echo site_url(); ?>assets/admin_ext/js/bootstrap.min.js"></script>
      <script src="<?php echo site_url(); ?>assets/admin_ext/js/jrespond..min.js"></script>
    <script type="text/javascript" src="<?php echo site_url(); ?>assets/admin_ext/js/jquery.validate.min.js"></script>
  </body>
</html>
<script type="text/javascript">
    // $(document).ready(function(){
    //     $('#loginForm').validate();
    // });
</script> 